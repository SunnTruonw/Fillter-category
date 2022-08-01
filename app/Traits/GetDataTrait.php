<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Helper\CartHelper;
use App\Helper\CompareHelper;
use App\Models\Supplier;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Post;
use  Illuminate\Support\Facades\App;

/**
 *
 */
trait GetDataTrait
{
    /*
     store image upload and return null || array
     @param
     $request type Request, data input
     $fieldName type string, name of field input file
     $folderName type string; name of folder store
     return array
     [
         "file_name","file_path"
     ]
    */
    public function getDataHeaderTrait($setting)
    {
        $cart = new CartHelper();
        $totalQuantity =  $cart->getTotalQuantity();
        $compare = new CompareHelper();
        $totalCompareQuantity =  $compare->getTotalQuantity();

        $header['hotline'] = $setting->find(2);
        $header['email'] = $setting->find(3);
        $header['address'] = $setting->find(6);
        $header['title'] = $setting->find(89);
        $header['logo'] = $setting->find(13);
        $header['bannerFirst'] = $setting->where('active', 1)->find(177);
        $header['socialParent'] = $setting->find(11);
        $header['seo_home'] = $setting->find(211);
        $header['muahang'] = $setting->find(234);
        $header['tai_sao'] = $setting->find(238);
        $header['tai_sao1'] = $setting->find(355);
        $header['thuong_hieu'] = $setting->find(235);
        $header['uu_dai'] = $setting->find(236);
        $header['banhang'] = $setting->find(237);
        $header['hotline_top'] = $setting->find(238);
        $header['hotline_top22'] = $setting->find(336);
        $header['totalQuantity'] = $totalQuantity;
        $header['totalCompareQuantity'] = $totalCompareQuantity;

        $lang =   App::getLocale();

        $menuP = [];
        $categoryProduct = new CategoryProduct();
        $listCategoryProduct = $categoryProduct->where([
            'active' => 1
        ])->whereIn(
            'parent_id',
            [185]
        )->orderby('order')->pluck('id');
        foreach ($listCategoryProduct as $id) {
            array_push($menuP, menuRecusive($categoryProduct, $id));
        }


        // lấy megamenu
        $menuM = [];
        // $listCategoryProduct = $categoryProduct->where([
        //     'active' => 1
        // ])->whereIn(
        //     'parent_id',
        //     [0]
        // )->orderby('order')->pluck('id');
        // foreach ($listCategoryProduct as $id) {
        //     array_push($menuM, menuRecusive($categoryProduct, $id));
        // }

        $listCategoryProduct = $categoryProduct->whereIn(
            'parent_id',
            [185]
        )->orderby('order')->pluck('id');
        foreach ($listCategoryProduct as $id) {
            array_push($menuM, menuRecusive($categoryProduct, $id));
        }

        $categoryPost = new CategoryPost();
        // menu 1 
        $menuNew1 = [];
        $listCategoryPost = $categoryPost->whereIn(
            'id',
            [56]
        )->orderby('order')->pluck('id');

        foreach ($listCategoryPost as $id) {
            array_push($menuNew1, menuRecusive($categoryPost, $id));
        }
        // menu 2 
        $menuNew2 = [];
        $listCategoryPost = $categoryPost->whereIn(
            'id',
            [62]
        )->orderby('order')->pluck('id');
        foreach ($listCategoryPost as $id) {
            array_push($menuNew2, menuRecusive($categoryPost, $id));
        }

        $menuNew3 = [];
        $listCategoryPost = $categoryPost->whereIn(
            'id',
            [57]
        )->orderby('order')->pluck('id');
        foreach ($listCategoryPost as $id) {
            array_push($menuNew3, menuRecusive($categoryPost, $id));
        }

        // menu 2 khuyen mai tin tuc
        //  $menuNew3=[];
        //  $listCategoryPost=$categoryPost->whereIn(
        //      'id',[53]
        //  )->orderby('order')->pluck('id');
        //   foreach ($listCategoryPost as $id) {
        //       array_push($menuNew3,menuRecusive($categoryPost,$id));
        //   }

        // $header['categorySearch']=$categoryProduct->where([
        //     'active'=>1
        // ])->whereIn(
        //     'id',[2]
        // )->orderby('order')->orderByDesc('created_at')->first();

        $header['menu-mega'] = [
            [
                'name' => __('home.home'),
                'slug_full' => makeLink('home'),
                'childs' => []
            ],
            ...$menuNew2,
            ...$menuM,
        ];

        $header['menu'] = [
            //[
            //    'name'=> __('home.home'),
            //    'slug_full'=>makeLink('home'),
            //    'childs'=>[
            //    ]
            //],
            // [
            //     'name'=>__('home.gioi_thieu'),
            //     'slug_full'=>makeLinkToLanguage('about-us',null,null,$lang),
            //     'childs'=>[
            //     ]
            // ],
            //...$menuM,
            ...$menuNew1,
            [
                'name' => __('home.lien_he'),
                'slug_full' => makeLinkToLanguage('contact', null, null, $lang),
            ],
        ];

        $header['menuM'] = [

            ...$menuM,
        ];

        $header['menuNew3'] = [

            ...$menuNew3,
        ];

        $header['menu_mobile'] =  [
            //[
            //  'name' => __('home.home'),
            // 'slug_full' => makeLink('home'),
            // 'childs' => []
            //],
            //[
            //   'name' => 'Hàng mới',
            //  'slug_full' => makeLinkToLanguage('new-product', null, null, $lang),
            //   'childs' => []
            //],
            // [
            //   'name' => 'Bán chạy',
            //   'slug_full' => makeLinkToLanguage('selling', null, null, $lang),
            //  'childs' => []
            //],
            ...$menuM,
            //[
            //   'name' => 'Bộ sưu tập',
            //   'slug_full' => makeLinkToLanguage('collection', null, null, $lang),
            //  'childs' => []
            //],

            ...$menuNew2,
            // ...$menuNew1,
            [
                'name' => __('home.lien_he'),
                'slug_full' => makeLinkToLanguage('contact', null, null, $lang),
            ],
        ];

        $menuGt = [];
        $listCategoryPostGT = $categoryPost->where([
            'active' => 1
        ])->whereIn(
            'id',
            [13]
        )->orderby('order')->pluck('id');
        foreach ($listCategoryPostGT as $id) {
            array_push($menuGt, menuRecusive($categoryPost, $id));
        }

        $header['productAll'] = $categoryProduct->where('active', 1)->find(185);

        return  $header;
    }

