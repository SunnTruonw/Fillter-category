<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    //
    protected $table = "variant_values";
    protected $guarded = [];
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }



    public function options()
    {
        return $this->belongsToMany(
            Option::class,
            'product_variants',
            'variant_value_id',
            'option_id'
        );
    }
}
