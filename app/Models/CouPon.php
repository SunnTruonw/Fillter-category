<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouPon extends Model
{
    protected $table = "coupons";
    protected $guarded = [];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // public function getPriceAfterSaleAttribute()
    // {
    //     $sale = optional($this->product)->sale;
    //     if ($sale) {
    //         return $this->attributes['price'] * (100 - $sale) / 100;
    //     } else {
    //         return $this->attributes['price'];
    //     }
    // }
}
