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
                    <div class="col-12 col-sm-9">
						@isset($slider)
							<div class="box-slide faded cate-arrows-1">
								@foreach ($slider as $item)
								<div class="item-slide">
									<a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
								</div>
								@endforeach
							</div>
						@endisset
                    </div>
					@if (isset($slidesub)&&$slidesub)
					<div class="col-12 col-sm-3 padding_slide">
                          @foreach ($slidesub->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                        @php
                            $tran=$item->translationsLanguage()->first();
                        @endphp
                          <div class="slide_sub_home">
							  <a href="{{ $item->slug }}"><img src="{{ $item->image_path != null ?  asset($item->image_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}"></a>
                          </div>
                          @endforeach
                    </div>
					@endif
				</div>
			</div>
        </div>
		@if (isset($hotro)&&$hotro)
		<div class="support">
			<div class="container-fluid">
				<div class="row">
                    @foreach ($hotro->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                        @php
                            $tran=$item->translationsLanguage()->first();
                        @endphp
                        <div class="col-xs-3 item">
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
		<div class="ss03_product">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">GIÁ TỐT MỖI TUẦN</div>
                        </div>
                    </div>
					<div class="col-12 col-sm-12">
						@if( isset($productsBest) && $productsBest->count()>0 )
                            <div class="list_feedback1 autoplay6-tintuc category-slide-1">
                                @foreach ($productsBest as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link=$product->slug_full;
                                @endphp
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">   {{ceil(100 -($product->price)*100/($product->old_price))." %"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                <div class="pro-item-star">
                                                    <span class="pro-item-start-rating">
                                                        @php
                                                            $avgRating = 0;
                                                            $sumRating = array_sum(array_column($product->productStars->toArray(), 'star'));
                                                            $countRating = count($product->productStars);
                                                            if ($countRating != 0) {
                                                                $avgRating = $sumRating / $countRating;
                                                            }
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avgRating)
                                                                <i class="star-bold far fa-star"></i>
                                                            @else
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
												<div id="countdown1">
													<div id="tiles1">
														<div class="item1">
															<span class="days1">08</span>
															<div class="labels1">Ngày</div>
														</div>
														<div class="item1">
															<span class="hours1">0</span>
															<div class="labels1">Giờ</div>
														</div>
														<div class="item1">
															<span class="minutes1">0</span>
															<div class="labels1">Phút</div>
														</div>
														<div class="item1">
															<span class="seconds1">0</span>
															<div class="labels1">Giây</div>
														</div>
													</div>
												</div>
                                                <div class="box-price">
                                                    <span class="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
                                                    @if ($product->old_price>0)
                                                        <span class="old-price">{{ number_format($product->old_price) }} {{ $unit  }}</span>
                                                    @endif
                                                </div>
                                                {{--<div class="xemthem_home">
                                                    <a id="addCart" class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">Mua hàng</a>
                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                        </div>
                </div>
            </div>
         </div>
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
						//$(".days1").text(days);
						$(".hours1").text(hours);
						$(".minutes1").text(minutes);
						$(".seconds1").text(seconds);
					}
				}
			});
	</script>
		{{--
		<div class="ss03_product" style="background: #eee;">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">{{ __('home.san_pham_moi1') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        @if( isset($productNew) && $productNew->count()>0 )
                        <div class="list-product">
                            <div class="row">
                                @foreach ($productNew as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link=$product->slug_full;
                                @endphp
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">  {{ceil(100 -($product->price)*100/($product->old_price))." %" }}</span>
                                                    @endif

                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                <div class="pro-item-star">
                                                    <span class="pro-item-start-rating">
                                                        @php
                                                            $avgRating = 0;
                                                            $sumRating = array_sum(array_column($product->productStars->toArray(), 'star'));
                                                            $countRating = count($product->productStars);
                                                            if ($countRating != 0) {
                                                                $avgRating = $sumRating / $countRating;
                                                            }
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avgRating)
                                                                <i class="star-bold far fa-star"></i>
                                                            @else
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                <div class="box-price">
                                                    <span class="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
                                                    @if ($product->old_price>0)
                                                        <span class="old-price">{{ number_format($product->old_price) }} {{ $unit  }}</span>
                                                    @endif
                                                </div>
                                                <div class="xemthem_home">
                                                    <a id="addCart" class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">Mua hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>--}}
		{{--
		<div class="ss03_product">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">{{ __('home.san_pham_moi2') }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        @if( isset($productsHeart) && $productsHeart->count()>0 )
                        <div class="list-product">
                            <div class="row">
                                @foreach ($productsHeart as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link=$product->slug_full;
                                @endphp
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale"> {{ceil(100 -($product->price)*100/($product->old_price))." %"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                <div class="pro-item-star">
                                                    <span class="pro-item-start-rating">
                                                        @php
                                                            $avgRating = 0;
                                                            $sumRating = array_sum(array_column($product->productStars->toArray(), 'star'));
                                                            $countRating = count($product->productStars);
                                                            if ($countRating != 0) {
                                                                $avgRating = $sumRating / $countRating;
                                                            }
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avgRating)
                                                                <i class="star-bold far fa-star"></i>
                                                            @else
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                <div class="box-price">
                                                    <span class="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
                                                    @if ($product->old_price>0)
                                                        <span class="old-price">{{ number_format($product->old_price) }} {{ $unit  }}</span>
                                                    @endif
                                                </div>
                                                <div class="xemthem_home">
                                                    <a id="addCart" class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">Mua hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>	--}}
  @if (isset($categoryProductHome)&&$categoryProductHome)
      @foreach ($categoryProductHome as $item)
		<div class="ss04_product">
			<div class="container-fluid">
				<div class="row">
					@if($item->icon_path)
					<div class="col-12 col-sm-12">
						<div class="images_danhmuc">
								<a href="{{ $item->slug_full }}"><img src="{{ asset($item->icon_path) }}" alt="{{ $item->name }}"></a>
						</div>
                    </div>
					@endif
                    <div class="col-12 col-sm-12">
						<div class="group_title">
                            <h3 class="title title-underline"><a href="{{ $item->slug_full }}">{{ $item->name }}</a></h3>
							<div class="xemthem_home"><a href="{{ $item->slug_full }}">Xem tất cả <i class="fas fa-angle-right"></i></a></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        @if( isset($item) && $item->count()>0 )
						
						@php
							$categoryProduct = 	new App\Models\CategoryProduct;
							$product = new App\Models\Product;
							$listIdProduct = $categoryProduct->getALlCategoryChildrenAndSelf($item->id);
						
							$datProducts = $product->whereIn('category_id', $listIdProduct)->where('active',1)->limit(10)->get();
						@endphp
                        <div class="list-product">
                            <div class="row">
                                @foreach ($datProducts as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link=$product->slug_full;
                                @endphp
                                <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">  {{ceil(100 -($product->price)*100/($product->old_price))." %"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                <div class="pro-item-star">
                                                    <span class="pro-item-start-rating">
                                                        @php
                                                            $avgRating = 0;
                                                            $sumRating = array_sum(array_column($product->productStars->toArray(), 'star'));
                                                            $countRating = count($product->productStars);
                                                            if ($countRating != 0) {
                                                                $avgRating = $sumRating / $countRating;
                                                            }
                                                        @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $avgRating)
                                                                <i class="star-bold far fa-star"></i>
                                                            @else
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                <div class="box-price">
                                                    <span class="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
                                                    @if ($product->old_price>0)
                                                        <span class="old-price">{{ number_format($product->old_price) }} {{ $unit  }}</span>
                                                    @endif
                                                </div>
                                                {{--<div class="xemthem_home">
                                                    <a id="addCart" class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">Mua hàng</a>
                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>	
	@endforeach 
 @endif
{{--<div class="banner-home">
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
</div>--}}
		
<div class="wrap-partner">
    <div class="container-fluid">
        <div class="row">
			<div class="col-12 col-sm-12">
                <div class="group-title">
                    <div class="title title-img">ĐỐI TÁC CHIẾN LƯỢC</div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="list-item autoplay5-doitac category-slide-1">
                    @if ($footer['doitac'])
                    @foreach ($footer['doitac']->childs()->orderby('order')->orderByDesc('created_at')->get() as $item)
                    <div class="item">
                        <div class="box">
                            <a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
			
        <div class="section_news">
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
		</div>
        <div class="wrap-ykkh">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="group-title">
                                <div class="title title-img">Video clip</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="list_feedback autoplay6-video category-slide-1">
                                @if($post_home_video)
                        		@foreach($post_home_video->take(-7) as $value)
								<div class="post-cate">
									<a data-fancybox="" class="hv-over" href="{!! $value->description !!}" title="{{$value->name}}" tabindex="0">
										<img class="lazy" src="{{ $value->avatar_path != null ? asset($value->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{$value->name}}" title="{{$value->name}}" data-a="{{ $value->avatar_path != null ? asset($value->avatar_path) : '../frontend/images/no-images.jpg' }}" style="width: 100%; height: auto; opacity: 1;">
										<div class="flex-center mfw-absolute-full d-flex justify-content-center align-items-center">
											<img src="../frontend/images/icon-play-youtube.png" width="80px" height="80px">
										</div>
									</a>
									<h3 class="title title-video">
										<a data-fancybox="" class="smooth" href="{!! $value->description !!}" title="{{$value->name}}" tabindex="0">{{$value->name}}</a>
									</h3>
								</div>
                                @endforeach
								@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
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
            <div class="container">
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
