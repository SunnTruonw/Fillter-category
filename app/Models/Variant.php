<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    //
    protected $table = "variants";
    protected $guarded = [];
    public function variantValues()
    {
        return $this->hasMany(VariantValue::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_variants', 'variant_id', 'option_id');
    }
}
