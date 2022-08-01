<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductTranslation;
use App\Models\Attribute;
use App\Models\Supplier;
use App\Models\Option;
use App\Models\Size;
use App\Models\CouPon;
use App\Models\OptionValue;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ValidateAddProduct;
use App\Http\Requests\Admin\ValidateEditProduct;

use App\Exports\ExcelExportsDatabase;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImportsDatabase;
use App\Models\OptionImage;
use App\Models\ProductVariant;
use App\Models\Variant;
use Illuminate\Support\Facades\App;

class AdminProductController extends Controller
{
    //
    use StorageImageTrait, DeleteRecordTrait;
    private $product;
    private $size;
    private $coupon;
    private $optionImage;
    private $categoryProduct;
    private $htmlselect;
    private $productImage;
    private $tag;
    private $option;
    private $optionValue;
    private $productTag;
    private $productTranslation;
    private $supplier;
    private $attribute;
    private $langConfig;
    private $langDefault;

    public function __construct(
        ProductTranslation $productTranslation,
        Product $product,
        CategoryProduct $categoryProduct,
        ProductImage $productImage,
        Tag $tag,
        ProductTag $productTag,
        Attribute $attribute,
        Supplier $supplier,
        Option $option,
        CouPon $coupon,
        OptionImage $optionImage,
        Size $size,
        OptionValue $optionValue
    ) {
        $this->product = $product;
        $this->categoryProduct = $categoryProduct;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productTranslation = $productTranslation;
        $this->attribute = $attribute;
        $this->supplier = $supplier;
        $this->option = $option;
        $this->size = $size;
        $this->coupon = $coupon;
        $this->optionValue = $optionValue;
        $this->optionImage = $optionImage;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    //
    public function index(Request $request)
    {
        //   dd(App::getLocale());
        $totalProduct = $this->product->all()->count();
        $data = $this->product;
        if ($request->input('category')) {
            $categoryProductId = $request->input('category');
            $idCategorySearch = $this->categoryProduct->getALlCategoryChildren($categoryProductId);
            $idCategorySearch[] = (int)($categoryProductId);
            $data = $data->whereIn('category_id', $idCategorySearch);
            $htmlselect = $this->categoryProduct->getHtmlOption($categoryProductId);
        } else {
            $htmlselect = $this->categoryProduct->getHtmlOption();
        }
        $where = [];
        $orWhere = null;
        if ($request->input('keyword')) {

            $data = $data->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keyword') . '%']
                ])->pluck('product_id');
                // dd($idProTran);
                $query->whereIn('id', $idProTran)->orWhere([
                    ['masp', 'like', '%' . request()->input('keyword') . '%']
                ]);
            });
            // $where[] = ['name', 'like', '%' . $request->input('keyword') . '%'];
            // $orWhere = ['masp', 'like', '%' . $request->input('keyword') . '%'];
        }
        if ($request->has('fill_action') && $request->input('fill_action')) {
            $key = $request->input('fill_action');

            switch ($key) {
                case 'hot':
                    $where[] = ['hot', '=', 1];
                    break;
                case 'no_hot':
                    $where[] = ['hot', '=', 0];
                    break;
                case 'active':
                    $where[] = ['active', '=', 1];
                    break;
                case 'no_active':
                    $where[] = ['active', '=', 0];
                    break;
                default:
                    break;
            }
        }
        if ($where) {
            $data = $data->where($where);
        }
        //  dd($orWhere);
        if ($orWhere) {
            $data = $data->orWhere(...$orWhere);
        }
        if ($request->input('order_with')) {
            $key = $request->input('order_with');
            switch ($key) {
                case 'dateASC':
                    $orderby = ['created_at'];
                    break;
                case 'dateDESC':
                    $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                case 'viewASC':
                    $orderby = [
                        'view',
                        'ASC'
                    ];
                    break;
                case 'viewDESC':
                    $orderby = [
                        'view',
                        'DESC'
                    ];
                    break;
                case 'priceASC':
                    $orderby = [
                        'price',
                        'ASC'
                    ];
                    break;
                case 'priceDESC':
                    $orderby = [
                        'price',
                        'DESC'
                    ];
                    break;
                case 'payASC':
                    $orderby = [
                        'pay',
                        'ASC'
                    ];
                    break;
                case 'payDESC':
                    $orderby = [
                        'pay',
                        'DESC'
                    ];
                    break;
                default:
                    $orderby =  $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
            }
            $data = $data->orderBy(...$orderby);
        } else {
            $data = $data->orderBy("created_at", "DESC");
        }
        //  dd($this->product->select('*', \App\Models\Store::raw('Sum(quantity) as total')->whereRaw('products.id','stores.product_id'))->orderBy('total')->paginate(15));
        //  dd($data->get()->first()->name);
        $data = $data->paginate(15);

        return view(
            "admin.pages.product.list",
            [
                'data' => $data,
                'totalProduct' => $totalProduct,
                'option' => $htmlselect,
                'keyword' => $request->input('keyword') ? $request->input('keyword') : "",
                'order_with' => $request->input('order_with') ? $request->input('order_with') : "",
                'fill_action' => $request->input('fill_action') ? $request->input('fill_action') : "",
            ]
        );
    }

    public function loadActiveOption($id)
    {
        $option = $this->option->find($id);
        $active = $option->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $option->update([
            'active' => $activeUpdate,
        ]);
        // dd($updateResult);
        $option = $this->option->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $option, 'type' => 'Màu'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadActiveSize($id)
    {
        $size = $this->size->find($id);
        $active = $size->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $size->update([
            'active' => $activeUpdate,
        ]);
        // dd($updateResult);
        $size = $this->size->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $size, 'type' => 'size'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadActiveCoupon($id)
    {
        $coupon = $this->coupon->find($id);
        $active = $coupon->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $coupon->update([
            'active' => $activeUpdate,
        ]);
        // dd($updateResult);
        $coupon = $this->coupon->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $coupon, 'type' => 'size'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }



    public function loadActive($id)
    {
        $product   =  $this->product->find($id);
        $active = $product->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $product->update([
            'active' => $activeUpdate,
        ]);
        // dd($updateResult);
        $product   =  $this->product->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $product, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadHot($id)
    {
        $product   =  $this->product->find($id);
        $hot = $product->hot;

        if ($hot) {
            $hotUpdate = 0;
        } else {
            $hotUpdate = 1;
        }
        $updateResult =  $product->update([
            'hot' => $hotUpdate,
        ]);

        $product   =  $this->product->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot', ['data' => $product, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadKhuyenMai($id)
    {
        $product   =  $this->product->find($id);
        $sp_km = $product->sp_km;

        if ($sp_km) {
            $spkmUpdate = 0;
        } else {
            $spkmUpdate = 1;
        }
        $updateResult =  $product->update([
            'sp_km' => $spkmUpdate,
        ]);

        $product   =  $this->product->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-sp_km', ['data' => $product, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function loadyeuThich($id)
    {
        $product   =  $this->product->find($id);
        $sp_ngoc = $product->sp_ngoc;

        if ($sp_ngoc) {
            $spytUpdate = 0;
        } else {
            $spytUpdate = 1;
        }
        $updateResult =  $product->update([
            'sp_ngoc' => $spytUpdate,
        ]);

        $product   =  $this->product->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-sp_ngoc', ['data' => $product, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function boSuuTap($id)
    {
        $product   =  $this->product->find($id);
        $bo_suu_tap = $product->bo_suu_tap;

        if ($bo_suu_tap) {
            $boSuuTapUpdate = 0;
        } else {
            $boSuuTapUpdate = 1;
        }
        $updateResult =  $product->update([
            'bo_suu_tap' => $boSuuTapUpdate,
        ]);

        $product   =  $this->product->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-bo_suu_tap', ['data' => $product, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function create(Request $request = null)
    {
        $htmlselect = $this->categoryProduct->getHtmlOption();

        $htmlselectBTS = $this->categoryProduct->getHtmlOptionAddWithParent(284);

        $attributes = $this->attribute->where('parent_id', 0)->get();
        $supplier = $this->supplier->all();
        return view(
            "admin.pages.product.add",
            [
                'option' => $htmlselect,
                'attributes' => $attributes,
                'supplier' => $supplier,
                'optionBTS' => $htmlselectBTS,
                'request' => $request
            ]
        );
    }


    public function store(ValidateAddProduct $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                "masp" => $request->input('masp'),
                "price" => $request->input('price') ?? 0,
                "old_price" => $request->input('old_price') ?? 0,
                "size" => $request->input('size') ?? null,
                "color" => $request->input('color') ?? null,
                "sale" => $request->input('sale') ?? 0,
                "hot" => $request->input('hot') ?? 0,
                "bo_suu_tap" => $request->input('bo_suu_tap') ?? 0,
                "sp_km" => $request->input('sp_km') ?? 0,
                "sp_ngoc" => $request->input('sp_ngoc') ?? 0,
                "order" => $request->input('order') ?? null,
                "file3" => $request->input('file3') ?? null,
                // "pay"=>$request->input('pay'),
                // "number"=>$request->input('number'),
                "warranty" => $request->input('warranty') ?? 0,
                "view" => $request->input('view') ?? 0,
                "active" => $request->input('active'),
                "category_id" => $request->input('category_id'),
                "supplier_id" => $request->input('supplier_id') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            //    dd($dataProductCreate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "product");
            if (!empty($dataUploadAvatar)) {
                $dataProductCreate["avatar_path"] = $dataUploadAvatar["file_path"];
            }

            $dataUploadAvatar = $this->storageTraitUpload($request, "file", "file");
            if (!empty($dataUploadAvatar)) {
                $dataProductCreate["file"] = $dataUploadAvatar["file_path"];
            }
            $dataUploadAvatar = $this->storageTraitUpload($request, "file2", "file");
            if (!empty($dataUploadAvatar)) {
                $dataProductCreate["file2"] = $dataUploadAvatar["file_path"];
            }
            // $dataUploadAvatar = $this->storageTraitUpload($request, "file3", "file");
            // if (!empty($dataUploadAvatar)) {
            //     $dataProductCreate["file3"] = $dataUploadAvatar["file_path"];
            // }
            // dd($dataProductCreate);
            // insert database in product table
            $product = $this->product->create($dataProductCreate);
            // insert data product lang
            $dataProductTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemProductTranslation = [];
                $itemProductTranslation['name'] = $request->input('name_' . $key);
                $itemProductTranslation['slug'] = $request->input('slug_' . $key);
                $itemProductTranslation['description'] = $request->input('description_' . $key);
                $itemProductTranslation['description_seo'] = $request->input('description_seo_' . $key);
                $itemProductTranslation['title_seo'] = $request->input('title_seo_' . $key);
                $itemProductTranslation['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemProductTranslation['content'] = $request->input('content_' . $key);
                //add
                $itemProductTranslation['content2'] = $request->input('content2_' . $key);
                $itemProductTranslation['content3'] = $request->input('content3_' . $key);
                $itemProductTranslation['content4'] = $request->input('content4_' . $key);
                $itemProductTranslation['model'] = $request->input('model_' . $key);
                $itemProductTranslation['tinhtrang'] = $request->input('tinhtrang_' . $key);
                $itemProductTranslation['baohanh'] = $request->input('baohanh_' . $key);
                $itemProductTranslation['xuatsu'] = $request->input('xuatsu_' . $key);

                $itemProductTranslation['language'] = $key;
                $dataProductTranslation[] = $itemProductTranslation;
            }
            //    dd($dataProductTranslation);
            $productTranslation =   $product->translations()->createMany($dataProductTranslation);
            //  dd($productTranslation);
            // insert database to product_images table
            if ($request->hasFile("image")) {
                //
                $dataProductImageCreate = [];
                foreach ($request->file('image') as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
                    $dataProductImageCreate[] = [
                        "name" => $dataProductImageDetail["file_name"],
                        "image_path" => $dataProductImageDetail["file_path"]
                    ];
                }
                // insert database in product_images table by createMany
                $productImage =   $product->images()->createMany($dataProductImageCreate);
            }

            // insert attribute to product
            if ($request->has("attribute")) {
                $attribute_ids = [];
                foreach ($request->input('attribute') as $attributeItem) {
                    if ($attributeItem) {
                        $attributeInstance = $this->attribute->find($attributeItem);
                        $attribute_ids[] = $attributeInstance->id;
                    }
                }

                $attribute = $product->attributes()->attach($attribute_ids);
            }
            // insert database to product_tags table
            foreach ($this->langConfig as $key => $value) {
                if ($request->has("tags_" . $key)) {
                    $tag_ids = [];
                    foreach ($request->input('tags_' . $key) as $tagItem) {
                        $tagInstance = $this->tag->firstOrCreate(["name" => $tagItem]);
                        $tag_ids[] = $tagInstance->id;
                    }
                    $product->tags()->attach($tag_ids, ['language' => $key]);
                }
            }

            if ($request->has("priceOption")) {
                //
                $dataProductOptionCreate = [];
                foreach ($request->input('priceOption') as $key => $value) {
                    if ($value || $request->input('sizeOption')[$key] || $request->input('old_priceOption')[$key]) {

                        $dataProductOptionCreate[] = [
                            "price" => $request->input('priceOption')[$key],
                            "old_price" =>  $request->input('old_priceOption')[$key],
                            "size" =>  $request->input('sizeOption')[$key],
                            "color" =>  null,
                            "avatar_type" => null,
                        ];
                    }
                }
                $product->options()->createMany($dataProductOptionCreate);
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with("alert", "Thêm sản phẩm thành công");
        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.index')->with("error", "Thêm sản phẩm không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->product->find($id);
        $attributes = $this->attribute->where('parent_id', 0)->get();
        //   dd($data->tagsLanguage('vi')->get());
        $category_id = $data->category_id;
        $htmlselect = $this->categoryProduct->getHtmlOption($category_id);
        $htmlselectBTS = $this->categoryProduct->getHtmlOption($data->bo_suu_tap);

        $supplier = $this->supplier->all();
        return view("admin.pages.product.edit", [
            'option' => $htmlselect,
            'optionBTS' => $htmlselectBTS,
            'data' => $data,
            'attributes' => $attributes,
            'supplier' => $supplier
        ]);
    }
    public function update(ValidateEditProduct $request, $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                "masp" => $request->input('masp') ?? null,
                "price" => $request->input('price') ?? 0,
                "old_price" => $request->input('old_price') ?? 0,
                "size" => $request->input('size') ?? null,
                "color" => $request->input('color') ?? null,
                "sale" => $request->input('sale') ?? 0,
                "hot" => $request->input('hot') ?? 0,
                "bo_suu_tap" => $request->input('bo_suu_tap') ?? 0,
                "sp_km" => $request->input('sp_km') ?? 0,
                "sp_ngoc" => $request->input('sp_ngoc') ?? 0,
                "order" => $request->input('order') ?? null,
                "file3" => $request->input('file3') ?? null,
                // "pay"=>$request->input('pay'),
                // "number"=>$request->input('number'),
                "warranty" => $request->input('warranty') ?? 0,
                "view" => $request->input('view') ?? 0,
                "active" => $request->input('active'),
                "category_id" => $request->input('category_id'),
                "supplier_id" => $request->input('supplier_id') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            // dd( $dataProductUpdate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "product");
            if (!empty($dataUploadAvatar)) {
                $path = $this->product->find($id)->avatar_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductUpdate["avatar_path"] = $dataUploadAvatar["file_path"];
            }

            $dataUploadFile = $this->storageTraitUpload($request, "file", "file");
            if (!empty($dataUploadFile)) {
                $path = $this->product->find($id)->file;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductUpdate["file"] = $dataUploadFile["file_path"];
            }

            $dataUploadFile2 = $this->storageTraitUpload($request, "file2", "file");
            if (!empty($dataUploadFile2)) {
                $path = $this->product->find($id)->file2;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductUpdate["file2"] = $dataUploadFile2["file_path"];
            }

            // $dataUploadFile3 = $this->storageTraitUpload($request, "file3", "file");
            // if (!empty($dataUploadFile3)) {
            //     $path = $this->product->find($id)->file3;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataProductUpdate["file3"] = $dataUploadFile3["file_path"];
            // }

            // insert database in product table
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            // insert data product lang
            $dataProductTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemProductTranslationUpdate = [];
                $itemProductTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemProductTranslationUpdate['slug'] = $request->input('slug_' . $key);
                $itemProductTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemProductTranslationUpdate['description_seo'] = $request->input('description_seo_' . $key);
                $itemProductTranslationUpdate['title_seo'] = $request->input('title_seo_' . $key);
                $itemProductTranslationUpdate['keyword_seo'] = $request->input('keyword_seo_' . $key);
                $itemProductTranslationUpdate['content'] = $request->input('content_' . $key);

                //add
                $itemProductTranslationUpdate['content2'] = $request->input('content2_' . $key);
                $itemProductTranslationUpdate['content3'] = $request->input('content3_' . $key);
                $itemProductTranslationUpdate['content4'] = $request->input('content4_' . $key);
                $itemProductTranslationUpdate['model'] = $request->input('model_' . $key);
                $itemProductTranslationUpdate['tinhtrang'] = $request->input('tinhtrang_' . $key);
                $itemProductTranslationUpdate['baohanh'] = $request->input('baohanh_' . $key);
                $itemProductTranslationUpdate['xuatsu'] = $request->input('xuatsu_' . $key);

                $itemProductTranslationUpdate['language'] = $key;
                //  dd($itemProductTranslationUpdate);
                //  dd($product->translations($key)->first());
                if ($product->translationsLanguage($key)->first()) {
                    $product->translationsLanguage($key)->first()->update($itemProductTranslationUpdate);
                } else {
                    $product->translationsLanguage($key)->create($itemProductTranslationUpdate);
                }
                //  $dataProductTranslationUpdate[] = $itemProductTranslationUpdate;
                //   $dataProductTranslationUpdate[] = new ProductTranslation($itemProductTranslationUpdate);
            }
            //    dd($product->translations);
            //   $productTranslation =   $product->translations()->saveMany($dataProductTranslationUpdate);
            //  $productTranslation =   $product->translations()->createMany($dataProductTranslationUpdate);

            // dd($product->translations);

            // insert attribute to product
            if ($request->has("attribute")) {
                $attribute_ids = [];
                foreach ($request->input('attribute') as $attributeItem) {
                    if ($attributeItem) {
                        $attributeInstance = $this->attribute->find($attributeItem);
                        $attribute_ids[] = $attributeInstance->id;
                    }
                }

                $attribute = $product->attributes()->sync($attribute_ids);
            }

            // insert database to product_images table
            if ($request->hasFile("image")) {
                //
                //   $product->images()->where("product_id", $id)->delete();
                $dataProductImageUpdate = [];
                foreach ($request->file('image') as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
                    $itemImage = [
                        "name" => $dataProductImageDetail["file_name"],
                        "image_path" => $dataProductImageDetail["file_path"]
                    ];
                    $dataProductImageUpdate[] = $itemImage;
                }
                // insert database in product_images table by createMany
                // dd($dataProductImageUpdate);
                $product->images()->createMany($dataProductImageUpdate);
                //  dd($product->images);
            }
            //  dd($product->images);
            // insert database to product_tags table
            $tag_ids = [];
            foreach ($this->langConfig as $key => $value) {

                if ($request->has("tags_" . $key)) {
                    foreach ($request->input('tags_' . $key) as $tagItem) {
                        $tagInstance = $this->tag->firstOrCreate(["name" => $tagItem]);
                        $tag_ids[$tagInstance->id] = ['language' => $key];
                    }
                    //   $product->tags()->attach($tag_ids, ['language' => $key]);
                    // Các syncphương pháp chấp nhận một loạt các ID để ra trên bảng trung gian. Bất kỳ ID nào không nằm trong mảng đã cho sẽ bị xóa khỏi bảng trung gian.
                }
            }
            // dd($tag_ids);
            $product->tags()->sync($tag_ids);
            //  dd($product->tags);
            // end update tag


            if ($request->has("priceOption")) {
                //
                $dataProductOptionCreate = [];
                foreach ($request->input('priceOption') as $key => $value) {
                    if ($value || $request->input('sizeOption')[$key] || $request->input('old_priceOption')[$key]) {


                        // $file_path = null;

                        // if ($request->file('avatar_type')[$key] ?? false) {

                        //     $arr = $request->file('avatar_type')[$key];

                        //     $dataProductImageDetail = $this->storageTraitUploadMutiple2($arr, "product");

                        //     $file_path = $dataProductImageDetail["file_path"];
                        // }

                        $dataProductOptionCreate[] = [
                            "price" => $request->input('priceOption')[$key],
                            "old_price" => $request->input('old_priceOption')[$key],
                            "size" =>  $request->input('sizeOption')[$key],
                            "color" =>  null,
                            "avatar_type" =>  null,
                        ];
                    }
                }
                // dd($dataProductOptionCreate);
                // insert database in product_images table by createMany
                $product->options()->createMany($dataProductOptionCreate);
            }

            if ($request->has("idOption")) {
                //
                foreach ($request->input('idOption') as $key => $value) {
                    if ($value && ($request->input('priceOptionOld')[$key] || $request->input('sizeOptionOld')[$key] || $request->input('old_priceOptionOld')[$key])) {
                        $option = $this->option->find($value);
                        if ($option) {

                            // if ($request->file('avatar_typeOld')[$key] ?? false) {

                            //     $arr = $request->file('avatar_typeOld')[$key];

                            //     $dataProductImageDetail = $this->storageTraitUploadMutiple2($arr, "product");

                            //     $file_path = $dataProductImageDetail["file_path"];
                            // } else {
                            //     $file_path = $option->avatar_type;
                            // }


                            $dataProductOptionUpdate = [
                                "price" => $request->input('priceOptionOld')[$key],
                                "old_price" => $request->input('old_priceOptionOld')[$key],
                                "size" =>  $request->input('sizeOptionOld')[$key],
                                "color" =>  null,
                                "avatar_type" =>  null,
                            ];
                            $option->update($dataProductOptionUpdate);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with("alert", "Sửa sản phẩm thành công");
        } catch (\Exception $exception) {
            //throw $th;
            dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.index')->with("error", "Sửa sản phẩm không thành công");
        }
    }

    //Option

    public function listProductOption($product_id, Request $request)
    {

        $data = $this->option->where('product_id', $product_id)->get();

        return view(
            "admin.pages.product.option-list",
            [
                'data' => $data,
                'product_id' => $product_id,
            ]
        );
    }

    public function addProductOption($product_id, Request $request = null)
    {
        $htmlselect = $this->categoryProduct->getHtmlOption();
        $attributes = $this->attribute->find(1);
        $supplier = $this->supplier->all();
        return view(
            "admin.pages.product.option-add",
            [
                'option' => $htmlselect,
                'attributes' => $attributes,
                'product_id' => $product_id,
                'request' => $request
            ]
        );
    }

    public function optionStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductOptionCreate = [
                "size" => $request->input('size'),
                "color" => $request->input('color'),
                "price" => $request->input('price'),
                "old_price" => $request->input('old_price'),
                "product_id" => $request->input('product_id'),
                "color_id" => $request->input('attribute'),
                "stock" => $request->input('stock'),
                "active" => $request->input('active') ?? 0,
                "order" => $request->input('order') ?? 0,
                "is_default" => $request->input('is_default') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            //    dd($dataProductCreate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            if (!empty($dataUploadAvatar)) {
                $dataProductOptionCreate["avatar_type"] = $dataUploadAvatar["file_path"];
            }

            $dataUploadAvatar = $this->storageTraitUpload($request, "hover_path", "product");
            if (!empty($dataUploadAvatar)) {
                $dataProductOptionCreate["hover_path"] = $dataUploadAvatar["file_path"];
            }

            // dd($dataProductCreate);
            // insert database in product table
            $option = $this->option->create($dataProductOptionCreate);
            // insert data product lang

            if ($request->hasFile("image")) {
                //
                //   $product->images()->where("product_id", $id)->delete();
                $dataProductOptionImageUpdate = [];
                foreach ($request->file('image') as $fileItem) {
                    $dataProductOptionImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
                    $itemImage = [
                        "name" => $dataProductOptionImageDetail["file_name"],
                        "image_path" => $dataProductOptionImageDetail["file_path"]
                    ];
                    $dataProductOptionImageUpdate[] = $itemImage;
                }
                // insert database in product_images table by createMany
                // dd($dataProductImageUpdate);
                $option->images()->createMany($dataProductOptionImageUpdate);
                //  dd($product->images);
            }

            DB::commit();
            return redirect()->route('admin.product.option', ['product_id' => $request->input('product_id')])->with("alert", "Thêm màu sản phẩm thành công");
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.option', ['product_id' => $request->input('product_id')])->with("error", "Thêm màu sản phẩm không thành công");
        }
    }

    public function editProductOption($id)
    {
        $attributes = $this->attribute->find(1);
        $data = $this->option->find($id);
        return view("admin.pages.product.option-edit", [
            'data' => $data,
            'attributes' => $attributes,
        ]);
    }

    public function updateProductOption(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductOptionUpdate = [
                "size" => $request->input('size'),
                "color" => $request->input('color'),
                "price" => $request->input('price'),
                "old_price" => $request->input('old_price'),
                "product_id" => $request->input('product_id'),
                "color_id" => $request->input('attribute'),
                "stock" => $request->input('stock'),
                "active" => $request->input('active') ?? 0,
                "order" => $request->input('order') ?? null,
                "is_default" => $request->input('is_default') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            // dd( $dataProductUpdate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            if (!empty($dataUploadAvatar)) {
                $path = $this->option->find($id)->avatar_type;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductOptionUpdate["avatar_type"] = $dataUploadAvatar["file_path"];
            }

            $dataUploadAvatar = $this->storageTraitUpload($request, "hover_path", "product");
            if (!empty($dataUploadAvatar)) {
                $path = $this->option->find($id)->hover_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductOptionUpdate["hover_path"] = $dataUploadAvatar["file_path"];
            }

            // insert database in product table
            $this->option->find($id)->update($dataProductOptionUpdate);

            $option = $this->option->find($id);

            if ($request->hasFile("image")) {
                //
                //   $product->images()->where("product_id", $id)->delete();
                $dataProductOptionImageUpdate = [];
                foreach ($request->file('image') as $fileItem) {
                    $dataProductOptionImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
                    $itemImage = [
                        "name" => $dataProductOptionImageDetail["file_name"],
                        "image_path" => $dataProductOptionImageDetail["file_path"]
                    ];
                    $dataProductOptionImageUpdate[] = $itemImage;
                }
                // insert database in product_images table by createMany
                // dd($dataProductImageUpdate);
                $option->images()->createMany($dataProductOptionImageUpdate);
                //  dd($product->images);
            }


            DB::commit();
            return redirect()->route('admin.product.option', ['product_id' => $request->input('product_id')])->with("alert", "Sửa màu sản phẩm thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.option', ['product_id' => $request->input('product_id')])->with("error", "Sửa màu sản phẩm không thành công");
        }
    }

    public function loadOptionProduct(Request $request)
    {
        $dataView = ['i' => $request->i];
        return response()->json([
            "code" => 200,
            "html" =>  view('admin.components.load-option-product', $dataView)->render(),
            "message" => "success"
        ], 200);
    }

    public function loadOptionProductSize(Request $request)
    {
        $dataView = ['i' => $request->i];
        return response()->json([
            "code" => 200,
            "html" =>  view('admin.components.load-option-product-size', $dataView)->render(),
            "message" => "success"
        ], 200);
    }

    //Size

    public function listProductSize($product_id, $option_id, Request $request)
    {

        $data = $this->size->where('option_id', $option_id)->get();

        return view(
            "admin.pages.product.size-list",
            [
                'data' => $data,
                'option_id' => $option_id,
                'product_id' => $product_id,
            ]
        );
    }


    public function addProductSize($product_id, $option_id, Request $request = null)
    {
        $htmlselect = $this->categoryProduct->getHtmlOption();
        $attributes = $this->attribute->find(2);
        $supplier = $this->supplier->all();
        return view(
            "admin.pages.product.size-add",
            [
                'option' => $htmlselect,
                'product_id' => $product_id,
                'attributes' => $attributes,
                'option_id' => $option_id,
                'request' => $request
            ]
        );
    }

    public function loadDefaultOption($id)
    {
        $option = $this->option->find($id);
        $is_default = $option->is_default;

        if ($is_default) {
            $defaultUpdate = 0;
        } else {
            $defaultUpdate = 1;
        }
        $updateResult =  $option->update([
            'is_default' => $defaultUpdate,
        ]);

        $option = $this->option->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-default', ['data' => $option, 'type' => 'Màu'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function sizeStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductSizeCreate = [
                "size" => $request->input('size'),
                "price" => $request->input('price'),
                "old_price" => $request->input('old_price'),
                "product_id" => $request->input('product_id'),
                "option_id" => $request->input('option_id'),
                "size_id" => $request->input('attribute'),
                "stock" => $request->input('stock'),
                "active" => $request->input('active') ?? 0,
                "order" => $request->input('order') ?? 0,
                "is_default" => $request->input('is_default') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];

            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            if (!empty($dataUploadAvatar)) {
                $dataProductSizeCreate["avatar_type"] = $dataUploadAvatar["file_path"];
            }

            // dd($dataProductCreate);
            // insert database in product table
            $size = $this->size->create($dataProductSizeCreate);
            // insert data product lang

            DB::commit();
            return redirect()->route('admin.product.size', ['product_id' => $request->input('product_id'), 'option_id' => $request->input('option_id')])->with("alert", "Thêm size sản phẩm thành công");
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.size', ['product_id' => $request->input('product_id'), 'option_id' => $request->input('option_id')])->with("error", "Thêm size sản phẩm không thành công");
        }
    }


    public function editProductSize($id)
    {
        $data = $this->size->find($id);
        $attributes = $this->attribute->find(2);
        return view("admin.pages.product.size-edit", [
            'data' => $data,
            'attributes' => $attributes,
        ]);
    }

    public function updateProductSize(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductSizeUpdate = [
                "size" => $request->input('size'),
                "price" => $request->input('price'),
                "old_price" => $request->input('old_price'),
                "product_id" => $request->input('product_id'),
                "option_id" => $request->input('option_id'),
                "stock" => $request->input('stock'),
                "active" => $request->input('active') ?? 0,
                "order" => $request->input('order') ?? null,
                "is_default" => $request->input('is_default') ?? 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            // dd( $dataProductUpdate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            if (!empty($dataUploadAvatar)) {
                $path = $this->size->find($id)->avatar_type;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataProductSizeUpdate["avatar_type"] = $dataUploadAvatar["file_path"];
            }


            // insert database in product table
            $this->size->find($id)->update($dataProductSizeUpdate);

            $size = $this->size->find($id);


            DB::commit();
            return redirect()->route('admin.product.size', ['product_id' => $request->input('product_id'), 'option_id' => $request->input('option_id')])->with("alert", "Sửa size sản phẩm thành công");
        } catch (\Exception $exception) {
            //throw $th;

            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.size', ['product_id' => $request->input('product_id'), 'option_id' => $request->input('option_id')])->with("error", "Sửa size sản phẩm không thành công");
        }
    }

    //Mã sản phẩm
    public function listProductCoupon($product_id, Request $request)
    {

        $data = $this->coupon->where('product_id', $product_id)->get();

        return view(
            "admin.pages.product.coupon-list",
            [
                'data' => $data,
                'product_id' => $product_id,
            ]
        );
    }

    public function addProductCoupon($product_id, Request $request = null)
    {
        // $htmlselect = $this->categoryProduct->getHtmlCoupon();
        $attributes = $this->attribute->find(1);
        $supplier = $this->supplier->all();
        return view(
            "admin.pages.product.coupon-add",
            [
                // 'coupon' => $htmlselect,
                'attributes' => $attributes,
                'product_id' => $product_id,
                'request' => $request
            ]
        );
    }

    public function couponStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCouponCreate = [
                "name" => $request->input('name'),
                "code" => $request->input('code'),
                "quantity" => $request->input('quantity'),
                "feature" => $request->input('feature'),
                "coupon_number" => $request->input('coupon_number'),
                "product_id" => $request->input('product_id'),
                "active" => $request->input('active') ?? 0,
            ];
            //    dd($dataProductCreate);
            // $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            // if (!empty($dataUploadAvatar)) {
            //     $dataProductCouponCreate["avatar_type"] = $dataUploadAvatar["file_path"];
            // }

            // $dataUploadAvatar = $this->storageTraitUpload($request, "hover_path", "product");
            // if (!empty($dataUploadAvatar)) {
            //     $dataProductCouponCreate["hover_path"] = $dataUploadAvatar["file_path"];
            // }

            // dd($dataProductCreate);
            // insert database in product table
            $coupon = $this->coupon->create($dataProductCouponCreate);
            // insert data product lang

            // if ($request->hasFile("image")) {
            //     //
            //     //   $product->images()->where("product_id", $id)->delete();
            //     $dataProductCouponImageUpdate = [];
            //     foreach ($request->file('image') as $fileItem) {
            //         $dataProductCouponImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
            //         $itemImage = [
            //             "name" => $dataProductCouponImageDetail["file_name"],
            //             "image_path" => $dataProductCouponImageDetail["file_path"]
            //         ];
            //         $dataProductCouponImageUpdate[] = $itemImage;
            //     }
            //     // insert database in product_images table by createMany
            //     // dd($dataProductImageUpdate);
            //     $coupon->images()->createMany($dataProductCouponImageUpdate);
            //     //  dd($product->images);
            // }

            DB::commit();
            return redirect()->route('admin.product.coupon', ['product_id' => $request->input('product_id')])->with("alert", "Thêm màu sản phẩm thành công");
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.coupon', ['product_id' => $request->input('product_id')])->with("error", "Thêm màu sản phẩm không thành công");
        }
    }

    public function editProductCoupon($id)
    {
        $attributes = $this->attribute->find(1);
        $data = $this->coupon->find($id);
        return view("admin.pages.product.coupon-edit", [
            'data' => $data,
            'attributes' => $attributes,
        ]);
    }

    public function updateProductCoupon(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductCouponUpdate = [
                "name" => $request->input('name'),
                "code" => $request->input('code'),
                "quantity" => $request->input('quantity'),
                "feature" => $request->input('feature'),
                "coupon_number" => $request->input('coupon_number'),
                "product_id" => $request->input('product_id'),
                "active" => $request->input('active') ?? 0,
            ];
            // dd( $dataProductUpdate);
            // $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_type", "product");
            // if (!empty($dataUploadAvatar)) {
            //     $path = $this->coupon->find($id)->avatar_type;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataProductCouponUpdate["avatar_type"] = $dataUploadAvatar["file_path"];
            // }

            // $dataUploadAvatar = $this->storageTraitUpload($request, "hover_path", "product");
            // if (!empty($dataUploadAvatar)) {
            //     $path = $this->coupon->find($id)->hover_path;
            //     if ($path) {
            //         Storage::delete($this->makePathDelete($path));
            //     }
            //     $dataProductCouponUpdate["hover_path"] = $dataUploadAvatar["file_path"];
            // }

            // insert database in product table
            $this->coupon->find($id)->update($dataProductCouponUpdate);

            $coupon = $this->coupon->find($id);

            // if ($request->hasFile("image")) {
            //     //
            //     //   $product->images()->where("product_id", $id)->delete();
            //     $dataProductCouponImageUpdate = [];
            //     foreach ($request->file('image') as $fileItem) {
            //         $dataProductCouponImageDetail = $this->storageTraitUploadMutiple($fileItem, "product");
            //         $itemImage = [
            //             "name" => $dataProductCouponImageDetail["file_name"],
            //             "image_path" => $dataProductCouponImageDetail["file_path"]
            //         ];
            //         $dataProductCouponImageUpdate[] = $itemImage;
            //     }
            //     // insert database in product_images table by createMany
            //     // dd($dataProductImageUpdate);
            //     $coupon->images()->createMany($dataProductCouponImageUpdate);
            //     //  dd($product->images);
            // }


            DB::commit();
            return redirect()->route('admin.product.coupon', ['product_id' => $request->input('product_id')])->with("alert", "Sửa màu sản phẩm thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.product.coupon', ['product_id' => $request->input('product_id')])->with("error", "Sửa màu sản phẩm không thành công");
        }
    }

    public function loadDefaultSize($id)
    {
        $size = $this->size->find($id);
        $is_default = $size->is_default;

        if ($is_default) {
            $defaultUpdate = 0;
        } else {
            $defaultUpdate = 1;
        }
        $updateResult =  $size->update([
            'is_default' => $defaultUpdate,
        ]);

        $size = $this->size->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-default', ['data' => $size, 'type' => 'size'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function destroySize($id)
    {
        return $this->deleteTrait($this->size, $id);
    }

    public function destroyCoupon($id)
    {
        return $this->deleteTrait($this->coupon, $id);
    }

    public function destroy($id)
    {
        return $this->deleteTrait($this->product, $id);
    }

    public function destroyProductImage($id)
    {
        return $this->deleteImageTrait($this->productImage, $id);
    }

    public function destroyProductOptionImage($id)
    {
        return $this->deleteImageTrait($this->optionImage, $id);
    }

    public function excelExportDatabase()
    {
        return Excel::download(new ExcelExportsDatabase(config('excel_database.product')), config('excel_database.product.excelfile'));
    }
    public function excelImportDatabase()
    {
        $path = request()->file('fileExcel')->getRealPath();
        Excel::import(new ExcelImportsDatabase(config('excel_database.product')), $path);
    }

    public function destroyOption($id)
    {
        return $this->deleteTrait($this->option, $id);
    }


    public function destroyOptionProduct($id)
    {
        return $this->deleteTrait($this->option, $id);
    }

    public function destroyOptionProductSize($id)
    {

        return $this->deleteTrait($this->optionValue, $id);
    }
}
