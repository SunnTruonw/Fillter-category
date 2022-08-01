<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Slider;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\PostTranslation;
use App\Models\ProductTranslation;
use App\Models\CategoryPostTranslation;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Transaction;
use App\Models\User;
use App\Helper\AddressHelper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $listStatus;

    private $city;
    private $district;
    private $commune;
    private $user;
    private $product;
    private $setting;
    private $transaction;
    private $slider;
    private $post;
    private $categoryPost;
    private $categoryProduct;
    private $postTranslation;
    private $categoryPostTranslation;
    private $productTranslation;
    private $productSearchLimit  = 4;
    private $postSearchLimit     = 6;
    private $idCategoryProductRoot = 185;
    private $limitProduct = 12;

    private $productHotLimit     = 10;
    private $productNgocLimit     = 8;
    private $productSaleLimit     = 8;
    private $productNewLimit     = 10;
    private $phukienLimit     = 4;
    private $productViewLimit    = 8;
    private $productPayLimit     = 8;
    private $sliderLimit         = 8;
    private $postsHotLimit       = 8;
    private $unit                = 'đ';
    public function __construct(
        Product $product,
        Setting $setting,
        Transaction $transaction,
        Slider $slider,
        Post $post,
        User $user,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        ProductTranslation $productTranslation,
        City $city,
        District $district,
        Commune $commune
    ) {
        /*$this->middleware('auth');*/
        $this->product = $product;
        $this->city = $city;
        $this->district = $district;
        $this->commune = $commune;
        $this->user = $user;
        $this->transaction = $transaction;
        $this->listStatus = $this->transaction->listStatus;
        $this->setting = $setting;
        $this->slider = $slider;
        $this->post = $post;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->productTranslation = $productTranslation;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $listId = $this->categoryPost->getALlCategoryChildrenAndSelf(62);
        $post_home =  Post::whereIn('category_id', $listId)->where('active', 1)->where('hot', 1)->get();
        $listId = $this->categoryPost->getALlCategoryChildrenAndSelf(70);
        $post_home_video =  Post::whereIn('category_id', $listId)->where('active', 1)->where('hot', 1)->get();

        $listIdProduct = $this->categoryProduct->getALlCategoryChildrenAndSelf(185);
        $productContactHome =  Product::whereIn('category_id', $listIdProduct)->where('active', 1)->get();
        // dd(session()->has('cart'));
        //  $cart=[1=>'test 1'];
        //  $request->session()->put('cart',  $cart);
        //   dd($request->session()->get('cart'));

        //  dd($this->categoryPost->setAppends(['slug_full'])->find(15)->slug_full);

        //    dd(menuRecusive($this->categoryPost,13));
        //  dd($this->categoryPost->find(18)->breadcrumb);
        // $dataSettings = $this->setting->get();
        // $categoryProductHome = $this->categoryProduct->find(2);
        // $categoryProductHome2 = $this->categoryProduct->whereIn('id', [30, 39])->where('active', 1)->orderby('order')->get();
        // sản phẩm nổi bật
        $productsHot = $this->product->where([
            ['active', 1],
            ['hot', 1],
        ])->latest()->limit($this->productHotLimit)->get();
        // sản phẩm sale
        $listIdCategory = $this->categoryProduct->getALlCategoryChildrenAndSelf(185);
        // $categoryProductHome = $this->categoryProduct->find(239);
        $categoryProductHome = $this->categoryProduct->where([
            ['active', 1],
            ['hot', 1],
        ])->whereIn('id', $listIdCategory)->latest()->limit($this->phukienLimit)->get();

        // sản phẩm mới
        $productsNew = $this->product->where([
            ['active', 1]
        ])->latest()->limit($this->productNewLimit)->get();

        $productsBest = $this->product->where([
            ['active', 1],
            ['sp_km', 1],
        ])->latest()->limit($this->productHotLimit)->get();

        $productsHeart = $this->product->where([
            ['active', 1],
            ['sp_ngoc', 1],
        ])->latest()->limit($this->productHotLimit)->get();

        $lisIdCategoryRoot = $this->categoryProduct->getALlCategoryChildrenAndSelf(185);

        $categoryProductRoot = $this->categoryProduct->whereIn('id', $lisIdCategoryRoot)->where([
            ['active', 1],
            ['hot', 1],
        ])->get();


        $slidesub = $this->setting->find(342);
        $hotro = $this->setting->find(337);
        $camnhan = $this->setting->find(302);
        $camnhan2 = $this->setting->find(304);
        $thongtin_danhmucsp = $this->setting->find(239);
        $dichvu = $this->setting->find(287);
        $banner = $this->setting->where('parent_id', 287)->where('active', 1)->orderBy('order')->orderByDesc('created_at')->get();
        $titleSMMoi = $this->setting->find(174);
        $titleSPBanchay = $this->setting->find(175);
        $titlePostNew = $this->setting->find(265);

        // $boSuuTap = $this->setting->where('active', 1)->find(377);
        $boSuuTap = $this->categoryProduct->where('active', 1)->find(284);
        $saleling = $this->setting->where('active', 1)->find(362);
        $banner3 = $this->setting->where('active', 1)->find(383);
        $bannerTopBoSuuTap = $this->setting->where('active', 1)->find(389);
        // // sản phẩm xem nhiều
        // $productsView = $this->product->where([
        //     ['active', 1],
        // ])->orderByDesc('view')->limit($this->productViewLimit)->get();
        // // sản phẩm mua nhiều
        // $productsPay = $this->product->where([
        //     ['active', 1],
        // ])->orderByDesc('pay')->limit($this->productPayLimit)->get();
        // // lấy slider
        $sliders = $this->slider->where([
            ['active', 1],
        ])->orderBy('order')->orderByDesc('created_at')->limit($this->sliderLimit)->get();
        // slidersMob
        $slidersM = $this->setting->where([
            ['active', 1],
            ['parent_id', 290],
        ])->orderBy('order')->orderByDesc('created_at')->limit($this->sliderLimit)->get();
        $bosuutapM = $this->setting->find(228);
        $khuyenMaiM = $this->setting->find(229);
        $dichvuM = $this->setting->find(222);
        $popM = $this->setting->find(230);
        // // bài viết nổi bật
        $postsHot = $this->post->where([
            ['active', 1],
            ['hot', 1],
            ['category_id', 56],
        ])->orderby('order')->orderByDesc('created_at')->limit(5)->get();

        // $bannerHome = $this->setting->find(18);

        $cate = $this->categoryProduct->getALlCategoryChildrenAndSelf(1);

        $cateProduct = $this->categoryProduct->find(185);

        $listCateHot = $this->categoryProduct->where('active', 1)->where('hot', 1)->orderBy('order')->orderByDesc('created_at')->get();

        // // dd($cate);
        $postNew = $this->post->whereIn('category_id', $cate)->where('active', '1')->orderByDesc('created_at')->limit(6)->get();

        $collection = $this->setting->find(167);

        $modalHome = $this->setting->where('active', 1)->find(177);

        // $video = $this->post->where('category_id', '33')->orderByDesc('created_at')->get();

        // $video_one = $this->post->where('category_id', '33')->orderByDesc('created_at')->first();

        // // dd($postNew);
        // $supportHome = $this->setting->find(90);
        // $banner2Home = $this->setting->find(93);
        // $menuHome=$this->categoryProduct->where([
        //     'active'=>1,
        //     'parent_id'=>2
        // ])->orderby('order')->get();



        return view('frontend.pages.home', [
            'bannerTopBoSuuTap' => $bannerTopBoSuuTap,
            'saleling' => $saleling,
            'boSuuTap' => $boSuuTap,
            'banner3' => $banner3,
            'categoryProductRoot' => $categoryProductRoot,
            'productContactHome' => $productContactHome,
            'post_home' => $post_home,
            'post_home_video' => $post_home_video,
            'categoryProductHome' => $categoryProductHome,
            // 'categoryProductHome2' => $categoryProductHome2,
            'productHot' => $productsHot,
            'cateProduct' => $cateProduct,
            'thongtin_danhmucsp' => $thongtin_danhmucsp,
            'modalHome' => $modalHome,
            'productsBest' => $productsBest,
            'productsHeart' => $productsHeart,
            'productNew' => $productsNew,
            // 'phukien' => $phukien,
            'hotro' => $hotro,
            'slidesub' => $slidesub,
            'camnhan' => $camnhan,
            'camnhan2' => $camnhan2,
            'collection' => $collection,
            'dichvu' => $dichvu,
            'listCateHot' => $listCateHot,
            // 'productView' => $productsView,
            // 'productPay' => $productsPay,
            'postsHot'  => $postsHot,
            // // 'dataSettings' => $dataSettings,
            // 'video' => $video,
            // 'video_one' => $video_one,
            'postNew' => $postNew,
            "slider" => $sliders,
            "unit" => $this->unit,
            "banner" => $banner,
            "titleSMMoi" => $titleSMMoi,
            "titleSPBanchay" => $titleSPBanchay,
            "titlePostNew" => $titlePostNew,
            "slidersM" => $slidersM,
            "bosuutapM" => $bosuutapM,
            "khuyenMaiM" => $khuyenMaiM,
            "dichvuM" => $dichvuM,
            "popM" => $popM,
        ]);
    }



    public function aboutUs(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $data = $this->categoryPost->find(71);
        $breadcrumbs = [[
            'id' => $data->id,
            'name' => $data->name,
            'slug' => makeLinkToLanguage('about-us', null, null, \App::getLocale()),
        ]];


        return view("frontend.pages.about-us", [
            "data" => $data,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'about-us',
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

    public function tuyen_dung(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $data = $this->categoryPost->find(39);

        $breadcrumbs = [[
            'id' => $data->id,
            'name' => $data->name,
            'slug' => makeLinkToLanguage('tuyen-dung', null, null, \App::getLocale()),
        ]];

        $categoryAll =  $this->post->where('category_id', $data->id)->paginate(9);

        $post_hot =  $this->post->where('category_id', $data->id)->where('hot', 1)->limit(4)->get();

        return view("frontend.pages.tuyendung", [
            "data" => $data,
            "categoryAll" => $categoryAll,
            "post_hot" => $post_hot,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'tuyen-dung',
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

    public function tuyendungDetail($slug)
    {
        $resultCheckLang = checkRouteLanguage2($slug);
        if ($resultCheckLang) {
            return $resultCheckLang;
        }

        $breadcrumbs = [];
        $data = [];

        $translation = $this->postTranslation->where([
            ["slug", $slug],
        ])->first();

        if ($translation) {
            $data = $translation->post;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }

            $categoryId = $data->category_id;
            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
            $dataRelate =  $this->post->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit(5)->get();
            $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
            foreach ($listIdParent as $parent) {
                $breadcrumbs[] = $this->categoryPost->select('id', 'name', 'slug')->find($parent)->toArray();
            }
            //Tin noi bat
            $post_hot =  $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();

            return view('frontend.pages.tuyendung-detail', [
                'data' => $data,
                'post_hot' => $post_hot,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'tuyen-dung',
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

    public function camnhan(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $camnhan = $this->setting->find(93);
        $breadcrumbs = [[
            'name' => 'Cảm nhận của khách hàng',
            'slug' => makeLinkToLanguage('camnhan', null, null, \App::getLocale()),
        ]];

        $listCategoryHome = $this->categoryProduct->where('parent_id', '76')->where('active', 1)->orderBy('created_at', 'ASC')->limit(4)->get();

        return view("frontend.pages.camnhan", [
            "data" => $camnhan,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'camnhan',
            'seo' => [
                'title' =>  "Cảm nhận của khách hàng",
                'keywords' =>   "Cảm nhận của khách hàng",
                'description' =>    "Cảm nhận của khách hàng",
                'image' =>   "Cảm nhận của khách hàng",
                'abstract' =>   "Cảm nhận của khách hàng",
            ]
        ]);
    }

    public function storeAjax(Request $request)
    {
        //   dd($request->name);
        // dd($request->ajax());
        try {
            DB::beginTransaction();

            $dataContactCreate = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone') ?? "",
                'email' => $request->input('email') ?? "",
                'sex' => $request->input('sex') ?? 1,
                'from' => $request->input('from') ?? "",
                'to' => $request->input('to') ?? "",
                'service' => $request->input('service') ?? "",
                'content' => $request->input('content') ?? null,
            ];
            //  dd($dataContactCreate);
            $contact = $this->contact->create($dataContactCreate);
            //  dd($contact);
            DB::commit();
            return response()->json([
                "code" => 200,
                "html" => 'ສົ່ງຂໍ້ຄວາມສຳເລັດ',
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                'html' => 'ສົ່ງຂໍ້ຄວາມສຳເລັດ',
                "message" => "fail"
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $dataProduct = $this->product;
        $dataPost = $this->post;
        $where = [];
        $req = [];
        if ($request->has('category_id')) {
            $categoryId = $request->category_id;
            $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
            $dataProduct =  $this->product->whereIn('category_id', $listIdChildren);
        }
        //  dd($dataProduct->get());
        if ($request->input('keyword')) {

            $dataProduct = $dataProduct->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keyword') . '%']
                ])->pluck('product_id');
                // dd($idProTran);
                $query->whereIn('id', $idProTran)->orWhere([
                    ['masp', 'like', '%' . request()->input('keyword') . '%']
                ]);
            });
        }
        // if ($where) {
        //     $dataProduct = $dataProduct->where($where)->orderBy("created_at", "DESC");
        //     $dataPost = $dataPost->where($where)->orderBy("created_at", "DESC");
        // }
        $dataProduct = $dataProduct->orderBy("order", "ASC")->orderBy("created_at", "DESC")->paginate($this->productSearchLimit);
        //   $dataPost = $dataPost->paginate($this->postSearchLimit);
        $breadcrumbs = [[
            'id' => null,
            'name' => __('search.ket_qua_tim_kiem'),
            //'slug' => makeLink('search', null, null, $req),
            'slug' => "",
        ]];
        // dd($dataProduct);
        return view("frontend.pages.search", [
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'search',
            'dataProduct' => $dataProduct,
            // 'dataPost' => $dataPost,
            'unit' => $this->unit,
            'seo' => [
                'title' =>  __('search.ket_qua_tim_kiem'),
                'keywords' => __('search.ket_qua_tim_kiem'),
                'description' => __('search.ket_qua_tim_kiem'),
                'image' => __('search.ket_qua_tim_kiem'),
                'abstract' => __('search.ket_qua_tim_kiem'),
            ]
        ]);
    }

    public function changePassword(Request $request)
    {
        $breadcrumbs = [[
            'id' => null,
            'name' => 'Đổi mật khẩu',
            'slug' => route('home.changePassword'),
        ]];


        return view("frontend.pages.change-password", [
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'search',
            'unit' => $this->unit,
            'seo' => [
                'title' =>  'Đổi mật khẩu',
                'keywords' => 'Đổi mật khẩu',
                'description' => 'Đổi mật khẩu',
                'image' => 'Đổi mật khẩu',
                'abstract' => 'Đổi mật khẩu',
            ]
        ]);
    }

    public function storeChangePassword(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {

            $validator = \Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'min:8|required',
                'confirm_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['html' => $validator->errors()->all()]);
            }

            if (!(Hash::check($request->old_password, Auth::user()->password))) {
                // The passwords matches
                return response()->json(['html' => 'Mật khẩu hiện tại của bạn không khớp.']);
            }



            $idUser = Auth::id();

            $newPass = $request->password;

            $this->user->where('id', $idUser)->update(['password' => \Hash::make($newPass)]);
            $user   =  $this->user->find($idUser);
            if ($newPass) {
                return response()->json([
                    "code" => 200,
                    "html" => 'Đổi mật khẩu thành công',
                    "message" => "success",
                    'name' => $user->name
                ], 200);
            } else {
                return response()->json([
                    "code" => 500,
                    'html' => 'Đổi mật khẩu không thành công',
                    "message" => "fail"
                ], 500);
            }
        }
    }

    public function myAccount(Request $request)
    {
        $idUser = \Auth::id();
        $user = $this->user->find($idUser);
        if ($request->ajax()) {

            // dd($user);
            $updateResult =  $user->update([
                'name' => $request->name,
                'username' => $request->username,
                // 'password' => Hash::make(Str::random(20)),
                'phone' => $request->phone,
                'address' => $request->address,
                'city_id' => $request->input('city_id') ?? null,
                'district_id' => $request->input('district_id') ?? null,
                'commune_id' => $request->input('commune_id') ?? null,
            ]);

            $user   =  $this->user->find($idUser);
            if ($updateResult) {
                return response()->json([
                    "code" => 200,
                    "html" => 'Cập nhật thông tin thành công',
                    "message" => "success",
                    'name' => $user->name
                ], 200);
            } else {
                return response()->json([
                    "code" => 500,
                    'html' => 'Cập nhật thông tin không thành công',
                    "message" => "fail"
                ], 500);
            }
        }
        $address = new AddressHelper();
        $data = $this->city->orderby('name')->get();
        $cities = $address->cities($data);

        $breadcrumbs = [[
            'id' => null,
            'name' => 'Thông tin tài khoản',
            'slug' => route('home.my-account'),
        ]];

        return view("frontend.pages.my-account", [
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'search',
            'cities' => $cities,
            'user' => $user,
            // 'dataProduct' => $dataProduct,
            // 'dataPost' => $dataPost,
            'unit' => $this->unit,
            'seo' => [
                'title' =>  'Thông tin tài khoản',
                'keywords' => 'Thông tin tài khoản',
                'description' => 'Thông tin tài khoản',
                'image' => 'Thông tin tài khoản',
                'abstract' => 'Thông tin tài khoản',
            ]
        ]);
    }

    public function myOrder(Request $request)
    {
        $idUser = \Auth::id();

        $data = $this->transaction->where('user_id', $idUser)->paginate(10);

        // dd($data);
        $breadcrumbs = [[
            'id' => null,
            'name' => 'Đơn đặt hàng của tôi',
            'slug' => route('home.my-order'),
        ]];

        if ($request->ajax()) {
            if ($request->id_status) {
                $id_status = $request->id_status;

                if ($id_status && $id_status == 'all') {
                    $dataStatus = $this->transaction->where('user_id', $idUser)->paginate(10);
                } else {
                    $dataStatus = $this->transaction->where('user_id', $idUser)->where('status', $id_status)->paginate(10);
                }

                $listStatus = $this->listStatus;
                // dd($dataStatus);

                $html = view('frontend.components.load-my-order', compact(
                    'dataStatus',
                    'listStatus'
                ))->render();
                return response()->json([
                    'data' => $html
                ]);
            }
        } else {
            return view("frontend.pages.my-order", [
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'search',
                'data' => $data,
                'listStatus' => $this->listStatus,
                // 'dataPost' => $dataPost,
                'unit' => $this->unit,
                'seo' => [
                    'title' =>  'Đơn đặt hàng của tôi',
                    'keywords' => 'Đơn đặt hàng của tôi',
                    'description' => 'Đơn đặt hàng của tôi',
                    'image' => 'Đơn đặt hàng của tôi',
                    'abstract' => 'Đơn đặt hàng của tôi',
                ]
            ]);
        }
    }

    public function search_ajax(Request $request)
    {
        $products = $this->product;

        if (request()->input('keywords')) {

            $products = $products->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keywords') . '%']
                ])->pluck('product_id');

                $query->whereIn('id', $idProTran)->orWhere([
                    ['masp', 'like', '%' . request()->input('keywords') . '%']
                ]);
            });


            $unit = 'đ';
            $output = '';

            $data = $products->orderBy("order", "ASC")->orderBy("created_at", "DESC")->paginate($this->productSearchLimit);

            // dd($products);

            $html = view('frontend.components.load-view-search', compact('data'))->render();
            return response()->json(['data' => $html]);
        }
    }



    public function search_daily(Request $request)
    {

        $dataAddress = $this->setting->find(28);
        $map = $this->setting->find(33);
        $breadcrumbs = [
            [
                'name' => "ຕິດຕໍ່",
                'slug' => makeLink('contact'),
            ],
        ];

        // Thông tin mục hệ thống
        $system = $this->setting->where('id', '57')->where('active', 1)->orderByDesc('created_at')->first();

        // Thông tin item mục hệ thống
        $systemChilds = $this->setting->where('parent_id', '57')->where('active', 1)->orderByDesc('created_at')->limit(2)->get();

        $data = $request->all();
        $key = $request->input('keyword');
        if ($key) {
            $listAddress = $this->setting->where('parent_id', '28')->where('name', 'LIKE', '%' . $key . '%')->get();
        }

        return view("frontend.pages.contact", [

            'breadcrumbs' => $breadcrumbs,
            'systemChilds' => $systemChilds,
            'system' => $system,
            'listAddress' => $listAddress,
            'typeBreadcrumb' => 'contact',
            'title' =>  "Thông tin liên hệ",

            'seo' => [
                'title' => "Thông tin liên hệ",
                'keywords' =>  "Thông tin liên hệ",
                'description' =>   "Thông tin liên hệ",
                'image' =>  "",
                'abstract' =>  "Thông tin liên hệ",
            ],

            "dataAddress" => $dataAddress,
            "map" => $map,
        ]);
    }
}
