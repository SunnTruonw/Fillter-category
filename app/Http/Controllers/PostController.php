<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\PostTranslation;
use App\Models\CategoryPostTranslation;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Str;


class PostController extends Controller
{
    //

    private $post;
    private $categoryProduct;
    private $unit = 'đ';
    private $categoryPost;
    private $limitPost = 12;
    private $limitPostRelate = 5;
    private $idCategoryPostRoot = 21;
    private $postTranslation;
    private $categoryPostTranslation;
    private $setting;
    private $breadcrumbFirst = [];
    public function __construct(
        Post $post,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        Setting $setting
    ) {
        $this->post = $post;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->setting = $setting;
        $this->breadcrumbFirst = [
            'name' => 'Tin tức',
            'slug' => makeLink("post_all"),
            'id' => null,
        ];
    }
    public function index(Request $request)
    {

        // dd(route('product.index',['category'=>$request->category]));
        $breadcrumbs = [];
        $data = [];
        // get category
        $category = $this->categoryPost->where([
            ['id', $this->idCategoryPostRoot],
        ])->first();
        if ($category) {
            if ($category->count()) {
                $categoryId = $category->id;
                $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

                $data =  $this->post->whereIn('category_id', $listIdChildren)->paginate($this->limitPost);
                $breadcrumbs[] = $this->categoryPost->select('id')->find($this->idCategoryPostRoot)->toArray();
                //  dd($category);
                return view('frontend.pages.post', [
                    'data' => $data,
                    'unit' => $this->unit,
                    'breadcrumbs' => $breadcrumbs,
                    'typeBreadcrumb' => 'post_all',
                    'category' => $category,
                    'seo' => [
                        'title' =>  $category->title_seo ?? "",
                        'keywords' =>  $category->keywords_seo ?? "",
                        'description' =>  $category->description_seo ?? "",
                        'image' => $category->avatar_path ?? "",
                        'abstract' =>  $category->description_seo ?? "",
                    ]
                ]);
            }
        }
    }

    public function detail($slug)
    {
        // dd($slug);
        $slug_full =  'tin-tuc/' . $slug;

        // dd($slug_full);
        //1131-he-thong-phong-cach-am-chong-nong-chong-bui-cho-nha-may-gach-vitto-nha-may-gach-hoan-my-vinh-phuc.html
        $breadcrumbs = [];
        $data = [];
        $translation = $this->postTranslation->where([
            ["slug", $slug],
        ])->orWhere('slug', $slug_full)->first();

        // dd($translation->slug);
        // dd($translation);
        if ($translation) {
            $data = $translation->post;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }

            $categoryId = $data->category_id;

            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

            $dataRelate =  $this->post->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit($this->limitPostRelate)->get();

            $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);

            // lấy category sidebar theo danh mục
            $categoryNew = $this->categoryPost->whereIn(
                'id',
                [$listIdParent[0]]
            )->get();
            // dd($categoryNew);

            foreach ($listIdParent as $parent) {
                $breadcrumbs[] = $this->categoryPost->select('id')->find($parent)->toArray();
            }

