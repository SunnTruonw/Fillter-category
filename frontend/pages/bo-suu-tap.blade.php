@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')
    <div class="content-wrapper">
        <div class="main">
            {{--
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset
            --}}
            <div class="block-product">
                @if(isset($category) && $category->childs()->count() > 0)

                <div class="block-product-category-top" id="category-product">
                    <div class="container-fluid">
                        <div class="row">   
                            

                                <div class="col-12 col-sm-12">
                                    <div class="group-title">
                                        <div class="title title-img text-left">Bộ sưu tập</div>
                                    </div>
                                </div>
                                @foreach ($category->childs()->where('active', 1)->orderBy('order')->get() as $cate)
                                    <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-12 ">
                                        <div class="product-item">
                                            <div class="box">
                                                <div class="image">
                                                    <a href="{{ route('product.bo-suu-tap',['slug' => $cate->slug]) }}">
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
                        </div>
                    </div>
                </div>
                @endif   

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-left">
                            @if(isset($data) && count($data) > 0)
                                <div class="info-count-pro">
                                    <div class="count-pro">
                                        @if (isset($category)&&$category)
                                            {{ $nameCategory }}
                                        @endif
                                    </div>
                                    <div class="orderby">
                                        <select name="orderby" id="" class="form-control field-form" form="formfill">
                                            <option value="0">{{__('product.sap_xep_theo')}}</option>
                                            <option value="1">{{__('product.gia_tang_dan')}}</option>
                                            <option value="2">{{__('product.gia_giam_dan')}}</option>
                                            <option value="5">{{__('product.moi_nhat')}}</option>
                                            <option value="6">{{__('product.cu_nhat')}}</option>
                                            <option value="7">{{__('product.sp_noi_bat')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wrap-list-product" id="dataProductSearch">
                                    <div class="list-product-card">
                                        <div class="row">
                                            @if (isset($data)&&$data)
                                                @foreach ($data as $product)
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
                                                                            <div class="product-grid__reviews">
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
                                                                            <div class="product-grid__reviews">
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
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if (count($data))
                                        {{$data->appends(request()->all())->onEachSide(1)->links()}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

            <form action="#" method="get" name="formfill" id="formfill" data-ajax="submit" class="d-none">
                @csrf
            </form>

        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).on('change','.field-form',function(){
          // $( "#formfill" ).submit();

           let contentWrap = $('#dataProductSearch');

            let urlRequest = '{{ url()->current() }}';

            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                }
            });
        });
    });
</script>

@endsection