    public function getDataFooterTrait($setting)
    {
        $footer = [];
        $footer['dataAddress'] = $setting->find(19);
        $footer['linklienket'] = $setting->find(271);
        $footer['linkFooter'] = $setting->find(247);
        $footer['linkFooterBottom'] = $setting->find(97);
        $footer['registerSale'] = $setting->find(45);
        $footer['coppy_right'] = $setting->find(46);
        $footer['socialParent'] = $setting->find(47);
        $footer['pay'] = $setting->find(52);

        $footer['map'] = $setting->find(53);
        $footer['banner_shipping'] = $setting->find(75);
        $footer['banner_giua'] = $setting->find(78);
        $footer['logo_banner_shipping'] = $setting->find(77);
        $footer['nhan_tu_van'] = $setting->find(76);
        $footer['bocongthuong'] = $setting->find(155);
        $footer['maqr'] = $setting->find(66);
        //  $footer['about'] = $setting->find(100);
        $footer['doitac'] = $setting->find(365);
        $footer['timeWork'] = $setting->find(154);
        $footer['hotline'] = $setting->find(163);

        $footer['bct'] = $setting->find(241);
        $footer['dmca'] = $setting->find(242);
        $footer['bao_hanh'] = $setting->find(243);
        $footer['bao_hanh_hotline'] = $setting->find(255);
        $footer['mapss'] = $setting->find(284);

        $footer['zalo'] = $setting->find(246);

        $footer['messenger'] = $setting->find(245);

        $footer['sign_now'] = $setting->find(248);

        $categoryProduct = new CategoryProduct();
        $footer['listCategory'] = $categoryProduct->where([
            'active' => 1
        ])->whereIn(
            'parent_id',
            [185]
        )->orderby('order')->get();

        $categoryPost = new CategoryPost();
        $footer['listChinhsach'] = $categoryPost->where([
            'active' => 1
        ])->where(
            'id',
            '54'
        )->first();


        $footer['categoryProduct']  = $categoryProduct->setAppends(['count_product'])->whereIn(
            'parent_id',
            [0]
        )->get();
        $post = new Post();

        $footer['dieuKhoan'] = $post->where([
            'active' => 1,
            'id' => 5
        ])->first();



        $footer['chinhSach'] = $post->where([
            'active' => 1
        ])->find(6);

        return  $footer;
    }

    public function getDataSidebarTrait($categoryPost, $categoryProduct)
    {
        $sidebar = [];
        // lấy nhà cung cấp
        $supplier = new Supplier();
        $suppliers = $supplier->where('active', 1)->orderby('order')->get();
        $sidebar['supplier'] = $suppliers;
        // lấy thuộc tính
        $attribute = new Attribute();
        $attributes = $attribute->where([
            ['active', 1],
            ['parent_id', 0],
        ])->orderby('order')->get();
        $sidebar['attribute'] = $attributes;

        $setting = new Setting();
        // lấy sidebar
        $sidebar['banner'] = $setting->find(110);
        $sidebar['uudiem'] = $setting->find(108);
        $sidebar['slider'] = $setting->find(105);
        $sidebar['dichvu'] = $setting->find(287);
        $sidebar['support_online'] = $setting->find(269);
        // lấy product
        $product = new Product();
        $post = new Post();

        $pro1 = $product->where([
            ['active', 1]
        ])->orderByDesc('view')->limit(6)->get();

        $pro = $product->where([
            ['hot', 1],
            ['active', 1]
        ])->orderByDesc('created_at')->limit(6)->get();


        $sidebar['product'] = $pro;
        $sidebar['productViewHot'] = $pro1;
        $sidebar['categoryPost'] = $categoryPost->whereIn(
            'parent_id',
            [0]
        )->whereNotIn(
            'id',
            [14]
        )->get();

        $sidebar['categoryProduct']  = $categoryProduct->setAppends(['count_product'])->whereIn(
            'parent_id',
            [0]
        )->get();

        $sidebar['postsHot'] = $post->where([
            ['active', 1],
            ['hot', 1],
            ['category_id', 56],
        ])->orderby('order')->orderByDesc('created_at')->limit(5)->get();



        return  $sidebar;
    }
}
