<?php

namespace App\Helper;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
class CartHelper
{
    public $cartItems = [];
    public $totalQuantity = 0;
    public $totalPrice = 0;
    public $totalOldPrice = 0;

    public function __construct()
    {
        // session()->flush();

        $this->cartItems = session()->has('cart') ? session('cart') : [];
        //   $this->cartItems = Session::has('cart') ? Session::session('cart') : [];
        $this->totalQuantity = $this->getTotalQuantity();
        $this->totalPrice = $this->getTotalPrice();
        $this->totalOldPrice = $this->getTotalOldPrice();
    }
    public function add($product, $quantity = 1)
    {
        // dd($product->options);
        $coupon = $product->coupons->first();
        // dd($color, $size);
        $option_id = $product->option_id;
        if (!$product->option_id) {
            $option_id = 0;
        }
        // dd($option_id);
        // dd($option_id);

        if (isset($this->cartItems[$product->id . '-' . $option_id])) {
            $this->cartItems[$product->id . '-' . $option_id]['quantity'] +=  $quantity;
            $this->cartItems[$product->id . '-' . $option_id]['totalPriceOneItem'] = $this->getTotalPriceOneItem($this->cartItems[$product->id . '-' . $option_id]);
            $this->cartItems[$product->id . '-' . $option_id]['totalOldPriceOneItem'] = $this->getTotalOldPriceOneItem($this->cartItems[$product->id . '-' . $option_id]);
        } else {

            $cartItem = [
                'id' => $product->id,
                'color_id' => $product->color_id,
                'size_id' => $product->size_id,
                'price' => $product->price,
                'sale' => $product->sale,
                'old_price' => $product->old_price,
                'color_name' => $product->color_name,
                'size_name' => $product->size_name,
                'name' => $product->name,
                'avatar_path' => $product->avatar_path,
                'quantity' => $quantity,
                'coupon_quantity' => $coupon->quantity ?? 0,
                'coupon_number' => $coupon->coupon_number ?? 0,
                'coupon_type' => $coupon->feature ?? 0,
            ];

            // dd($cartItem);
            $cartItem['totalPriceOneItem'] = $this->getTotalPriceOneItem($cartItem);
            $cartItem['totalOldPriceOneItem'] = $this->getTotalOldPriceOneItem($cartItem);
            $this->cartItems[$product->id . '-' . $option_id] = $cartItem;
        }
        session(['cart' => $this->cartItems]);
    }

    public function remove($id, $option_id = 0)
    {
        if (isset($this->cartItems[$id . '-' . $option_id])) {
            unset($this->cartItems[$id . '-' . $option_id]);
        }
        // Session::put('cart' , $this->cartItems);
        session(['cart' => $this->cartItems]);
    }

    public function update($id, $quantity, $option_id = 0)
    {
        if (isset($this->cartItems[$id . '-' . $option_id])) {
            $this->cartItems[$id . '-' . $option_id]['quantity'] = $quantity;
            $this->cartItems[$id . '-' . $option_id]['totalPriceOneItem'] = $this->getTotalPriceOneItem($this->cartItems[$id . '-' . $option_id]);
            $this->cartItems[$id . '-' . $option_id]['totalOldPriceOneItem'] = $this->getTotalOldPriceOneItem($this->cartItems[$id . '-' . $option_id]);
        }
        //  Session::put('cart' , $this->cartItems);
        session(['cart' => $this->cartItems]);
    }
    public function clear()
    {
        $this->cartItems = [];
        session()->forget('cart');
    }
    public function getTotalPriceOneItem($item)
    {
        $t = 0;
        $t +=  $item['price'] * (100 - $item['sale']) / 100 * $item['quantity'];
        return $t;
    }
    public function getTotalOldPriceOneItem($item)
    {
        $t = 0;
        $t +=  $item['price']  * $item['quantity'];
        return $t;
    }
    public function getTotalPrice()
    {
        // dd($this->cartItems);
        $tP = 0;
        if ($this->cartItems) {
            foreach ($this->cartItems as $cartItem) {
                if (isset($cartItem['coupon_quantity']) && isset($cartItem['coupon_number']) && isset($cartItem['coupon_type']) && $cartItem['coupon_quantity'] > 0 && $cartItem['coupon_number'] > 0 && $cartItem['coupon_type'] > 0 && $cartItem['quantity'] >= $cartItem['coupon_quantity']) {
                    $tP +=  ($cartItem['price'] * (100 - $cartItem['sale']) / 100 * $cartItem['quantity']);
                    // giamr theo %
                    if ($cartItem['coupon_type'] == 1) {
                        $phanTram = ($tP * $cartItem['coupon_number']) / 100;

                        $tP = $tP - $phanTram;
                    } else {
                        //giam theo tien
                        $tP = $tP - $cartItem['coupon_number'];
                    }
                } else {
                    $tP +=  ($cartItem['price'] * (100 - $cartItem['sale']) / 100 * $cartItem['quantity']);
                }
            }
        }

        return $tP;
    }

    // public function getTotalPriceCoupon()
    // {
    //     $tP = 0;
    //     if ($this->cartItems) {
    //         foreach ($this->cartItems as $cartItem) {
    //             $tP +=  (($cartItem['price'] * (100 - $cartItem['sale']) / 100 * $cartItem['quantity']) *  $cartItem['coupon'] / 100);
    //         }
    //     }
    //     return $tP;
    // }

    public function getTotalOldPrice()
    {
        $tP = 0;
        if ($this->cartItems) {
            foreach ($this->cartItems as $cartItem) {
                $tP +=  $cartItem['price']  * $cartItem['quantity'];
            }
        }
        return $tP;
    }

    public function getTotalQuantity()
    {
        $tQ = 0;
        foreach ($this->cartItems as $cartItem) {
            $tQ += $cartItem['quantity'];
        }

        return $tQ;
    }
}
