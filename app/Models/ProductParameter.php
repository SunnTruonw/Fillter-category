<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductParameter extends Model
{
    //
    protected $table="product_parameters";
    protected $guarded = [];


    public function childs()
    {
        return $this->hasMany(ProductParameter::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(ProductParameter::class, 'parent_id', 'id');
    }
}
