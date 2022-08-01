@extends('frontend.layouts.main')
@section('title', $header['seo_home']->name)
@section('image', asset($header['seo_home']->image_path))
@section('keywords', $header['seo_home']->slug)
@section('description', $header['seo_home']->value)
@section('abstract', $header['seo_home']->slug)

@section('content')
<div class="content-wrapper">
    <div class="main">
        <div class="slide">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-12 col-sm-12 col-md-7">
						@isset($slider)
							<div class="box-slide autoplay1 cate-arrows-1">
								@foreach ($slider as $item)
								<div class="item-slide">
									<a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
								</div>
								@endforeach
							</div>
						@endisset
                    </div>
					@if (isset($slidesub)&&$slidesub)
					<div class="col-12 col-sm-12 col-md-5 padding_slide d-md-block d-none">
                        @foreach ($slidesub->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                            @php
                                $tran=$item->translationsLanguage()->first();
                            @endphp
                            <div class="slide_sub_home">
                                <a href="{{ $item->slug }}"><img src="{{ $item->image_path != null ?  asset($item->image_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}"></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 d-md-none" style="margin-top: 16px;">
                        <div class="box-slide autoplay1 cate-arrows-1">
                            @foreach ($slidesub->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                @php
                                    $tran=$item->translationsLanguage()->first();
                                @endphp
                                <div class="slide_sub_home">
                                    <a href="{{ $item->slug }}"><img src="{{ $item->image_path != null ?  asset($item->image_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
					@endif
				</div>
			</div>
        </div>
        
        @if( isset($banner3) && $banner3->count()>0 )
        <div class="section_banner_home">
            <div class="container-fluid">
                <div class="row">
                    <div class="list-banner">
                        @foreach($banner3->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                        <div class="item">
                            <div class="box">
                                <div class="image">
                                    <a href="{{ $item->slug }}">
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                                {{--<div class="info">
                                    <h3>
                                        <a href="{{ $item->slug }}">
                                            {{ $item->name }}
                                        </a>
                                    </h3>
                                </div>--}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
		
		<div class="ss03_product">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">Mua sắm theo Danh mục</div>
                        </div>
                    </div>
					<div class="col-12 col-sm-12">
						@if( isset($categoryProductRoot) && $categoryProductRoot->count()>0 )
                            <div class="row">
                                
                                @foreach ($categoryProductRoot as $cate)
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6 product-item2">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $cate->slug_full }}">
                                                    <img src="{{ $cate->avatar_path != null ?  asset($cate->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $cate->name }}">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ $cate->slug_full }}">{{ $cate->name }}</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6 product-item2">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{route('product.sale')}}">
                                                    <img src="{{asset('./frontend/images/sale_icon_home.jpg')}}" alt="sale icon home">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{route('product.sale')}}">Sản phẩm Sale off</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>

        <div class="deal_sale">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="title-heading-sale">
                            <div class="title">
                                Kỷ niệm 20 năm thành lập
                            </div>
                            <span class="sale_all">
                                <a href="#">Xem tất cả</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="list_deal_sale">
                        @if(isset($saleling) && $saleling)
                            @foreach($saleling->childs()->where('active', 1)->orderby('order')->get() as $value)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6 item">
                                    <div class="wapper-box-sale">
                                        <div class="wapper-box-sale">
                                            <img src="{{asset($value->image_path)}}" alt="{{$value->name}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        @if (isset($productNew) && $productNew)
        <div class="ss04_product">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">Danh mục Sản phẩm</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 tab-ss04">
                        <div class="tab-ss04-desktop">
                            <ul class="tabs tabs-title">
                                <li class="tab-link active" onclick="openTab('Tab1')" data-id="Tab1">Ưu đãi tốt nhất <span class="hot-item">Hot</span></li>
                                <li class="tab-link" onclick="openTab('Tab2')" data-id="Tab2">Sản phẩm bán chạy</li>
                                <li class="tab-link" onclick="openTab('Tab3')" data-id="Tab3">Sản phẩm mới</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="tab list-product active" id="Tab1">
                            <div class="row">
                                @foreach ($productHot as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link=$product->slug_full;
                                @endphp
                                    <div class="col-min-1500 col-lg-3 col-md-4 col-sm-6 col-6">
                                        <div class="grid__column three-twelfths mobile--one-half slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0">
                                            <div data-product-id="62a82c5bedcfe5596a2c471c" class="product-grid product not-sale-tag">
                                                <div class="product-grid__thumbnail">
                                                    <div  class="product-grid__image ">
                                                        <a href="{{ $link }}" tabindex="0" class="">
                                                            @if($product->options)
                                                            @php
                                                                $optionIsStock = $product->options()->where('stock',1)->orderBy('order')->first();
                                                            @endphp
                                                                <img class="big-image" src="{{ asset($optionIsStock->avatar_type)}}" alt="{{ $product->name }}">
                                                                <img class="has-hover" src="{{asset($optionIsStock->hover_path)}}" alt="{{ $optionIsStock->name }}" >
                                                            @endif
                                                        </a>    
                                                    </div> 
                                                   
                                                    <div class="product-grid__content">
                                                        @if($product->options)
                                                        @php
                                                            $h = 0;
                                                        @endphp
                                                        <div class="product-grid__options">
                                                            <div data-option-id="tshirt_color" class="options-color">
                                                                @foreach($product->options()->orderBy('order')->get() as $item)
                                                                    @if($item->stock)
                                                                        @php
                                                                            $h++;
                                                                        @endphp
                                                                        <div rel-script="option-color-change" data-value="mix-mau-{{$h}}" class="option-color__item" >
                                                                            <span class="checkmark @if($h == 1) active @endif" style="background-color: {{$item->color}};" data-url="{{asset($item->avatar_type)}}"></span>
                                                                        </div>
                                                                    @endif 
                                                                @endforeach
                                                            </div>
                                                        </div> 
                                                        @endif
                                                        <h3 class="product-grid__title">
                                                            <a href="{{ $link }}" rel-script="product-title" tabindex="0">
                                                            {{ $product->name }}
                                                            </a>
                                                        </h3> 
                                                        <div class="product-grid__prices">
                                                            <div rel-script="product-price" class="product-prices">
                                                            @if($product->price && $product->old_price > 0)
                                                                <span style="color: red; margin-left: 5px;">-{{ceil(100 -($product->price)*100/($product->old_price))}}%</span>
                                                                <del id="old-price">{{ number_format($product->old_price) }}{{ $unit }}</del> 
                                                            @endif
                                                                <ins id="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
                                                            </div>
                                                        </div>
                                                        @if($product->stars()->count()>0)
                                                        <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'"> 
                                                            <div data-review-count="215" data-review-avg="5" class="reviews-rating">
                                                                @php
                                                                    $avgRating = 0;
                                                                $sumRating = array_sum(array_column($product->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                                $countRating = count($product->stars()->where('active', 1)->get());
                                                                if ($countRating != 0) {
                                                                    $avgRating = $sumRating / $countRating;
                                                                }
                                                                @endphp
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $avgRating)
                                                                        {{--<div class="reviews-rating__star is-active"></div> --}}
                                                                        <i class="star-bold fas fa-star"></i>
                                                                    @else
                                                                         <i class="star-bold far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                                <div class="reviews-rating__number">({{$product->stars()->count()}} đánh giá)</div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                            <div class="reviews-rating">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="star-bold far fa-star"></i>
                                                                @endfor
                                                                <div class="reviews-rating__number">(chưa có đánh giá)</div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(isset($product->coupons) && $product->coupons()->count() > 0)
                                                        @php
                                                            $coupon = $product->coupons->first();
                                                        @endphp
                                                            <span class="product-grid__hint">
                                                                <div><span class="product-pricing-hint text--primary">{{$coupon->name ?? ''}}</span></div>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                         </div>
                    </div>

                    <div class="tab list-product" id="Tab2" style="display: none;">
                        <div class="row">
                            @foreach ($productsHeart as $product)
                            @php
                                $tran=$product->translationsLanguage()->first();
                                $link=$product->slug_full;
                            @endphp
                                <div class="col-min-1500 col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="grid__column three-twelfths mobile--one-half slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0">
                                        <div data-product-id="62a82c5bedcfe5596a2c471c" class="product-grid product not-sale-tag">
                                            <div class="product-grid__thumbnail">
                                                <div  class="product-grid__image ">
                                                    <a href="{{ $link }}" tabindex="0" class="">
                                                        @if($product->options)
                                                        @php
                                                            $optionIsStock = $product->options()->where('stock',1)->orderBy('order')->first();
                                                        @endphp
                                                            <img class="big-image" src="{{ asset($optionIsStock->avatar_type)}}" alt="{{ $product->name }}">
                                                            <img class="has-hover" src="{{asset($optionIsStock->hover_path)}}" alt="{{ $product->name }}" >
                                                        @endif
                                                    </a>    
                                                </div> 
                                                
                                                <div class="product-grid__content">
                                                    @if($product->options)
                                                    @php
                                                        $h = 0;
                                                    @endphp
                                                    <div class="product-grid__options">
                                                        <div data-option-id="tshirt_color" class="options-color">
                                                            @foreach($product->options()->orderBy('order')->get() as $item)
                                                                @if($item->stock)
                                                                    @php
                                                                        $h++;
                                                                    @endphp


                                                                    <div rel-script="option-color-change" data-value="mix-mau-{{$h}}" class="option-color__item" >
                                                                        <span class="checkmark @if($h == 1) active @endif" style="background-color: {{$item->color}};" data-url="{{asset($item->avatar_type)}}"></span>
                                                                    </div>
                                                                @endif 
                                                            @endforeach
                                                        </div>
                                                    </div> 
                                                    @endif
                                                    
                                                    <h3 class="product-grid__title">
                                                        <a href="{{ $link }}" rel-script="product-title" tabindex="0">
                                                        {{ $product->name }}
                                                        </a>
                                                    </h3> 
                                                    <div class="product-grid__prices">
                                                        <div rel-script="product-price" class="product-prices">
                                                            @if($product->price && $product->old_price > 0)
                                                                <span style="color: red; margin-left: 5px;">-{{ceil(100 -($product->price)*100/($product->old_price))}}%</span>
                                                                <del id="old-price">{{ number_format($product->old_price) }}{{ $unit }}</del> 
                                                            @endif
                                                                <ins id="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
                                                        </div>
                                                    </div>
                                                    @if($product->stars()->count()>0)
                                                        <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                            <div data-review-count="215" data-review-avg="5" class="reviews-rating">
                                                                @php
                                                                    $avgRating = 0;
                                                                $sumRating = array_sum(array_column($product->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                                $countRating = count($product->stars()->where('active', 1)->get());
                                                                if ($countRating != 0) {
                                                                    $avgRating = $sumRating / $countRating;
                                                                }
                                                                @endphp
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $avgRating)
                                                                        {{--<div class="reviews-rating__star is-active"></div> --}}
                                                                        <i class="star-bold fas fa-star"></i>
                                                                    @else
                                                                         <i class="star-bold far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                                <div class="reviews-rating__number">({{$product->stars()->count()}} đánh giá)</div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                            <div class="reviews-rating">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="star-bold far fa-star"></i>
                                                                @endfor
                                                                <div class="reviews-rating__number">(chưa có đánh giá)</div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @if(isset($product->coupons) && $product->coupons()->count() > 0)
                                                        @php
                                                            $coupon = $product->coupons->first();
                                                        @endphp
                                                            <span class="product-grid__hint">
                                                                <div><span class="product-pricing-hint text--primary">{{$coupon->name ?? ''}}</span></div>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                     </div>
                </div>

                <div class="tab list-product" id="Tab3" style="display: none;">
                    <div class="row">
                        @foreach ($productNew as $product)
                        @php
                            $tran=$product->translationsLanguage()->first();
                            $link=$product->slug_full;
                        @endphp
                            <div class="col-min-1500 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="grid__column three-twelfths mobile--one-half slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0">
                                    <div data-product-id="62a82c5bedcfe5596a2c471c" class="product-grid product not-sale-tag">
                                        <div class="product-grid__thumbnail">
                                            <div  class="product-grid__image ">
                                                <a href="{{ $link }}" tabindex="0" class="">
                                                    @if($product->options)
                                                    @php
                                                        $optionIsStock = $product->options()->where('stock',1)->orderBy('order')->first();
                                                    @endphp
                                                            <img class="big-image" src="{{ asset($optionIsStock->avatar_type)}}" alt="{{ $product->name }}">
                                                        <img class="has-hover" src="{{asset($optionIsStock->hover_path)}}" alt="{{ $optionIsStock->name }}" >
                                                    @endif
                                                </a>    
                                            </div> 
                                           
                                            <div class="product-grid__content">
                                                @if($product->options)
                                                @php
                                                    $h = 0;
                                                @endphp
                                                <div class="product-grid__options">
                                                    <div data-option-id="tshirt_color" class="options-color">
                                                        @foreach($product->options()->orderBy('order')->get() as $item)
                                                            @if($item->stock)
                                                                @php
                                                                    $h++;
                                                                @endphp
                                                                <div rel-script="option-color-change" data-value="mix-mau-{{$h}}" class="option-color__item" >
                                                                    <span class="checkmark @if($h == 1) active @endif" style="background-color: {{$item->color}};" data-url="{{asset($item->avatar_type)}}"></span>
                                                                </div>
                                                            @endif 
                                                        @endforeach
                                                    </div>
                                                </div> 
                                                @endif
                                                
                                                <h3 class="product-grid__title">
                                                    <a href="{{ $link }}" rel-script="product-title" tabindex="0">
                                                    {{ $product->name }}
                                                    </a>
                                                </h3> 
                                                <div class="product-grid__prices">
                                                    <div rel-script="product-price" class="product-prices">
                                                        @if($product->price && $product->old_price > 0)
                                                            <span style="color: red; margin-left: 5px;">-{{ceil(100 -($product->price)*100/($product->old_price))}}%</span>
                                                            <del id="old-price">{{ number_format($product->old_price) }}{{ $unit }}</del> 
                                                        @endif
                                                            <ins id="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
                                                    </div>
                                                </div>
                                                @if($product->stars()->count()>0)
                                                <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                    <div data-review-count="215" data-review-avg="5" class="reviews-rating">
                                                        @php
                                                            $avgRating = 0;
                                                        $sumRating = array_sum(array_column($product->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                        $countRating = count($product->stars()->where('active', 1)->get());
                                                        if ($countRating != 0) {
                                                            $avgRating = $sumRating / $countRating;
                                                        }
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avgRating)
                                                                <i class="star-bold fas fa-star"></i>
                                                            @else
                                                                    <i class="star-bold far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                        <div class="reviews-rating__number">({{$product->stars()->count()}} đánh giá)</div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                    <div class="reviews-rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="star-bold far fa-star"></i>
                                                        @endfor
                                                        <div class="reviews-rating__number">(chưa có đánh giá)</div>
                                                    </div>
                                                </div>
                                            @endif
                                                @if($product->stars()->count()>0)
                                                    <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                        <div data-review-count="215" data-review-avg="5" class="reviews-rating">
                                                            @php
                                                                $avgRating = 0;
                                                            $sumRating = array_sum(array_column($product->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                            $countRating = count($product->stars()->where('active', 1)->get());
                                                            if ($countRating != 0) {
                                                                $avgRating = $sumRating / $countRating;
                                                            }
                                                            @endphp
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $avgRating)
                                                                    {{--<div class="reviews-rating__star is-active"></div> --}}
                                                                    <i class="star-bold fas fa-star"></i>
                                                                @else
                                                                        <i class="star-bold far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                            <div class="reviews-rating__number">({{$product->stars()->count()}} đánh giá)</div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="product-grid__reviews" onclick="window.location.href = '{{$link}}'">
                                                        <div class="reviews-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="star-bold far fa-star"></i>
                                                            @endfor
                                                            <div class="reviews-rating__number">(chưa có đánh giá)</div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($product->coupons) && $product->coupons()->count() > 0)
                                                    @php
                                                        $coupon = $product->coupons->first();
                                                    @endphp
                                                        <span class="product-grid__hint">
                                                            <div><span class="product-pricing-hint text--primary">{{$coupon->name ?? ''}}</span></div>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                 </div>
            </div>
                    </div>
                </div>
            </div>
        </div>	
        @endif

        @if(isset($bannerTopBoSuuTap) && $bannerTopBoSuuTap)
            <div class="section_banner_home2">
                <div class="container-fluid">
                    <div class="image">
                        <a href="">
                            <img src="{{ asset($bannerTopBoSuuTap->image_path) }}" alt="{{$bannerTopBoSuuTap->name}}">
                        </a>
                    </div>
                </div>
            </div>
        @endif
        {{--
        <div class="banner-home">
            <div class="container-fluid">
                <div class="row">
                    @if (isset($categoryProductHome)&&$categoryProductHome)
                    @foreach ($categoryProductHome as $item)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 menu_home">
                        <div class="product-transition1">
                            <div class="product-image-in">
                                <div class="images_menu">
                                    <a href="{{ $item->slug_full }}"><img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}"></a>
                                </div>
                                <h2><a href="{{ $item->slug_full }}">{{ $item->name }}</a></h2>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                    @endif
                </div>
            </div>
        </div>
        --}}
		
			
{{--<div class="section_news">
    <div class="ss04_tintuc">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="group-title">
                        <div class="title title-img">{{ __('home.tin_tuc_moi') }}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="list_feedback autoplay6-tintuc category-slide-1">
                        @if($post_home)
                            @foreach($post_home->take(-8) as $value)
                                <div class="item news_home">
                                    <div class="list_news2">
                                        <div class="item">
                                            <div class="box">
                                                <div class="image">
                                                    <a href="{{ makeLink('post',$value->id,$value->slug) }}" title="{{$value->nameL}}">
                                                        <img src="{{ $value->avatar_path != null ? asset($value->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{$value->name}}">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <h3 class="post_title">
                                                        <a href="{{ makeLink('post',$value->id,$value->slug) }}" title="{{$value->nameL}}">
                                                            {{$value->name}}
                                                        </a>
                                                    </h3>  
                                                    <div class="desc_home_in">
                                                        {!! $value->description !!}
                                                    </div>
                                                    <a class="btn_timhieuthem" href="{{ $link }}">Tìm hiểu thêm ></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

        @if(isset($boSuuTap) && $boSuuTap)
            <div class="wrap-ykkh">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="group-title">
                                    <div class="title title-img">{{$boSuuTap->name}}</div>
                                </div>
                                <div class="group-title-desc">
                                    <p>{{$boSuuTap->description}}</p>
                                </div>
                            </div>
                            {{--
                            <div class="col-12 col-sm-12">
                                <div class="box-wrap-ykkh-btn">
                                    <a class="pl-Button pl-Button--primary" href="">
                                        <span class="pl-Button-content">Find Your Perfect Look</span>
                                    </a>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                    <div class="container-fluid ">
                        <div class="row fix-row-ykkh">
                            @foreach($boSuuTap->childs()->where('active',1)->orderBy('order')->get() as $value)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 col-wrap-ykkh">
                                <div class="post-cate">
                                    <a class="hv-over" href="{{ route('product.bo-suu-tap',['slug' => $value->slug]) }}" title="{{$value->name}}">
                                        <img class="lazy" src="{{ $value->avatar_path != null ? asset($value->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{$value->name}}" title="{{$value->name}}">
                                        {{--
                                        <div class="flex-center mfw-absolute-full d-flex justify-content-center align-items-center">
                                           <img src="../frontend/images/icon-play-youtube.png" width="80px" height="80px">
                                        </div>
                                        --}}
                                    </a>
                                    <h3 class="title title-video">
                                        <a class="smooth" href="{{$value->slug}}" title="{{$value->name}}">{{$value->name}}</a>
                                    </h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (isset($hotro)&&$hotro)
        <div class="support">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($hotro->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                        @php
                            $tran=$item->translationsLanguage()->first();
                        @endphp
                        <div class="col-xs-4 item">
                            <div class="box_item">
                                <div class="icon">
                                    <img src="{{ $item->image_path != null ?  asset($item->image_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}">
                                </div>
                                <div class="info">
                                    <div class="title">{{ $tran->name }}</div>
                                    <div class="desc">
                                        <p>{!! $tran->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- <div class="col-sm-3 col-12 block-content-left">
            @isset($sidebar)
                @include('frontend.components.sidebar',[
                    "categoryProduct"=>$sidebar['categoryProduct'],
                    "categoryPost"=>$sidebar['categoryPost'],
                    "categoryProductActive"=>$categoryProductActive  ?? null,
                    "postsHot"=>$sidebar['postsHot'],
                    "support_online"=>$sidebar['support_online'],
                    'fill'=>true,
                    'product'=>true,
                    'post'=>false,
                ])
            @endisset
        </div> --}}
    </div>
</div>


        </div>
{{--
        <div class="wrap-content-main wrap-template-contact template-detail">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="contact-form">
                            <div class="form">
                                <p>Liên hệ ngay với chúng tôi:</p>
                                <div class="desc_lienhe">Nếu bạn có bất kỳ thắc mắc nào vui lòng liên hệ với chúng tôi qua form dưới đây hoặc gọi trực tiếp qua hotline của chi nhánh gần bạn nhất.</div>
                                <form action="{{route('contact.storeAjax')}}" data-url="{{route('contact.storeAjax')}}" data-ajax="submit"
                                    data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
                                    <input type="hidden" name="_token" value="bR7KzqbSW1wuflMdgAa91PrZYeOm9L2wkAwySLpo" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Họ tên <span>*</span></label>
                                            <input type="text" placeholder="Họ tên" required="required" name="name" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Email <span>*</span></label>
                                            <input type="text" placeholder="Email" required="required" name="email" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Điện thoại <span>*</span></label>
                                            <input type="text" placeholder="Điện thoại" required="required" name="phone" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Chọn sản phẩm  <span>*</span></label>
                                            <select name="chu_de" class="form-control">
                                                @foreach($productContactHome as $value)
                                                 <option value="{{$value->name}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label>Nội dung tư vấn</label>
                                            <textarea name="content" placeholder="Nội dung" id="noidung" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button class="hvr-float-shadow">Gửi thông tin</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="contact-infor">
                            <div class="infor">
                                <div class="address">
                                    <div class="footer-layer">
                                        <img src="{{asset('../frontend/images/banner-gt.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="wrap-content-main wrap-content-map">
            <div class="map">
                @if($footer['map'])
                    {!! $footer['map']->content !!}
                @endif
            </div>
        </div>--}}
        
        @if (isset($modalHome)&&$modalHome)
        <div class="modal fade modal-First" id="modal-first" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"  image="">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            {{--
                            <span aria-hidden="true">&times;</span>
                            --}}
                        </button>

                        <div class="image-modal">
                            <div class="image">
                                <img src="{{ asset($modalHome->image_path) }}" alt="">
                            </div>
                            <div class="newsletter-content">
                                {{--<h4>Up to <span>20% Off</span></h4>--}}
                                <h2>{{ $modalHome->name }}</h2>
                                <div class="dec">{!! $modalHome->description !!}</div>
                                <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST" class="input-wrapper input-wrapper-inline input-wrapper-round">
                                    @csrf
                                    <input type="text" class="form-control" name="name" placeholder="Họ tên *">
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại *" required>
                                    <input type="text" class="form-control" name="content" placeholder="Sản phẩm mua *" required>
                                    <button>Đăng ký ngay <i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection
@section('js')
    <script>
        function openTab(tabName) {
        var i;
        var x = document.getElementsByClassName("tab");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(tabName).style.display = "block";  
        }
        $(document).on('click','.tab-link', function(){
            let id = $(this).data('id');
            $('.tab-link').removeClass('active');
            $(this).addClass('active');

            $('.tab').removeClass('active');
            $('#'+id).addClass('active');
        })

        $(document).on('click','.swatch-element', function(){
            let id = $(this).data('id');
            $('.swatch-element').removeClass('active');
            $(this).addClass('active');

            $('.tabs').removeClass('active');
            $('#'+id).addClass('active');
        })
      
    </script>
    <script>
        $(function(){
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
              $('.autoplay4-pro').slick('setPosition');
            });
        });
       /*setTimeout(() => $('#modal-first').modal('show'), 10000);*/
    </script>
    <script>
        $(function() {
            var now = new Date();
            var date = now.getDate();
            var month = (now.getMonth()+1);
            var year =  now.getFullYear();
            var timer;
                var then = year+'/'+month+'/'+date+' 23:59:59';
                var now = new Date();
                var compareDate = new Date(then) - now.getDate();
                timer = setInterval(function () {
                    timeBetweenDates(compareDate);
                }, 1000);
                function timeBetweenDates(toDate) {
                    var dateEntered = new Date(toDate);
                    var now = new Date();
                    var difference = dateEntered.getTime() - now.getTime();
                    if (difference <= 0) {
                        clearInterval(timer);
                    } else {
                        var seconds = Math.floor(difference / 1000);
                        var minutes = Math.floor(seconds / 60);
                        var hours = Math.floor(minutes / 60);
                        var days = Math.floor(hours / 24);
                        hours %= 24;
                        minutes %= 60;
                        seconds %= 60;
                        $("#days").text(days);
                        $("#hours").text(hours);
                        $("#minutes").text(minutes);
                        $("#seconds").text(seconds);
                    }
                }
            });
    </script>
    
@endsection
