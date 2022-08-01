<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Components\Recusive;
use App\Models\Product;
use Illuminate\Support\Facades\App;

class CategoryProduct extends Model
{
    //
    //use SoftDeletes;
    protected $table = "category_products";
    public $parentId = "parent_id";
    protected $guarded = [];
    protected $appends = ['name', 'slug', 'slug_full', 'description', 'description_seo', 'keyword_seo', 'title_seo', 'content', 'language'];
    public function getBreadcrumbAttribute()
    {
        $listIdParent = $this->getALlCategoryParent($this->attributes['id']);
        $allData = $this->select('id')->find($listIdParent)->toArray();
        return $allData;
    }
    public function getSlugFullAttribute()
    {
        return makeLink('category_products', $this->attributes['id'], $this->getSlugAttribute());
    }

    // tạo thêm thuộc tính name
    public function getNameAttribute()
    {
        return optional($this->translationsLanguage()->first())->name;
    }
    // tạo thêm thuộc tính slug
    public function getSlugAttribute()
    {
        return optional($this->translationsLanguage()->first())->slug;
    }
    // tạo thêm thuộc tính description
    public function getDescriptionAttribute()
    {
        return optional($this->translationsLanguage()->first())->description;
    }
    // tạo thêm thuộc tính description_seo
    public function getDescriptionSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->description_seo;
    }

    // tạo thêm thuộc tính keyword_seo
    public function getKeywordSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->keyword_seo;
    }


    // tạo thêm thuộc tính title_seo
    public function getTitleSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->title_seo;
    }

    // tạo thêm thuộc tính content
    public function getContentAttribute()
    {
        return optional($this->translationsLanguage()->first())->content;
    }
    // tạo thêm thuộc tính content
    public function getLanguageAttribute()
    {
        return optional($this->translationsLanguage()->first())->language;
    }

    // lấy số sản phẩm của danh mục
    // tạo thêm thuộc tính name
    public function getCountProductAttribute()
    {
        $pro = new Product();
        $listId = $this->getALlCategoryChildrenAndSelf($this->attributes['id']);
        $count = $pro->whereIn('category_id', $listId)->count();
        return $count;
    }

    public static function getHtmlOption($parentId = "")
    {
        $data = self::all();
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }
    public static function getHtmlOptionEdit($parentId = "", $id)
    {
        $data = self::all()->where('id', '<>', $id);
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }


    // lấy html option có danh mục cha là $Id
    public static function getHtmlOptionAddWithParent($id)
    {
        $data = self::all();
        $parentId = $id;
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }
    // get admin_id was created category_product
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    // get product was created category_product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function childs()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_id', 'id');
    }

    public function getALlCategoryChildren($id)
    {
        $data = self::all();
        $rec = new Recusive();
        return  $rec->categoryRecusiveAllChild($data, $id);
    }
    public static function getALlCategoryChildrenAndSelf($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        $arrID = $rec->categoryRecusiveAllChild($data, $id);
        array_unshift($arrID, $id);
        return  $arrID;
    }
    public function getALlCategoryParent($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        return  $rec->categoryRecusiveAllParent($data, $id);
    }
    public function getALlCategoryParentAndSelf($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        $arrID = $rec->categoryRecusiveAllParent($data, $id);
        array_push($arrID, $id);
        return  $arrID;
    }

    public function translationsLanguage($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(CategoryProductTranslation::class, "category_id", "id")->where('language', '=', $language);
    }

    public function translations()
    {
        return $this->hasMany(CategoryProductTranslation::class, "category_id", "id");
    }
}
