@extends('frontend.layouts.main')
@section('title', $header['seo_home']->name)
@section('image', asset($header['seo_home']->image_path))
@section('keywords', $header['seo_home']->slug)
@section('description', $header['seo_home']->value)
@section('abstract', $header['seo_home']->slug)

@section('content')
    <div class="content-wrapper">
        <div class="main">
            <!-- <h1 class="d-none">
                {h1trangchu}
            </h1>
            <h2 class="d-none">
                {h2trangchu}
            </h2> -->
            <div class="bg-home">
                <div class="slide">
                    @isset($slider)
                    <div class="box-slide faded cate-arrows-1 d-none d-md-block">
                        @foreach ($slider as $item)
                        <div class="item-slide">
                            <a href=""><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
                        </div>
                        @endforeach
                    </div>
                    @endisset
                    @isset($slidersM)
                    <div class="box-slide faded cate-arrows-1 d-block d-md-none" >
                        @foreach ($slidersM as $item)
                        <div class="item-slide">
                            <a href=""><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
                        </div>
                        @endforeach
                    </div>
                    @endisset
                </div>

                {{--
                <div class="wrap-category-product">
                    <div class="container">
                        <div class="row">
                            @if (isset($categoryProductHome)&&$categoryProductHome)
                            @foreach ($categoryProductHome->childs()->where('active',1)->orderby('order')->latest()->limit(5)->get() as $item)
                            @if ($loop->index)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 col-category-item">
                                    <div class="category-item">
                                        <a class="box" href="{{ $item->slug_full }}">
                                            <div class="content">
                                                <h3>{{ $item->name }}</h3>
                                                <h4>Xem thêm</h4>
                                            </div>
                                            <div class="image">
                                                <div class="padding-image">
                                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 col-category-item col-category-item-2">
                                    <div class="category-item">
                                        <a class="box" href="{{ $item->slug_full }}">
                                            <div class="content">
                                                <h3>{{ $item->name }}</h3>
                                                <h4>Xem thêm</h4>
                                            </div>
                                            <div class="image">
                                                <div class="padding-image">
                                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                --}}
                <div class="cate_home">
                    <div class="container">
                        <div class="row">
                            <div class="list_cate">
                                @if( isset($thongtin_danhmucsp) && $thongtin_danhmucsp->count()>0)
								<div class="cate_info">
									<div class="desc">
									   {!! $thongtin_danhmucsp->description !!}
									</div>
                                    <div class="name">{{ $thongtin_danhmucsp->value }}</div>
                                    <!-- <div class="line_column"></div> -->
								</div>
                                @endif
                                <div class="slide_cate cate-dot-1">
                                    @if (isset($categoryProductHome)&&$categoryProductHome)
                                    @foreach ($categoryProductHome->childs()->where('active',1)->orderby('order')->latest()->limit(10)->get() as $item)
                                    <div class="item">
                                        <a href="{{ $item->slug_full }}">
                                            <div class="box">
                                                <div class="image">
                                                    <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                                </div>
                                                <div class="content">
                                                    <h4>{{ $item->name }}</h4>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="list_cate list_cate2">
                                @if (isset($categoryProductHome2)&&$categoryProductHome2)
                                @foreach ($categoryProductHome2 as $item)
                                <div class="item">
                                    <div class="box">
                                        <div class="image">
                                            <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                        </div>
                                        <div class="content">
                                            <h4>{{ $item->name }}</h4>
                                            <ul class="category-list">
                                                @foreach($item->childs()->where('active',1)->orderby('order')->latest()->get() as $item2 )
                                                <li><a href="{{ $item2->slug_full }}">{{ $item2->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            {{--
                            <div class="list_banner">
                                <div class="item">
                                    <div class="box">
                                        <div class="image">
                                            <img src="{{ asset('/frontend/images/9.jpg') }}">
                                        </div>
                                        <div class="banner_content">
                                            <h4>
                                                Flash Sale <span>50%
                                                    OFF</span>
                                            </h4>
                                            <h3>Wireless Earphone
                                            </h3>
                                            <div class="dec">
                                                Only until the end of this Week
                                            </div>
                                            <a href="" class="btn btn-rounded btn-white btn-outline">Shop Now<i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="box">
                                        <div class="image">
                                            <img src="{{ asset('/frontend/images/10.jpg') }}">
                                        </div>
                                        <div class="banner_content">
                                            <h4>
                                               Best Sellers Store
                                            </h4>
                                            <h3>Up To 30% OFF
                                            </h3>
                                            <div class="dec">
                                                Feel the charm in this spot
                                            </div>
                                            <a href="" class="btn btn-rounded btn-white btn-outline">Shop Now<i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>



                <div class="wrap-pro-tab-home">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs" id="" role="tablist">
									{{-- <div class="group-title1">
                                    	<div class="title1">Sản phẩm bán chạy</div>
									</div>
									<div class="title-b">
										<span>Thỏa sức thể hiện sự kiêu kỳ, phô diễn trọn vẹn vẻ đẹp kim cương thiên nhiên tiêu chuẩn quốc tế và hoàn hỏa nhất</span>
									</div> --}}
                                    @if (isset($titleSPBanchay)&&$titleSPBanchay)
                                    <div class="group-title">
                                        <div class="title title-img">{{ $titleSPBanchay->name }}</div>
                                        <div class="img-title">
                                            <img src="{{ asset('frontend/images/b.png') }}" alt="">
                                        </div>
                                        <div class="title-b">
                                            <span>
                                               {!! $titleSPBanchay->description !!}
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </ul>
                                <div class="tab-content" id="">
                                    <div class="tab-pane fade show active" id="pro-tab-1" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="list-product">
                                            <div class="row">
                                                @if (isset($productsBest)&&$productsBest)
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
                                                                        <img src="{{ asset($product->avatar_path) }}" alt="{{ $tran->name }}">
                                                                        @if ($product->sale)
                                                                        <span class="sale"> {{  $product->sale." %"}}</span>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="content">
                                                                    <h3>
                                                                        <a href="{{ $link }}">
                                                                           {{ $tran->name }}
                                                                        </a>
                                                                    </h3>
                                                                    <div class="box-price">
                                                                        <span class="new-price">Giá bán: {{ $product->price_after_sale?number_format($product->price_after_sale)." ".$unit:"Liên hệ" }}</span>
                                                                        @if ($product->sale>0)
                                                                            <span class="old-price">{{ number_format($product->price) }} {{ $unit  }}</span>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				{{-- <div class="wrap-suutap">
					<div class="bg_slide">
						<div class="image">
							<img src="{{ asset('frontend/images/icon-luontop.png') }}" alt="background">
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-12">
								<div class="box-about">
									<div class="bosuutap">
										<h4><strong>{{ $collection->slug }}</strong> {{ $collection->value }}</h4>
										<h2>{{ $collection->name }}</h2>
										<p>{!! $collection->description !!}</p>
										<div class="text-left">
											<a href="http://demo.dkcauto.net/product/category/bo-suu-tap" class="btn btn-about">Xem bộ sưu tập</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-12">
								<!--<div class="img_right">
									<img src="{{ asset($collection->image_path) }}" alt="{{ $collection->name }}">
								</div>-->
							</div>
						</div>
					</div>
					<div class="bg_slide1">
						<div class="image1">
							<img src="{{ asset('frontend/images/icon-luontop-bottom.png') }}" alt="background">
						</div>
					</div>
				</div> --}}
                <div class="wrap-banner-home">
                    @if (isset($banner)&&$banner)
                    <div class="item-banner">
                        <a href="{{ $banner->slug }}">
                            <img src="{{ asset($banner->image_path) }}" alt="{{ $banner->name }}">
                        </a>
                    </div>
                    @endif
                    {{--
                    @if (isset($bosuutapM)&&$bosuutapM)
                    <div class="item-banner d-block d-md-none">
                        <a href="{{ $bosuutapM->slug }}">
                            <img src="{{ asset($bosuutapM->image_path) }}" alt="{{ $bosuutapM->name }}">
                        </a>
                    </div>
                    @endif
                    --}}
                </div>
				<div class="wrap-pro-tab-home">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs" id="" role="tablist">
                                    @if (isset($titleSMMoi)&&$titleSMMoi)
                                    <div class="group-title">
                                        <div class="title title-img">{{ $titleSMMoi->name }}</div>
                                        <div class="img-title">
                                            <img src="{{ asset('frontend/images/b.png') }}" alt="">
                                        </div>
                                        <div class="title-b">
                                            <span>
                                               {!!  $titleSMMoi->description   !!}
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </ul>
                                <div class="tab-content" id="">
                                    <div class="tab-pane fade show active" id="pro-tab-1" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="list-product">
                                            <div class="row">
                                                @if (isset($productNew)&&$productNew)
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
                                                                        <img src="{{ asset($product->avatar_path) }}" alt="{{ $tran->name }}">
                                                                        @if ($product->sale)
                                                                        <span class="sale"> {{  $product->sale." %"}}</span>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="content">
                                                                    <h3>
                                                                        <a href="{{ $link }}">
                                                                           {{ $tran->name }}
                                                                        </a>
                                                                    </h3>
                                                                    <div class="box-price">
                                                                        <span class="new-price">Giá bán: {{ $product->price_after_sale?number_format($product->price_after_sale)." ".$unit:"Liên hệ" }}</span>
                                                                        @if ($product->sale>0)
                                                                            <span class="old-price">{{ number_format($product->price) }} {{ $unit  }}</span>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				{{--<div class="sale_home">
                    <img class="d-none d-md-block" src="{{ asset($collection->image_path) }}" alt="{{ $collection->name }}">
                    @if (isset($khuyenMaiM)&&$khuyenMaiM)
                    <img class="d-block d-md-none" src="{{ asset($khuyenMaiM->image_path) }}" alt="{{ $khuyenMaiM->name }}">
                    @endif
				</div>--}}

                @if (isset($dichvu)&&$dichvu)
                <div class="cam_ket">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="group-title">
                                    <div class="title title-img">{{ $dichvu->name }}</div>
                                    <div class="img-title">
                                        <img src="{{ asset('frontend/images/b.png') }}" alt="">
                                    </div>
                                    <div class="title-b">
                                        <span>
                                           {{ $dichvu->value }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="row">
                                    <div class="list_camket">
                                        @foreach ($dichvu->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                        <div class="item">
                                            <div class="box">
                                                <div class="image">
                                                    <img src="{{ asset($item->image_path) }}" alt="{{$item->name}}">
                                                </div>
                                                <div class="info">
                                                    <div class="name">{{$item->name}}</div>
                                                    <div class="desc">{{$item->value}}</div>
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
                {{--
                <div class="wrap-service d-block d-md-none">
                    <img src="{{asset($dichvuM->image_path)}}" alt="{{$dichvuM->name}}">
                </div>
                --}}
                <div class="wrap-ykkh">
                    <div class="container">
                        <div class="row">
                            @if (isset($camnhan)&&$camnhan)
                            <div class="col-12 col-sm-12">
                                <div class="group-title">
                                    <div class="title title-img">{{ $camnhan->name }}</div>
                                    <div class="img-title">
                                        <img src="{{ asset('frontend/images/b.png') }}" alt="">
                                    </div>
                                    <div class="title-b">
										<span>
                                           {{ $camnhan->value }}
                                        </span>
									</div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="list-ykkh autoplay4-ykkh category-slide-1">
                                    @foreach ($camnhan->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                    @php
                                        $tran=$item->translationsLanguage()->first();
                                    @endphp
                                    <div class="col-ykkh-item">
                                        <div class="item-ykkh">
                                            <div class="nd_ykien">
                                                {!! $tran->description !!}
                                            </div>
                                            <div class="box">
                                                <img src="{{ asset($item->image_path) }}" alt="{{ $tran->name }}">
                                            </div>
                                            <div class="box_right">
                                                <h2>{{ $tran->name }}</h2>
                                                <p>{{ $tran->slug }}</p>
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
                <div class="parallax-section2"></div>

                <div class="wrap-post-home">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                @if (isset($titlePostNew)&&$titlePostNew)
                                <div class="group-title">
                                    <div class="title title-img">{{ $titlePostNew->name }}</div>
                                    <div class="img-title">
                                        <img src="{{ asset('frontend/images/b.png') }}" alt="icon">
                                    </div>
                                    <div class="title-b">
                                        <span>
                                           {!! $titlePostNew->description !!}
                                        </span>
                                    </div>
                                </div>
                                @endif

                                <div class="list-post-home tin-tuc-home category-slide-1 category-slide-2">
                                    @if(isset($postNew)&&$postNew)
                                    @foreach ($postNew as $post)
                                    @php
                                        $tran=$post->translationsLanguage()->first();
                                        $link=$post->slug_full;
                                    @endphp
                                    <div class="item-post">
                                        <div class="box">
                                         <div class="image">
                                             <a href="{{ $link }}"><img src="{{ asset($post->avatar_path) }}" alt="{{ $tran->name }}"></a>
                                             <div class="info">
                                                 <span>{{ date_format($post->created_at,'d/m/Y') }}</span>
                                             </div>
                                         </div>
                                         <div class="content">
                                             <div class="name"><a href="{{ $link }}">{{ $tran->name }}</a></div>
                                             <div class="desc">
                                                 {!! $tran->description !!}
                                             </div>
                                             <div class="text-left">
                                                <a href="{{ $link }}" class="link-detail">Chi tiết <i class="fas fa-long-arrow-alt-right"></i></a>
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
            {{-- <div class="wrap-product-home">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-h1">
                                <span class="text"><strong>Sản phẩm</strong> hot</span>
                                <div id="countdown">
                                    <div id="tiles">
                                      <span id="days">0</span>
                                      <span id="hours">0</span>
                                      <span id="minutes">0</span>
                                      <span id="seconds">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-product-home">
                                <div class="row">
                                    <div class="slide-pro autoplay5-pro cate-arrows-1">
                                        @foreach ($productHot as $product)
                                        <div class="col-md-3 col-product-card">
                                            <div class="product-card">
                                                <div class="box">
                                                    <div class="image">
                                                        <a href="{{ $product->slug_full }}"><img src="{{ asset($product->avatar_path) }}" alt="{{ asset($product->name) }}"></a>
                                                        <span class="hot">Hot</span>
                                                        @if ($product->sale)
                                                        <span class="sale">-{{ $product->sale }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="content">
                                                        <h3 class="name"><a href="{{ $product->slug_full }}">{{$product->name}}</a></h3>
                                                        <div class="box-price">
                                                            <span class="new-price">{{ $product->price_after_sale?number_format($product->price_after_sale)." ".$unit:"Liên hệ" }}</span>
                                                            @if ($product->sale>0)
                                                            <span class="old-price">{{ number_format($product->price) }} {{ $unit  }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                        <ul>
                                                            <li class="a-cart"><a class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}"><i class="fas fa-cart-plus"></i></a></li>
                                                            <li class="a-view"><a href="{{ $product->slug_full }}"><i class="fas fa-eye"></i></a></li>
                                                            <li class="a-view"><a class="add-compare" data-url="{{ route('compare.add',['id' => $product->id,]) }}">   <svg viewBox="-5 0 459 459.648" xmlns="http://www.w3.org/2000/svg"><path d="m416.324219 293.824219c0 26.507812-21.492188 48-48 48h-313.375l63.199219-63.199219-22.625-22.625-90.511719 90.511719c-6.246094 6.25-6.246094 16.375 0 22.625l90.511719 90.511719 22.625-22.625-63.199219-63.199219h313.375c44.160156-.054688 79.945312-35.839844 80-80v-64h-32zm0 0"></path><path d="m32.324219 165.824219c0-26.511719 21.488281-48 48-48h313.375l-63.199219 63.199219 22.625 22.625 90.511719-90.511719c6.246093-6.25 6.246093-16.375 0-22.625l-90.511719-90.511719-22.625 22.625 63.199219 63.199219h-313.375c-44.160157.050781-79.949219 35.839843-80 80v64h32zm0 0"></path></svg></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-sm-12">
                            <div class="title-h1">
                                <div class="text">
                                    <strong>Sản phẩm</strong> mới nhất
                                </div>
                             </div>
                            <div class="list-product-home">
                                <div class="row">
                                    <div class="slide-pro autoplay5-pro cate-arrows-1">
                                        @foreach ($productNew as $product)
                                        <div class="col-md-3 col-product-card">
                                            <div class="product-card">
                                                <div class="box">
                                                    <div class="image">
                                                        <a href="{{ $product->slug_full }}"><img src="{{ asset($product->avatar_path) }}" alt="{{ asset($product->name) }}"></a>
                                                        <span class="hot">New</span>
                                                        @if ($product->sale)
                                                        <span class="sale">-{{ $product->sale }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="content">
                                                        <h3 class="name"><a href="{{ $product->slug_full }}">{{$product->name}}</a></h3>
                                                        <div class="box-price">
                                                            <span class="new-price">{{ $product->price_after_sale?number_format($product->price_after_sale)." ".$unit:"Liên hệ" }}</span>
                                                            @if ($product->sale>0)
                                                            <span class="old-price">{{ number_format($product->price) }} {{ $unit  }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                        <ul>
                                                            <li class="a-cart"><a class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}"><i class="fas fa-cart-plus"></i></a></li>
                                                            <li class="a-view"><a href="{{ $product->slug_full }}"><i class="fas fa-eye"></i></a></li>
                                                            <li class="a-view"><a class="add-compare" data-url="{{ route('compare.add',['id' => $product->id,]) }}">   <svg viewBox="-5 0 459 459.648" xmlns="http://www.w3.org/2000/svg"><path d="m416.324219 293.824219c0 26.507812-21.492188 48-48 48h-313.375l63.199219-63.199219-22.625-22.625-90.511719 90.511719c-6.246094 6.25-6.246094 16.375 0 22.625l90.511719 90.511719 22.625-22.625-63.199219-63.199219h313.375c44.160156-.054688 79.945312-35.839844 80-80v-64h-32zm0 0"></path><path d="m32.324219 165.824219c0-26.511719 21.488281-48 48-48h313.375l-63.199219 63.199219 22.625 22.625 90.511719-90.511719c6.246093-6.25 6.246093-16.375 0-22.625l-90.511719-90.511719-22.625 22.625 63.199219 63.199219h-313.375c-44.160157.050781-79.949219 35.839843-80 80v64h32zm0 0"></path></svg></a></li>
                                                        </ul>
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
            </div> --}}






            {{-- <div class="wrap-news-home wow fadeInUp">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">

                                <div class="title-h">
                                   <div class="text">
                                    Tin tức nổi bật
                                   </div>
                                </div>

                            @isset($postsHot)
                            <div class="row">
                                <div class="list-news-home slide-pro autoplay3-news cate-dot-1 cate-arrows-1 ">
                                    @foreach ($postsHot as $post_item)
                                    <div class="fo-03-news col-sm-12">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ makeLink('post',$post_item->id,$post_item->slug) }}">
                                                    <img src="{{asset($post_item->avatar_path)}}" alt="{{$post_item->name}}">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <div class="caption">
                                                    <span class="time">{{ Illuminate\Support\Carbon::parse($post_item->created_at)->format('M d Y') }}</span>
                                                    <span class="auth"><i class="fas fa-user"></i> admin</span>
                                                </div>
                                                <h3><a href="{{ makeLink('post',$post_item->id,$post_item->slug) }}">{{$post_item->name}}</a></h3>
                                                <div class="desc">
                                                    {{$post_item->description}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div> --}}


        </div>
        {{--
        <style>
            .modal-First .modal-content{
                background-image: url({{ asset($modalHome->image_path) }});
            }
            @media(max-width:767px){
              .modal-First .modal-content {
                   background-image: url( {{ asset($popM->image_path) }});
                }
            }
        </style>
        --}}
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
                                    <button>Đăng ký ngay</button>
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

       setTimeout(() => $('#modal-first').modal('show'), 10000);
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
