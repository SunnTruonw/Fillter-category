@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/xzoom/xzoom.css') }}">
    <script type="text/javascript" src="{{ asset('frontend/js/xzoom/xzoom.min.js') }}"></script>
    @if(Session::has('msg'))
    <script type="text/javascript">
        alert("{{ Session::get('msg') }}");
    </script>
    @endif
    <div class="content-wrapper">
        @isset($breadcrumbs,$typeBreadcrumb)
        @include('frontend.components.breadcrumbs',[
            'breadcrumbs'=>$breadcrumbs,
            'type'=>$typeBreadcrumb,
        ])
        @endisset
        @isset($slider)
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12">
                          {{--<div class="slide-product-detail">
                              <div class="slider-product-detail faded-detail">
                                  @foreach ($slider as $item)
                                  <div class="slider-product-detail-item">
                                      <div class="slider-item-image">
                                          <img src="{{ $item->image_path }}" alt="{{ $item->name }}">
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                          </div>--}}
                        @endisset
                        <div class="blog-product-detail" data-id="{{$data->id}}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-left">
                                    
                                    <div class="data-warpper-product" id="dataProductSearch">
                                        <div class="box-product-main">
                                            <div class="row" >
                                                <div class="col-md-6 col-sm-12 col-12 col-box-product-main-left">
                                                    @if($data->options)
                                                    @php
                                                        $optionIsStock = $data->options()->where('stock',1)->orderBy('order')->first();
                                                    @endphp
                                                        <div class="box-image-product" id="load-image">
                                                            <div class="big-img-slider slider-for">
                                                                @if($optionIsStock && $optionIsStock->count()>0)
                                                                    @php
                                                                        $stt = 0;
                                                                    @endphp
                                                                        <div class="big-img-item">
                                                                            <a href="javascript:;">
                                                                                <img src="{{  asset($optionIsStock->avatar_type) }}" alt="{{$data->name}}">
                                                                            </a>
                                                                        </div>
                                                                    @foreach($optionIsStock->images as $item)
                                                                    @php
                                                                        $stt++;
                                                                    @endphp
                                                                        <div class="big-img-item">
                                                                            <a href="javascript:;">
                                                                                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            @if($data->options)
                                                                <div class="slider-nav slider-small-img">
                                                                    @php
                                                                        $optionIsStock1 = $data->options()->where('stock',1)->orderBy('order')->first();
                                                                    @endphp
                                                                    @if($optionIsStock1)
                                                                    @php
                                                                        $j = 0;
                                                                    @endphp
                                                                        <div class="slider-small-img-item column">
                                                                            <img src="{{  asset($optionIsStock->avatar_type) }}" alt="{{$data->name}}">
                                                                        </div>
                                                                    @foreach($optionIsStock1->images as $item)
                                                                        @php
                                                                            $j++;
                                                                        @endphp
                                                                            <div class="slider-small-img-item column">
                                                                                <img src="{{asset($item->image_path)}}" alt="">
                                                                            </div>
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            {{--
                                                            <!--Img active-->
                                                            <div class="image-main  active">
                                                                @if($data->options)
                                                                    @php
                                                                        $optionIsStock = $data->options()->where('stock',1)->orderBy('order')->first();
                                                                    @endphp
                                                                    @if($optionIsStock)     
                                                                        <a>
                                                                            <i class="fas fa-expand-alt"></i>
                                                                            <img class="expandedImg" src="{{  asset($optionIsStock->avatar_type) }}" alt="{{ $data->name }}">
                                                                        </a>

                                                                        @foreach($optionIsStock->images as $item)
                                                                            @php
                                                                                $stt++;
                                                                            @endphp
                                                                            <a>
                                                                                    <i class="fas fa-expand-alt"></i>
                                                                                <img class="expandedImg" src="{{  asset($item->avatar_type) }}" alt="{{ $optionIsStock->name }}">
                                                                            </a>
                                                                        @endforeach
                                                                    @endif


                                                                    <div class="gallery-top gallery-top-slick margin-bottom-10">
                            
                                                                        @if($optionIsStock && $optionIsStock->count()>0)
                                                                            @php
                                                                                $stt = 0;
                                                                            @endphp
                                        
                                                                            <div class="item">
                                                                                <a data-hash="{{ $stt }}" href="javascript:;" title="{{ $optionIsStock->name }}">
                                                                                    <img src="{{ asset($optionIsStock->avatar_type) }}" alt="{{ $optionIsStock->name }}" data-image="{{ asset($optionIsStock->avatar_type) }}" class="img-responsive mx-auto d-block swiper-lazy" />
                                                                                </a>
                                                                            </div>
                                        
                                                                            @foreach($optionIsStock->images as $item)
                                                                                @php
                                                                                    $stt++;
                                                                                @endphp
                                                                                <div class="item">
                                                                                    <a data-hash="{{ $stt }}" href="javascript:;" title="{{ $optionIsStock->name }}">
                                                                                        <img src="{{ asset($item->image_path) }}" alt="{{ $optionIsStock->name }}" data-image="{{ asset($item->image_path) }}" class="img-responsive mx-auto d-block swiper-lazy" />
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            --}}


                                                            <!--End img active-->
                                                            {{--
                                                            <!--Img item-->
                                                            @if($data->options)
                                                                @php
                                                                    $optionIsStock1 = $data->options()->where('stock',1)->orderBy('order')->first();
                                                                @endphp
                                                                @if($optionIsStock1)
                                                                @php
                                                                    $j = 0;
                                                                @endphp
                                                                <div class="list-small-image thumbimageslide-slick">
                                                                    <div class="pt-box autoplay5-product-detail-new">
                                                                        <div class="small-image column">
                                                                            <img src="{{ asset($optionIsStock->avatar_type) }}" alt="{{ asset($data->name) }}">
                                                                        </div>
                                                                        @foreach($optionIsStock1->images as $item)
                                                                        @php
                                                                            $j++;
                                                                        @endphp
                                                                        <div class="small-image column" data-hash="{{$j}}">
                                                                            <img src="{{ asset($item->image_path) }}" alt="{{ $data->name }}">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                            <!--End img active-->
                                                            --}}


                                                            {{-- @if ($data->options()->count())
                                                                @foreach ($data->options as $item)
                                                                <div id="img_{{ $item->id }}" class="image-main">
                                                                    <a class="hrefImg" href="{{ asset($item->avatar_type) }}" data-lightbox="image">
                                                                        <i class="fas fa-expand-alt"></i>
                                                                        <img class="expandedImg" src="{{  asset($item->avatar_type) }}" alt="{{ $data->name }}">
                                                                    </a>
                                                                    @if ($item->images()->count())
                                                                    <div class="list-small-image">
                                                                        <div class="pt-box autoplay5-product-detail-new">
                                                                            <div class="small-image column">
                                                                                <img src="{{ asset($item->avatar_type) }}" alt="{{ asset($data->name) }}">
                                                                            </div>
                                                                            @foreach ($item->images as $image)
                                                                            <div class="small-image column" data-id_option="{{ $image->id }}">
                                                                                <img src="{{ asset($image->image_path) }}" alt="{{ $data->name }}">
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            @endif --}}
                                                        </div>
                                                    @endif
                                                    {{-- <div class="product_sharing">
                                                        <ul class="fastcontact" style="text-align: center;">
                                                            <li>
                                                                @isset($header['hotline_top22'])
                                                                    <i class="mli-phone"></i> <b>{{$header['hotline_top22']->name}}</b> <br>
                                                                    <span style="color: #f00; font-weight: bold;">
                                                                    <a style="color: #f00;" href="tel:{!!$header['hotline_top22']->value!!}">{!!$header['hotline_top22']->slug!!}</a> 
                                                                @endisset
                                                            </li>
                                                        </ul>
                                                    </div> --}}

                                                </div>

                                                <div class="col-md-6 col-sm-12 col-12 product-detail-infor col-box-product-main-right">
                                                    <div class="box-infor">
                                                        <div class="title_sp_detail">
                                                            <h1>{{ $data->name }}</h1>
                                                        </div>
                                                        

                                                        <div class="pcd-rating">
                                                                <div class="masp">
                                                                    <i class="far fa-check-square"></i> Mã sản phẩm: <strong>{{ $data->masp }}</strong>
                                                                </div>
                                                                @if($data->stars()->count()>0)
                                                                    @php
                                                                        $avgRating = 0;
                                                                        $sumRating = array_sum(array_column($data->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                                        $countRating = count($data->stars()->where('active', 1)->get());
                                                                        if ($countRating != 0) {
                                                                            $avgRating = $sumRating / $countRating;
                                                                        }
                                                                    @endphp
                                                                    <ul class="rating-star">
                                                                        @for($i = 1; $i <= 5; $i++)
                                                                            @if($i <= $avgRating)
                                                                                <li class="star-rating-top"><i class="fas fa-star"></i></li>
                                                                            @else
                                                                                <li class="star-rating-top"><i class="far fa-star"></i></li>
                                                                            @endif
                                                                        @endfor
                                                                    
                                                                        <li class="txt-gray">
                                                                            <a class="link scroll-to-review">
                                                                                <span class="total-reviews">{{$data->stars()->count()}}</span> Đánh giá
                                                                            </a>
                                                                        </li>
                                                                        {{-- <li class="bought">
                                                                            <span>| 226 | Đã bán(Web): 196</span>
                                                                        </li> --}}
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        
                                                        {{-- <div class="list-attr">
                                                            <div class="attr-item">
                                                                <div class="price">
                                                                    @if ($data->price)
                                                                        @if ($data->price)
                                                                            <span id="priceChange">{{ number_format($data->price) }} <span class="donvi">/{{ $data->size ?? $unit }}</span></span>
                                                                        @endif
                                                                        @if ($data->old_price>0)
                                                                            <span id="old_priceChange" class="old-price">{{ number_format($data->old_price) }} /{{ $data->size ?? $unit  }}</span>
                                                                        @endif                                   
                                                                    @else
                                                                        {{ __('product.gia') }}: {{ __('home.lien_he') }}
                                                                    @endif                                                         
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <!--Price--->
                                                        @if($data->options)
                                                            @php
                                                                $optionIsStock3 = $data->options()->where('stock',1)->orderBy('order')->first();
                                                            @endphp

                                                            @if($optionIsStock3)
                                                                @php
                                                                    $priceInStock = $optionIsStock3->sizes()->where('stock',1)->orderBy('order')->first();
                                                                @endphp

                                                                @if($priceInStock)
                                                                    <div class="group-power">
                                                                        <div class="price-box clearfix">
                                                                            <span class="special-price">
                                                                                <span id="new-price" class="price product-price">
                                                                                    {{ $priceInStock->price?number_format($priceInStock->price)." ".$unit:"Liên hệ" }}
                                                                                </span>
                                                                            </span>
                                                                            @if ($priceInStock->old_price>0)
                                                                            <span class="old-price">
                                                                                <del id="old-price" class="price product-price-old">
                                                                                    {{ number_format($priceInStock->old_price) }}{{ $unit }}
                                                                                </del>
                                                                            </span> 
                                                                            @endif
                                                                            <span class="save-price d-none">Đang sale:
                                                                                <span class="price product-price-save"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        <!--End Price-->

                                                        <!--Varient--->
                                                        <form enctype="multipart/form-data" id="add-to-cart-form" data-cart-form action="{{ route('cart.buy',['id'=>$data->id]) }}" method="POST" class="wishItem">
                                                            @csrf
                                                            <div class="form-product">
                                                                
                                                                <div class="select-swatch">
                                                                    @if($data->options)
                                
                                                                    <div class="swatch-color swatch clearfix" data-option-index="0">
                                                                        <div class="options-title">Màu gỗ: <span id="color" class="var"></span></div>
                                                                            @php
                                                                                $h = 0;
                                                                            @endphp
                                
                                                                        @foreach($data->options()->orderBy('order')->get() as $item)
                                                                            @if($item->stock)
                                
                                                                                @php
                                                                                    $h++;
                                                                                @endphp
                                                                                <div data-value="{{$item->size}}" class="swatch-element color available">
                                                                                    <input id="color-{{$item->id}}" class="option_color" type="radio" name="color" value="{{$item->id}}" data-color_val="{{$item->size}}" @if($h == 1) checked @endif />
                                                                                    
                                
                                                                                    <label for="color-{{$item->id}}" title="{{$item->size}}" style="background-color: {{$item->color}};">
                                                                                        {{-- <span style="background-image:url({{ asset($item->avatar_type) }});background-size:50px;background-repeat:no-repeat;background-position: center;"></span> --}}
                                                                                        <span class="color-item-childs" ></span>

                                                                                    </label>
                                                                                </div>
                                                                            @else
                                                                                <div data-value="{{$item->size}}" class="swatch-element color soldout available">
                                                                                    <input id="color-{{$item->id}}" type="radio" name="color" value="{{$item->id}}" data-color_val="{{$item->size}}" />
                                                                                    <label for="color-{{$item->id}}" title="{{$item->size}}" style="background-color: {{$item->color}};">
                                                                                        {{-- <span style="background-image:url({{ asset($item->avatar_type) }});background-size:50px;background-repeat:no-repeat;background-position: center;"></span> --}}
                                                                                        <span class="color-item-childs" ></span>
                                                                                    </label>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    
                                                                    <div class=" swatch clearfix" data-option-index="1">
                                                                        <div class="options-title">Màu khung: <span id="size" class="var"></span> 
                                                                           {{-- <span class="guide">Hướng dẫn chọn khung</span> --}}
                                                                            </div>
                                
                                                                        <div id="list_size" class="list_size">
                                                                            @php
                                                                                $optionIsStock2 = $data->options()->where('stock',1)->orderBy('order')->first();
                                                                            @endphp
                                
                                                                            @if($optionIsStock2)
                                                                                @php
                                                                                    $k = 0;
                                                                                @endphp
                                                                                @foreach($optionIsStock2->sizes()->orderBy('order')->get() as $item )
                                
                                                                                    @if($item->stock)
                                                                                        @php
                                                                                            $k++;
                                                                                        @endphp
                                                                                        <div data-value="{{ $item->size }}" class="swatch-element available">
                                
                                                                                            <input id="size-{{ $item->id }}-{{ $item->size }}" type="radio" class="option_size" name="size" value="{{ $item->id }}" data-price="{{ $item->price }}" data-old_price="{{ $item->old_price }}" data-size_val="{{$item->size}}" @if($k == 1)checked @endif />
                                                                                            
                                                                                            <label title="{{ $item->size }}" for="size-{{ $item->id }}-{{ $item->size }}">
                                                                                                {{ $item->size }}
                                                                                            </label>
                                                                                            
                                                                                        </div>
                                                                                    @else
                                                                                        <div data-value="{{ $item->size }}" class="swatch-element @if(!$item->stock) soldout @endif  available">
                                
                                                                                            <input id="size-{{ $item->id }}-{{ $item->size }}" type="radio" name="size" value="{{ $item->id }}" data-price="{{ $item->price }}" data-old_price="{{ $item->old_price }}" data-size_val="{{$item->size}}"  />
                                                                                            
                                                                                            <label title="{{ $item->size }}" for="size-{{ $item->id }}-{{ $item->size }}">
                                                                                                {{ $item->size }}
                                                                                            </label>
                                                                                            
                                                                                        </div>
                                
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div class="clearfix from-action-addcart ">
                                                                    <div class="qty-ant clearfix custom-btn-number ">
                                                                        <label>Chọn số lượng:</label>
                                                                        <div class="custom custom-btn-numbers clearfix input_number_product">       
                                                                            <button onclick=" var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty) & qty > 1 ) result.value--; changeQuantity(); return false;" class="btn-minus btn-cts" type="button">–</button>
                                                                            <input aria-label="Số lượng" type="text" class="qty input-text" id="qty" name="quantity" size="4" value="1" maxlength="3" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == 0)this.value=1;" />
                                                                            <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty)) result.value++; changeQuantity(); return false;" class="btn-plus btn-cts" type="button">+</button>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="btn-mua">
                                                                        @php
                                                                            $optionIsStock4 = $data->options()->where('stock',1)->orderBy('order')->first();
                                                                            if($optionIsStock4){
                                                                                $sizeIsStock4 = $optionIsStock4->sizes()->where('stock',1)->orderBy('order')->first();
                                                                            }
                                                                        @endphp
                                
                                                                        @if($sizeIsStock4)
                                                                        <button id="addCart" type="button" data-role='addtocart' class="btn btn-lg btn-gray btn-cart btn_buy add_to_cart add-to-cart" data-url="{{ route('cart.add',['id' => $data->id,'color'=>$optionIsStock4->id,'size'=>$sizeIsStock4->id]) }}" data-start="{{ route('cart.add',['id' => $data->id]) }}" data-start="{{ route('cart.add',['id' => $data->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                                                            Thêm Vào Giỏ Hàng</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix from-action-desc">
                                                                    <div class="vouchers">* Mã giảm giá không áp dụng với sản phẩm này</div>
                                                                </div>
                                                            </div>
                                                        </form>    
                                                        <!--End Varient--->

                                                        <div class="info-desc">
                                                            <div class="col_2_desc">
                                                                <div class="desc">
                                                                    {!! $data->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($data->content3 != null)
                                                        <div class="quatang">
                                                            <div class="title">
                                                                Quà tặng khi mua sản phẩm
                                                            </div>
                                                            <div class="box_quatang">
                                                                {!! $data->content3 !!}
                                                            </div>
                                                        </div>
                                                        @endif


                                                        {{-- <div class="wrap-price">
                                                            <div class="attr-item" style="display: inline-block;">
                                                                <div class="form-group">
                                                                    <label for="">{{ __('product.so_luong') }}</label>
                                                                    <div class="wrap-add-cart" id="product_add_to_cart">
                                                                        <div class="box-add-cart">
                                                                            <div class="pro_mun">
                                                                                <a class="cart_qty_reduce cart_reduce">
                                                                                    <span class="iconfont icon fas fa-minus" aria-hidden="true"></span>
                                                                                </a>
                                                                                <input type="text" value="1" class="" name="cart_quantity" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" maxlength="5" min="1" id="cart_quantity" disabled="disabled">
                                                                                <a class="cart_qty_add">
                                                                                    <span class="iconfont icon fas fa-plus" aria-hidden="true"></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                    </div>
                                                    @if(isset($policy) && $policy)
                                                        <div class="box-policy">
                                                            <div class="product-policy">
                                                                @foreach($policy->childs()->where('active', 1)->orderBy('order')->get() as $value)
                                                                    <div class="product-policy-item">
                                                                        <div class="prolicy-icon">
                                                                            <img src="{{asset($value->image_path)}}" alt="{{$value->name}}">
                                                                        </div>
                                                                        <div class="prolicy-title">
                                                                            {{$value->name}}
                                                                            <br>
                                                                            {{$value->slug}}
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="box-features">
                                                        <div class="product-features toggle-1">
                                                            <a  class="features-heading">Đặc điểm nổi bật</a>
                                                            <div class="features-listing">
                                                                {{-- <div class="features-item">
                                                                    Chất liệu: 100% Poly với định lượng vải 155gsm siêu nhẹ
                                                                </div> --}}
                                                                {!! $data->description !!}
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-related">
                                                        <div class="product-related">
                                                            <h4 class="product-related_title">
                                                                Sản phẩm bạn có thể thích
                                                            </h4>
                                                            <div class="product-related_listing">
                                                                <div class="product-related_item">
                                                                    <div class="product-grid_prod">
                                                                        <div class="product-grid_thumbnail">
                                                                            <div class="product-grid_img">
                                                                                <a href="">
                                                                                    <img src="https://media.coolmate.me/cdn-cgi/image/quality=80/uploads/November2021/IMG_7082-copy1_copyu.jpg" alt="">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-grid_content">
                                                                            <h3 class="product-grid_title">
                                                                                <a href="">Quần short nam thể thao Ultra Shorts</a>
                                                                            </h3>
                                                                            <div class="product-grid_price">
                                                                                <div class="product-price-grid">
                                                                                    <ins>189.000đ</ins>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($productSale) && $productSale)
                                                        <div class="box-related">
                                                            <div class="product-promotion-wrapper">
                                                                <span class="product-promootion_tags">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.003 512.003"><path d="M475.244 264.501a15.592 15.592 0 010-16.998l18.698-28.74c17.032-26.178 5.556-61.348-23.554-72.491l-32.02-12.26a15.596 15.596 0 01-9.992-13.754l-1.765-34.24c-1.608-31.184-31.563-52.902-61.667-44.802l-33.109 8.902a15.598 15.598 0 01-16.167-5.254l-21.555-26.665c-19.631-24.284-56.625-24.245-76.223 0l-21.556 26.666a15.597 15.597 0 01-16.167 5.254l-33.111-8.902c-30.163-8.112-60.063 13.678-61.667 44.802l-1.765 34.24a15.598 15.598 0 01-9.992 13.753l-32.018 12.26c-29.171 11.166-40.555 46.365-23.556 72.492l18.699 28.739a15.596 15.596 0 010 16.998L18.061 293.24c-17.034 26.181-5.554 61.352 23.554 72.492l32.02 12.26a15.598 15.598 0 019.992 13.754l1.765 34.24c1.608 31.19 31.568 52.899 61.667 44.802l33.109-8.902a15.602 15.602 0 0116.168 5.254l21.555 26.664c19.635 24.291 56.628 24.241 76.223 0l21.555-26.664a15.607 15.607 0 0116.167-5.254l33.111 8.902c30.155 8.115 60.062-13.674 61.667-44.802l1.765-34.24a15.598 15.598 0 019.992-13.753l32.018-12.26c29.169-11.166 40.554-46.364 23.557-72.493l-18.702-28.739zm-16.806 70.02l-32.02 12.26c-18.089 6.926-30.421 23.9-31.418 43.243l-1.765 34.24c-.511 9.921-10.036 16.821-19.612 14.249l-33.111-8.902c-18.705-5.032-38.661 1.455-50.836 16.518l-21.553 26.664c-6.245 7.725-18.009 7.709-24.242 0l-21.553-26.664c-9.438-11.676-23.55-18.198-38.132-18.198-4.229 0-8.499.548-12.706 1.68l-33.111 8.902c-9.596 2.576-19.1-4.348-19.612-14.249l-1.765-34.24c-.997-19.343-13.33-36.318-31.418-43.243l-32.02-12.261c-9.277-3.552-12.896-14.744-7.49-23.053l18.698-28.739c10.563-16.236 10.563-37.218 0-53.452l-18.698-28.739c-5.418-8.326-1.768-19.509 7.491-23.054l32.02-12.26c18.089-6.926 30.421-23.9 31.418-43.243l1.765-34.24c.511-9.921 10.036-16.821 19.612-14.249l33.111 8.902c18.705 5.031 38.66-1.455 50.836-16.518l21.555-26.665c6.245-7.724 18.01-7.708 24.241 0l21.555 26.666c12.178 15.063 32.129 21.549 50.836 16.517l33.111-8.902c9.595-2.577 19.1 4.348 19.612 14.249L395 121.98c.997 19.343 13.33 36.318 31.418 43.243l32.021 12.261c9.276 3.55 12.895 14.744 7.49 23.053l-18.697 28.738c-10.565 16.235-10.565 37.217-.001 53.453l18.698 28.738c5.416 8.328 1.768 19.51-7.491 23.055z"></path> <path data-v-5232d53d="" d="M339.485 170.845c-6.525-6.525-17.106-6.525-23.632 0L159.887 326.811c-6.525 6.525-6.525 17.106.001 23.632 3.263 3.263 7.54 4.895 11.816 4.895s8.554-1.632 11.816-4.895l155.966-155.967c6.526-6.524 6.526-17.105-.001-23.631zM188.414 165.95c-18.429 0-33.421 14.993-33.421 33.421 0 18.429 14.994 33.421 33.421 33.421 18.429 0 33.421-14.993 33.421-33.421.001-18.428-14.992-33.421-33.421-33.421zM310.959 288.495c-18.429 0-33.421 14.993-33.421 33.421 0 18.429 14.993 33.421 33.421 33.421s33.421-14.993 33.421-33.421c.001-18.428-14.992-33.421-33.421-33.421z"></path></svg>
                                                                    Deal Độc Quyền
                                                                </span>
                                                                <div class="product-promotion-body">
                                                                    <div class="promotion-two-columns">
                                                                        @foreach($productSale as $product)
                                                                        @php
                                                                            $tran=$product->translationsLanguage()->first();
                                                                            $link=$product->slug_full;
                                                                        @endphp
                                                                            <div class="product_column">
                                                                                <div class="product-grid_prod">
                                                                                    <div class="product-grid_thumbnail">
                                                                                        <div class="product-grid_img">
                                                                                            <a href="{{$link}}">
                                                                                                <img src="{{asset($product->avatar_path)}}" alt="{{$tran->name}}">
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="product-grid_content">
                                                                                        <h3 class="product-grid_title">
                                                                                            <a href="{{$link}}">{{$tran->name}}</a>
                                                                                        </h3>
                                                                                        <div class="product-grid_price">
                                                                                            <div class="product-price-grid">
                                                                                                @if($product->price && $product->old_price > 0)
                                                                                                    <span style="color: red; margin-left: 10px;">-{{ceil(100 -($product->price)*100/($product->old_price))}}%</span>
                                                                                                    <del>{{ number_format($product->old_price) }}{{ $unit }}</del>
                                                                                                    <ins>{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
                                                                                                @else
                                                                                                    <ins>{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
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
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-product">
                                            <div role="tabpanel">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
    
                                                    <li class="nav-item">
                                                        <a class="nav-link active"  data-toggle="tab" href="#mota" role="tab" aria-controls="tabmoto" aria-selected="false">Thông tin chi tiết</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link"  data-toggle="tab" href="#danhgiasao" role="tab" aria-controls="tabdanhgiasao" aria-selected="false">Đánh giá sao ({{$data->stars()->where('active', 1)->count()}})</a>
                                                        </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link"  data-toggle="tab" href="#huongdanmuahang" role="tab" aria-controls="tabhuongdanmuahang" aria-selected="true">Hướng dẫn mua hàng</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade  show active" id="mota" role="tabpanel" aria-labelledby="tabmota-tab">
                                                        {!! $data->content !!}
                                                    </div>
                                                    <div class="tab-pane fade" id="danhgiasao" role="tabpanel" aria-labelledby="tabdanhgiasao-tab">
                                                        {{-- @if($data->stars()->count()>0)
                                                            <div class="list-star js-list-star">
                                                                <div class="js-load" style="display: none;">
                                                                    <div class="spinner-border text-info"></div>
                                                                </div>
                                                                @foreach($data->stars()->where('active',1)->orderBy('created_at')->get() as $item)
                                                                    <div class="item-star">
                                                                        <div class="box">
                                                                            <div class="auth-star">
                                                                                <div class="icon">{{ $item->name_tat($item->name) }}</div>
                                                                                <div class="text-star">
                                                                                    <div class="name">{{ $item->name }}</div>
                                                                                    <div class="date-create">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-star">
                                                                                <h3>{{ $item->title }}</h3>
                                                                                <div class="desc">
                                                                                    {{ $item->content }}
                                                                                </div>
                                                                            </div>
                                                                            @if($item->star)
                                                                            <div class="point-star">
                                                                                {{ $item->star }}
                                                                                <span class="point">
                                                                                    <i class="fas fa-star"></i>
                                                                                </span>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="pagination-star js-pagination-ajax mt-3">
                                                                </div>
                                                            </div>
                                                            @endif --}}

                                                            <style>
                                                                .allowed{
                                                                    cursor: not-allowed;
                                                                }  
                                                                .rating_detail_item_js{
                                                                    cursor: pointer !important;
                                                                }  
                                                            </style>
                                                            {{-- @if($data->stars()->count()>0) --}}
                                                            <div id="danhgia" class="danhgia_sao">
                                                                <div class="contact-form">
                                                                    <div class="form">
                                                                            <div class="form_danhgia rating-star-main">
                                                                                <div class="box-rating">
                                                                                    <div class="medium-rating">
                                                                                        {{round($avgRating, 1)}}
                                                                                    </div>
                                                                                    
                                                                                        <div class="rating">
                                                                                            @for($i = 1; $i <= 5; $i++)
                                                                                                @if($i <= $avgRating)
                                                                                                    <i class="fas fa-star"></i>
                                                                                                @else
                                                                                                    <i class="far fa-star"></i>
                                                                                                @endif
                                                                                            @endfor
                                                                                        </div>
                                                                                    <div class="feedbacks">
                                                                                        <span>{{$data->stars()->where('active', 1)->count()}}</span>
                                                                                    Đánh giá
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="rating_detail">
                                                                                    @if(isset($star5) && $star5)
                                                                                    <div class="rating_detail-item">
                                                                                        <button type="button" value="5">
                                                                                            <div class="box-star-title">
                                                                                                <span>5</span>
                                                                                                <i class="fas fa-star"></i>
                                                                                            </div>
                                                                                            <div class="percent-rating @if($star5->count() !== 0) rating_detail_item_js  @else  allowed @endif" data-star="5" @if($star5->count() !== 0) onClick="window.location='#commentData';" @endif>
                                                                                                <div class="box-percent" @if($countRating != 0) style="width: {{(count($star5)/$countRating)*100}}%;" @endif>
                                                                                                    <div class="main-percent"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="review-cout">{{$star5->count()}}</div>
                                                                                        </button>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if(isset($star4) && $star4)
                                                                                        <div class="rating_detail-item">
                                                                                            <button type="button" value="4">
                                                                                                <div class="box-star-title">
                                                                                                    <span>4</span>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                </div>
                                                                                                <div class="percent-rating @if($star4->count() !== 0) rating_detail_item_js @else  allowed @endif" data-star="4" @if($star4->count() !== 0) onClick="window.location='#commentData';" @endif>
                                                                                                    <div class="box-percent" @if($countRating != 0) style="width: {{(count($star4)/$countRating)*100}}%;" @endif>
                                                                                                        <div class="main-percent"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="review-cout">{{$star4->count()}}</div>
                                                                                            </button>
                                                                                        </div>
                                                                                    @endif
                                                                                    @if(isset($star3) && $star3)
                                                                                        <div class="rating_detail-item">
                                                                                            <button type="button" value="3">
                                                                                                <div class="box-star-title">
                                                                                                    <span>3</span>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                </div>
                                                                                                <div class="percent-rating @if($star3->count() !== 0) rating_detail_item_js  @else allowed @endif" data-star="3" @if($star3->count() !== 0) onClick="window.location='#commentData';" @endif>
                                                                                                    <div class="box-percent" @if($countRating != 0) style="width: {{(count($star3)/$countRating)*100}}%;" @endif>
                                                                                                        <div class="main-percent"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="review-cout">{{$star3->count()}}</div>
                                                                                            </button>
                                                                                        </div>
                                                                                    @endif
                                                                                    @if(isset($star2) && $star2)
                                                                                    <div class="rating_detail-item">
                                                                                        <button type="button" value="2">
                                                                                            <div class="box-star-title">
                                                                                                <span>2</span>
                                                                                                <i class="fas fa-star"></i>
                                                                                            </div>
                                                                                            <div class="percent-rating @if($star2->count() !== 0) rating_detail_item_js  @else allowed @endif" data-star="2" @if($star2->count() !== 0) onClick="window.location='#commentData';" @endif>
                                                                                                <div class="box-percent" @if($countRating != 0) style="width: {{(count($star2)/$countRating)*100}}%;" @endif>
                                                                                                    <div class="main-percent"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="review-cout">{{$star2->count()}}</div>
                                                                                        </button>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if(isset($star1) && $star1)
                                                                                    <div class="rating_detail-item">
                                                                                        <button type="button" value="1">
                                                                                            <div class="box-star-title">
                                                                                                <span>1</span>
                                                                                                <i class="fas fa-star"></i>
                                                                                            </div> 
                                                                                            <div class="percent-rating @if($star1->count() !== 0) rating_detail_item_js @else allowed @endif" data-star="1"  @if($star1->count() !== 0) onClick="window.location='#commentData';" @endif>
                                                                                                <div class="box-percent" @if($countRating != 0) style="width: {{(count($star1)/$countRating)*100}}%;" @endif>
                                                                                                    <div class="main-percent"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="review-cout">{{$star1->count()}}</div>
                                                                                        </button>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @if(\Auth::check())
                                                                                <div class="single-start-top-bottom">
                                                                                    <div class="single-vote-sub-title">Bạn đánh giá sao sản phẩm này?</div>
                                                                                    <a class="single-vote-btn" href="#popup-rating" data-fancybox="">Đánh giá ngay</a>
                                                                                </div>
                                                                            @endif
                                                                            
                                                                            <div class="form_danhgia form-feedback">
                                                                                <div class="show-3-item b-r-8 bg-white m-t-20 p-y-4 p-x-24">
                                                                                    <div class="d-flex flex-column" id="commentData">

                                                                                    </div>
                                                                                </div>
                                                                                @if($countRating != 0)
                                                                                    <div class="container-btn-show-all" id="button-loadMore">
                                                                                        <input type="hidden" value="1" id="page">
                                                                                        <button type="button" class="review-btn-show-all load-more-product">Xem thêm bình luận <i class="fas fa-angle-down"></i></button>
                                                                                        <button type="button" class="review-btn-show-less" style="display:none">Show less<i class="fas fa-angle-up"></i></button>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {{-- @endif --}}
                                                        </div>

                                                    <div class="tab-pane fade" id="huongdanmuahang" role="tabpanel" aria-labelledby="tabhuongdanmuahang-tab">
                                                        @isset($huongDanMuaHang)
                                                        {!!$huongDanMuaHang->description!!}
                                                        @endisset
                                                    </div>
                                                    <div class="tab-pane fade" id="quydinhdoihang" role="tabpanel" aria-labelledby="tabquydinhdoihang-tab">
                                                        @isset($quyTrinh)
                                                        {!!$quyTrinh->description!!}
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @isset($dataRelate)
                                            @if ($dataRelate->count())
                                                <div class="product-relate">
                                                    <div class="product">
                                                        <div class="title">
                                                            <h2>{{ __('product.san_pham_lien_quan') }}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-card">
                                                        <div class="row">
                                                            @foreach ($dataRelate as $product)
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
                                            @endif
                                        @endisset
                                    </div>
                                   
                                </div>
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <script type="text/javascript" src="{{ asset('frontend/js/xzoom/setup.js') }}"></script>
    <form action="" method="get" name="formfill" id="formfill" class="d-none">
        @csrf
    </form>
    <input type="hidden" name="product_id" class="product_id" value="{{ $data->id }}">


    <div class="dnone">
        <div class="popup-rating" id="popup-rating">
            <div class="poup-header">
                <p>Đánh giá và nhận xét sản phẩm</p>
            </div>
            <form action="{{ route('product.rating',['id' => $data->id]) }}" method="POST" id="sendComment" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name_product" value="{{$data->name}}" placeholder="Tên sản phẩm" class="cps-input comment_name" required>
                <textarea id="content" name="content" rows="4" cols="5" placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm..." class="cps-textarea comment_content"></textarea>

                {{-- <div class="form-group">
                    <div class="review__title">
                        Ảnh đánh giá
                    </div>
                    <div class="review__subtitle">
                        (Tối đa 5 ảnh)
                    </div>
                    <div class="wrap-load-image mb-3">
                        <div class="form-group">
                            <input type="file" class="form-control-file img-load-input-multiple border @error('image')
                                is-invalid
                                @enderror" id="" name="image[]" multiple>
                        </div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="load-multiple-image">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                        </div>
                    </div>
                </div> --}}

                <div class="group-input">
                    <div class="wrap-load-image">
                        <div class="is-flex">
                            <input type="text" placeholder="Hình ảnh thực tế" class="input input__file border my-2"/>
                            <input type="file" id="image-rating" class="form-control-file is-hidden img-load-input-multiple border @error('image')
                                        is-invalid
                                        @enderror" id="" name="image[]" multiple>
                            <label for="image-rating" class="btn-add-image-rating my-2 is-flex is-align-items-center ml-auto">
                                <div class="input-icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                Thêm ảnh
                            </label>
                        </div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="load-multiple-image">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                            <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                        </div>
                    </div>
                </div>
                
                <div class="rate">
                    <p class="rate-title">Bạn cảm thấy sản phẩm như thế nào?</p>
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
                
                {{-- <div class="lc__reviews-rating txt-center m-t-16">
                    <p class="fs-p-18 txt-gray-700 f-w-500 m-b-8 fs-p-md-16">
                        Bạn chấm sản phẩm này bao nhiêu sao?
                    </p>
                    <div class="u-flex align-items-center justify-center relative">
                        <ul class="lc__rating-star row no-gutters justify-center align-center m-b-4 js-rating create-rating">
                            <li class="m-r-8" data-num="1">
                                <span class="ic-star fs-p-24 fs-p-md-20"></span>
                            </li>
                            <li class="m-r-8" data-num="2">
                                <span class="ic-star fs-p-24 fs-p-md-20"></span>
                            </li>
                            <li class="m-r-8" data-num="3">
                                <span class="ic-star fs-p-24 fs-p-md-20"></span>
                            </li>
                            <li class="m-r-8" data-num="4">
                                <span class="ic-star fs-p-24 fs-p-md-20"></span>
                            </li>
                            <li class="m-r-8" data-num="5">
                                <span class="ic-star fs-p-24 fs-p-md-20"></span>
                            </li>
                        </ul>
                        <span class="messrating fs-p-16 txt-gray-700" id="messrating"></span>
                    </div>
                    <div class="alert alert-md alert-danger alert-des alert-sm-md m-t-16 m-t-md-0 error-star" style="display: none;">
                        <i class="ic-minus alert-ic-sm bg-danger"></i>
                        <span class="">Vui lòng đánh giá của bạn về sản phẩm này</span>
                    </div>
                </div> --}}
                <button type="submit" class="btn-submit-rate send_comment">Gửi đánh giá</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
           
            // $('.column').click(function() {
            //     var src = $(this).find('img').attr('src');
            //     $(".hrefImg").attr("href", src);
            //     $("#expandedImg").attr("src", src);
            // });

            $('.column').click(function() {
                var src = $(this).find('img').attr('src');
                let parent = $(this).parents('.box-image-product');
                // parent.find(".hrefImg").attr("href", src);
                // parent.find(".expandedImg").attr("src", src);
                parent.find(".expandedImg").attr("src", src);
            });

            $(document).on('click','.tab-link ul li a',function(){
                    $('.tab-link ul li a').removeClass('active');
                    $(this).addClass('active');
            });

            //load img
            $(document).on('change', '.img-load-input-multiple', function() {
                let input = $(this);
                displayMultipleImage(input, '.wrap-load-image', '.load-multiple-image');
            });

            function displayMultipleImage(input, selectorWrap, selectorWrapImg) {
                let wrapImg = input.parents(selectorWrap).find(selectorWrapImg);
                wrapImg.find('img').remove();
                let files = input.prop('files');
                let length = files.length;
                for (let i = 0; i < length; i++) {
                    fileItem = files[i];
                    let reader = new FileReader();
                    reader.addEventListener("load", function() {
                        // convert image file to base64 string
                        let img = $('<img />');
                        img.attr({
                            'src': reader.result,
                            'alt': fileItem.name,
                        });
                        wrapImg.append(img);
                    }, false);
                    if (fileItem) {
                        reader.readAsDataURL(fileItem);
                    }
                }
            }

            //endload img

            $('.autoplay5-product-detail-new').slick({
                dots: false,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                vertical: true,
                autoplaySpeed: 3000,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 551,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
       
                        }
                    }
                ]
            });


            $(document).on('change','.field-form',function(){
                // $( "#formfill" ).submit();

                let contentWrap = $('#dataProductSearch');

                let urlRequest = '{{ makeLinkById('category_products',$data->category->id) }}';
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
            // load ajax phaan trang
            $(document).on('click','.pagination a',function(){
                event.preventDefault();
                let contentWrap = $('#dataProductSearch');
                let href=$(this).attr('href');
                //alert(href);
                $.ajax({
                    type: "Get",
                    url: href,
                // data: "data",
                    dataType: "JSON",
                    success: function (response) {
                        let html = response.html;

                        contentWrap.html(html);
                    }
                });
            });
        });
    </script>

    <script>
        // hàm thay đổi màu sắc
        function changeColor(){
            $(".option_color").each(function() {
                let color_check = $(this).is(':checked');
                if(color_check){
                    val_color = $(this).data('color_val');
                    $('#color').html(val_color);
                }
            });
        }

        // hàm thay đổi size
        function changeSize(){

            let n = Intl.NumberFormat('en-US');

            $(".option_size").each(function() {
                let size_check = $(this).is(':checked');
                let new_price = $(this).data('price');
                let old_price = $(this).data('old_price');
                // console.log(size_check, new_price,old_price);
                if(size_check){
                    val_size = $(this).data('size_val');
                    $('#size').html(val_size);

                    if (new_price) {
                        new_price = n.format(new_price);
                        $('#new-price').html(new_price+' đ');
                    }
                    else{
                        $('#new-price').html('Liên hệ');
                    }
                    
                    if (old_price) {
                        old_price = n.format(old_price);
                        $('#old-price').html(old_price+' đ');
                    }
                    else{
                        $('#old-price').html('');
                    }
                }
            });
        }
        // hàm lấy url order
        function getUrl(){
            let color_id;
            let size_id;
            let quantity;
            let url;

            // lấy id màu đang được chọn
            $(".option_color").each(function() {
                let color_check = $(this).is(':checked');
                if(color_check){
                    color_id = $(this).val();
            
                }
            });

            // lấy id size đang được chọn
            $(".option_size").each(function() {
                let size_check = $(this).is(':checked');
                if(size_check){
                    size_id = $(this).val();
                }
            });

            // lấy số lượng sp
            quantity = $('#qty').val();

            // get url
            url = $('#addCart').data('start');

            url = url+'?color='+color_id+'&quantity='+quantity+'&size='+size_id;

            $('#addCart').attr('data-url',url);

        }

        function checkWindowWidth() {
            var windowWidth = $(window).width();

            if (windowWidth < 991) {
                $(".list-small-image.thumbimageslide-slick").css("display", 'none');
            }
        }



        function changeQuantity(){
            $('#qty').change();
            getUrl();

        }

        function slideLoadImage(){
            $('.autoplay5-product-detail-new').slick({
                dots: false,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                vertical: true,
                autoplaySpeed: 3000,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 551,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
    
                        }
                    }
                ]
            });
        }


        $( window ).load(function() {
            changeColor();
            changeSize();
            getUrl();
        });

        // js thay đổi số lượng
        $(document).on('change','#qty',function(){
            getUrl();
        })
        
    </script>

    <script>
        // js thay đổi màu
        $(document).on("change", ".option_color", function() {
            event.preventDefault();
            changeColor();
            $(".option_color").each(function() {
                let color_check = $(this).is(':checked');
                if(color_check){

                    let color_id = $(this).val();
    
                    let urlRequest = window.location.href;

                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: { color_id : color_id },
                        success: function(data) {
                            // console.log(data.view_size);
                            if (data.code == 200) {
                                checkWindowWidth();
                                $('#load-image').html(data.view_color);
                                $('#list_size').html(data.view_size)
                                changeSize();
                                getUrl();

                                slideLoadImage();

                                $('.column').click(function() {
                                    var src = $(this).find('img').attr('src');
                                    let parent = $(this).parents('.box-image-product');
                                    // parent.find(".hrefImg").attr("href", src);
                                    // parent.find(".expandedImg").attr("src", src);
                                    parent.find(".expandedImg").attr("src", src);
                                });
                            }
                        }
                    });
                }
            });

            
        });

        // js thay đổi size
        $(document).on('change','.option_size',function(){
            changeSize();
            getUrl();
        })

        
    </script>
    <script>
    $(document).on('click','.features-heading', function(){
        
        $(this).addClass('change');
        $('.product-features').addClass('is-active');
    } )
    $(document).on('click','.change', function(){
        $(this).removeClass('change');
        $('.product-features').removeClass('is-active');
        
    } )