            //Tin noi bat
            $post_hot =  $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();
            return view('frontend.pages.post-detail', [
                'data' => $data,
                'categoryPostSidebar' => $categoryNew,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'category_posts',
                'title' => $data ? $data->name : "",
                'category' => $data->category ?? null,
                'seo' => [
                    'title' =>  $data->title_seo ?? "",
                    'keywords' =>  $data->keywords_seo ?? "",
                    'description' =>  $data->description_seo ?? "",
                    'image' => $data->avatar_path ?? "",
                    'abstract' =>  $data->description_seo ?? "",

                ]
            ]);
        }
    }

    // public function detail2($slug)
    // {

    //     // dd($slug);
    //     $breadcrumbs = [];
    //     $data = [];
    //     // dd($slug);
    //     $translation = $this->postTranslation->where([
    //         ["slug",  $slug_full],
    //     ])->first();

    //     // dd($translation);

    //     if ($translation) {
    //         $data = $translation->post;
    //         if (checkRouteLanguage($slug, $data)) {
    //             return checkRouteLanguage($slug, $data);
    //         }

    //         $categoryId = $data->category_id;

    //         $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

    //         $dataRelate =  $this->post->whereIn('category_id', $listIdChildren)->where([
    //             ["id", "<>", $data->id],
    //         ])->limit($this->limitPostRelate)->get();
    //         $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
    //         // lấy category sidebar theo danh mục
    //         $categoryNew = $this->categoryPost->whereIn(
    //             'id',
    //             [$listIdParent[0]]
    //         )->get();
    //         // dd($categoryNew);
    //         foreach ($listIdParent as $parent) {
    //             $breadcrumbs[] = $this->categoryPost->select('id')->find($parent)->toArray();
    //         }
    //         //Tin noi bat
    //         $post_hot =  $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();
    //         return view('frontend.pages.post-detail', [
    //             'data' => $data,
    //             'categoryPostSidebar' => $categoryNew,
    //             "dataRelate" => $dataRelate,
    //             'breadcrumbs' => $breadcrumbs,
    //             'typeBreadcrumb' => 'category_posts',
    //             'title' => $data ? $data->name : "",
    //             'category' => $data->category ?? null,
    //             'seo' => [
    //                 'title' =>  $data->title_seo ?? "",
    //                 'keywords' =>  $data->keywords_seo ?? "",
    //                 'description' =>  $data->description_seo ?? "",
    //                 'image' => $data->avatar_path ?? "",
    //                 'abstract' =>  $data->description_seo ?? "",

    //             ]
    //         ]);
    //     }
    // }



    // danh sách product theo category
    public function postByCategory($slug)
    {

        // dd(route('product.index',['category'=>$request->category]));
        $breadcrumbs = [];
        $data = [];

        $translation = $this->categoryPostTranslation->where([
            ['slug', $slug],
        ])->first();



        $gioiThieuM = $this->setting->where('active', 1)->find(223);

        if ($translation) {
            if ($translation->count()) {
                $category = $translation->category;
                if (checkRouteLanguage($slug, $category)) {
                    return checkRouteLanguage($slug, $category);
                }

                if ($category) {
                    if ($category->count()) {
                        $categoryId = $category->id;
                        $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);

                        $data =  $this->post->whereIn('category_id', $listIdChildren)->where('active', 1)->orderBy('id', 'DESC')->paginate($this->limitPost);
                        $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
                        // lấy category sidebar theo danh mục
                        $categoryNew = $this->categoryPost->whereIn(
                            'id',
                            [$listIdParent[0]]
                        )->get();
                        foreach ($listIdParent as $parent) {
                            $breadcrumbs[] = $this->categoryPost->select('id')->find($parent)->toArray();
                        }
                        //Tin noi bat



                        return view('frontend.pages.post-by-category', [
                            'gioiThieuM' => $gioiThieuM,
                            'data' => $data,
                            'unit' => $this->unit,
                            'breadcrumbs' => $breadcrumbs,
                            'categoryPostSidebar' => $categoryNew,
                            'typeBreadcrumb' => 'category_posts',
                            'category' => $category,
                            'seo' => [
                                'title' =>  $category->title_seo ?? "",
                                'keywords' =>  $category->keywords_seo ?? "",
                                'description' =>  $category->description_seo ?? "",
                                'image' => $category->avatar_path ?? "",
                                'abstract' =>  $category->description_seo ?? "",
                            ]
                        ]);
                    }
                }
            }
        }
    }

    public function tag($slug)
    {

        // dd(route('product.index',['category'=>$request->category]));
        $breadcrumbs = [];
        $data = [];

        $tag = Tag::where([
            ['name', $slug],
        ])->get();


        foreach ($tag as $keyT => $value) {
            if (Str::lower($value->name) !== Str::lower($slug)) {
                $tag->forget($keyT);
            }
        }
        $tag = $tag->first();


        if ($tag) {
            $data = [];
            $listIdPost = $tag->postTags()->pluck('post_id');

            if ($listIdPost->count() > 0) {
                $data = $this->post
                    ->whereIn('posts.id', $listIdPost)
                    ->where([['posts.active', 1]])
                    ->paginate(20);

                return view('frontend.pages.tag', [
                    'data' => $data,
                    'unit' => $this->unit,
                    'slug' => $slug,
                    //  'breadcrumbs' => $breadcrumbs,
                    // 'typeBreadcrumb' => 'category_posts',
                    //'categoryPost' => $categoryPostSidebar,

                    //'typeView' => $typeView,
                    // 'categoryPostActive' => $listIdActive,
                    'seo' => [
                        'title' =>   $slug,
                        'keywords' => $slug,
                        'description' =>  $slug,
                        'image' => '',
                        'abstract' =>  $slug,
                    ]
                ]);
            } else {
                return view('frontend.pages.tag', [
                    'data' => $data,
                    'unit' => $this->unit,
                    'slug' => $slug,
                    //  'breadcrumbs' => $breadcrumbs,
                    // 'typeBreadcrumb' => 'category_posts',
                    //'categoryPost' => $categoryPostSidebar,

                    //'typeView' => $typeView,
                    // 'categoryPostActive' => $listIdActive,
                    'seo' => [
                        'title' =>   $slug,
                        'keywords' => $slug,
                        'description' =>  $slug,
                        'image' => '',
                        'abstract' =>  $slug,
                    ]
                ]);
            }
        }
    }
}
