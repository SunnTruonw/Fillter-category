<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    //
    protected $table = "product_variants";
    protected $guarded = [];
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }
}