</script>

<script>
    
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_comment();

        function load_comment(){
            var idProduct = $('.product_id').val();
            let urlRequest = '{{ route('product.loadComment') }}';

            $.ajax({
                url : urlRequest,
                method : 'POST',
                data : {idProduct : idProduct},
                success : function(data){
                    $('#commentData').html(data.data);
                } 
            });
        }

        function loadMore()
        {
            var idProduct = $('.product_id').val();
            let urlRequest = '{{ route('product.loadMoreComment') }}';
            const page = $('#page').val();

            $.ajax({
                type : 'POST',
                dataType : 'JSON',
                data : { page, idProduct },
                url : urlRequest,
                success : function (result) {
                    if (result.html !== '') {
                        $('#commentData').append(result.html);
                        $('#page').val(page + 1);
                    } else {
                        $('#button-loadMore').css('display', 'none');
                    }
                }
            })
        }



        $('.load-more-product').click(function(){
            loadMore();
        })

        $('.rating_detail_item_js').click(function(){
            let rate = $(this).attr('data-star');
            var idProduct = $('.product_id').val();

            let urlRequest = '{{ route('product.loadDetailRate') }}';

            $.ajax({
                type : 'POST',
                dataType : 'JSON',
                data : { rate , idProduct },
                url : urlRequest,
                // beforeSend: function () {
                //     $('#button-loadMore').show();
                //     $('#page').val(1);
                // },
                success : function (result) {
                    $('#commentData').html(result.html);
                    $('#button-loadMore').hide();
                }
            })
        })


        function validateContent (content)
        {
            if(content == '' || content.length < 8){
                $('#errorContent').show();
                var errorContent = false;
            }else{
                if(content.length < 8){
                    $('.text-content-error').text('Thông tin bắt buộc');
                    $('#errorContent').show();
                    var errorContent = false;
                }else{
                    $('#errorContent').hide();
                }
            }

            if(errorContent == false){
                return false;
            }
        }

        function keyUpValidate (elementKeyup, elementHide, elementName = false, extend = false, errorText, star = false,  invaliEmail = false)
        {
            $(document).on('keyup', '#'+elementKeyup, function(){
                if($(this).val() != ''){
                    $('#'+elementHide).hide();
                    $('#'+elementHide).parent().children().removeClass('is-invalid');
                }else{
                    $('#'+elementHide).show();
                    $('#'+elementHide).parent().children().addClass('is-invalid');
                }

                //check phone
                if(extend == 'phone'){
                    if($(this).val().length > 0){
                        if($(this).val().length < 10 || $(this).val().length > 10 || phonenumber($(this).val()) == false){
                            $('.'+errorText).text('Số điện thoại không hợp lệ');
                            $('#'+elementHide).show();
                            $('#'+elementHide).parent().children().addClass('is-invalid');
                        }else{
                            $('#'+elementHide).hide();
                            $('#'+elementHide).parent().children().removeClass('is-invalid');
                        }
                    }else{
                        $('.'+errorText).text('Thông tin bắt buộc');
                        $('#'+elementHide).show();
                        $('#'+elementHide).parent().children().addClass('is-invalid');
                    }
                }
                
                //check content
                if(extend == 'content'){
                    if(removeChar($(this).val()).length < 3 || $(this).val().replace(/\s/g, '').length < 3){
                        $('#'+elementHide).show();
                        $('#'+elementHide).parent().addClass('is-invalid');
                    }else{
                        $('#'+elementHide).hide();
                        $('#'+elementHide).parent().removeClass('is-invalid');
                    }
                }

                //check email
                if(invaliEmail != false){
                    $(document).on('keyup', '#'+elementKeyup, function(){
                        var email = $(this).val();
                        if(email != '' && email.length > 5 && email.replace(/\s/g, '').length > 0){
                            if(isEmail(email) == false){
                                $('#'+elementHide).show();
                                $('#'+elementHide).parent().children().addClass('is-invalid');
                                return false;
                            }else{
                                $('#'+elementHide).hide();
                                $('#'+elementHide).parent().children().removeClass('is-invalid');
                            }
                        }else{
                            $('#'+elementHide).hide();
                            $('#'+elementHide).parent().children().removeClass('is-invalid');
                        }
                    });
                }

                //rating review
                $('create-rating').click(function(){
                    var rating = $('.lc__rating-star').find('li.m-r-8.selected').length;
                    if(rating > 0){
                        $('.error-star').hide();
                    }else{
                        $('.error-star').show();
                    }
                });

                
            });
        }

        function callKeyUpValidate ()
        {
            //validate create
            keyUpValidate('content', 'errorContent', 'none', 'content', 'text-content-error');
        }
        

        $('.send_comment').click(function(){
            // $('.send_success').trigger('click');
            $('.fancybox-button').trigger('click');
        })
    });
</script>

<script>
    //sp vua xem
    $(function(){
        //get id product
        let idProduct = $('.blog-product-detail').attr('data-id');

        let products = localStorage.getItem("products");

        if(!products){
            arrayProduct = new Array();
            arrayProduct.push(idProduct);

            localStorage.setItem('products', JSON.stringify(arrayProduct));
        }else{
            //chuyen ve arr
            products = $.parseJSON(products);

            if(products.indexOf(idProduct) == -1){

                products.push(idProduct);
                localStorage.setItem('products', JSON.stringify(products));
            }   
        }
        // console.log(products);
    })

    $(document).ready(function(){
        like();
    });

    function like ()
    {
        $(document).on('click', '.js-like', function(){
            var id = $(this).data('id');
            var likeStatus = localStorage.getItem(id);

            if(likeStatus != 'liked'){
                // $('.total-like-'+id).show();
                var totalLike = $('.total-like-'+id).data('like');
                var increaseLike = parseInt(totalLike) + 1;
                var likeHtml = increaseLike.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $('.total-like-'+id).text('('+ likeHtml +')');
                // $('.icon-like-'+id).show();

                $.ajax({
                    url : '{{route('product.like.comment')}}',
                    type : "POST",
                    data : {
                        id : id
                    },
                    success : function(response)
                    {
                        localStorage.setItem(id, 'liked');
                    }
                });
            }
        });
    }
</script>
{{-- <script>
    $('.review-btn-show-all ').click(function(){
        $(this).parents('.form_danhgia').find('.show-3-item').removeClass('current');
        $(this).parents('.form_danhgia').find('.show-3-item').addClass('current');
        $(this).css('display', 'none');
        $('.review-btn-show-less').css('display', 'flex');
    })
    $('.review-btn-show-less ').click(function(){
        $(this).parents('.form_danhgia').find('.show-3-item').removeClass('current');
        $('.review-btn-show-all').css('display', 'flex');
        $(this).css('display', 'none');
    })
    
</script> --}}
@endsection
@section('js')


@endsection
