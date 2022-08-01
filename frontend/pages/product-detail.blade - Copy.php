
@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('content')
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset

            {{--

             <div class="wrap-content-main wrap-template-product-detail template-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- START BLOCK : chitiet -->
                            <div class="wrap-top">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="product-detail-left-content">
                                                    <div class="image">
                                                        <a class="hrefImg" href="{{ asset($data->avatar_path) }}" data-lightbox="image"><img id="expandedImg" src="{{  asset($data->avatar_path) }}"></a>
                                                        @if ($data->sale)
                                                        {{  $data->sale." %"}}
                                                        @endif
                                                    </div>
                                                    <div class="list-image-small">
                                                        <div class="slider slide_small">
                                                           @foreach ($data->images as $image)
                                                           <div class="column">
                                                                 <img src="{{ asset($image->image_path) }}" alt="{name}">
                                                            </div>
                                                           @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-sm-12">
                                                <div class="product-information">
                                                    <h1 class="name-product">{{ $data->name }}</h1>
                                                    <div class="box-price-detail">
                                                        <span class="new-price">{{ $data->price." ".$unit }}</span>
                                                        <div class="desc-price">{{( $data->sale? $data->price*(100- $data->sale)/100:$data->price) ." ".$unit }}</div>
                                                    </div>
                                                    <div class="gioi_thieu">
                                                        {!! $data->description  !!}
                                                    </div>

                                                    <div class="product-action">
                                                        <div class="list-btn-action clearfix">
                                                           <a class="btn-add-cart add-to-cart" data-url="{{ route('cart.add',['id' => $data->id,]) }}">Thêm Vào Giỏ Hàng</a>
                                                           <a class="btn-buynow addnow" href="{{ route('cart.buy',['id' => $data->id,]) }}">Mua Ngay</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="wrap-tab-product-detail tab-category-1">
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    <!-- <div class="title">Daily Deals</div> -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active show" id="tab-1">
                                            <div class="tab-text">
                                               {!! $data->content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END BLOCK : chitiet -->
                            <div class="product-relate">
                                <div class="title-1">Sản phẩm liên quan</div>
                                @isset($dataRelate)
                                    @if ($dataRelate->count())
                                        <div class="list-product-card autoplay4">
                                            <!-- START BLOCK : cungloai -->
                                                @foreach($dataRelate as $product)
                                                    <div class="col-md-12">
                                                        <div class="product-card">
                                                            <div class="box">
                                                                <div class="card-top">
                                                                    <div class="image">
                                                                        <a href="{{ $product->slug_full }}">
                                                                            <img src="{{ asset($product->avatar_path) }}" alt="Sofa phòng khách SF08" class="image-card image-default">
                                                                        </a>
                                                                        @if ($product->sale)
                                                                        <span class="sale-1">-{{ $product->sale }}%</span>
                                                                        @endif

                                                                    </div>
                                                                    <ul class="list-quick">
                                                                        <li class="quick-view">
                                                                            <a href="{{ $product->slug_full }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                        </li>
                                                                        <li class="cart quick-cart">
                                                                            <a class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id,]) }}"><i class="fas fa-cart-plus"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="card-body">
                                                                    <h4 class="card-name"><a href="{{ $product->slug_full }}">{{ $product->name }}</a></h4>
                                                                    <div class="card-price">
                                                                        <span class="new-price">{{ $product->price_after_sale }} {{ $unit  }}</span>
                                                                        @if ($product->sale>0)
                                                                        <span class="old-price">{{ $product->price }} {{ $unit  }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            <!-- END BLOCK : cungloai -->
                                        </div>
                                    @endif
                                @endisset

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            --}}

            <div class="blog-product-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12  block-content-right">
                            <div class="row" >
                                <div class="col-sm-12" id="dataProductSearch">
                                    <div class="box-product-main">
                                        <div class="row" >
                                            <div class="col-md-6 col-sm-12 col-xs-12 ">
                                                <div class="box-image-product">
                                                    <div class="image-main block">
                                                        <a class="hrefImg" href="{{ asset($data->avatar_path) }}" data-lightbox="image">
                                                            <i class="fas fa-expand-alt"></i>
                                                            <img id="expandedImg" src="{{  asset($data->avatar_path) }}">
                                                        </a>
                                                        @if ($data->sale)
                                                            <span class="sale"> {{  $data->sale." %"}}</span>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="share">
                                                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-591d2f6c5cc3d5e5"></script>
                                                        <div class="addthis_inline_share_toolbox"></div>
                                                    </div> --}}
                                                    @if ($data->images()->count())
                                                    <div class="list-small-image">
                                                        <div class="pt-box autoplay5-product-detail">
                                                            <div class="small-image column">
                                                                <img src="{{ asset($data->avatar_path) }}" alt="{{ asset($data->name) }}">
                                                            </div>
                                                            @foreach ($data->images as $image)
                                                            <div class="small-image column">
                                                                <img src="{{ asset($image->image_path) }}" alt="{{ asset($image->name) }}">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                                <div class="desc-pro-detail-sm">
                                                    ***Lưu Ý: Hình ảnh chỉ mang tính chất minh hoạ. Sản phẩm là đá tự nhiên nên vân đá có thể thay đổi.
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 product-detail-infor">
                                                <div class="box-infor">
                                                    <h2>Sản phẩm: {{ $data->name }}</h2>
                                                    <div class="masp"><strong>Mã sản phẩm:</strong> {{ $data->masp }}</div>
                                                    <div class="status">
                                                        <strong><i class="fas fa-bahai"></i> Thương hiệu: </strong>
                                                       <span> {{ $data->model }} </span>
                                                    </div>
                                                    <div class="status">
                                                        <strong><i class="fas fa-bahai"></i> Trạng thái: </strong>
                                                        <span> {{ $data->tinhtrang }} </span>
                                                    </div>

                                                    <div class="status">
                                                        <strong><i class="fas fa-bahai"></i> Mệnh: </strong>
                                                        <span> {{ $data->baohanh }} </span>
                                                    </div>

                                                    <div class="status">
                                                        <strong><i class="fas fa-bahai"></i> Phụ kiện kèm theo: </strong>
                                                        <span> {{ $data->xuatsu }} </span>
                                                    </div>

                                                    @foreach ($data->attributes()->latest()->get() as $item)
                                                    <div class="status">
                                                        <strong><i class="fas fa-bahai"></i> {{ optional($item->parent)->name }}: </strong>
                                                       <span> {{ $item->name }} </span>
                                                    </div>
                                                    @endforeach

                                                    <div class="info-desc">
                                                        <div class="desc">
                                                            {!! $data->description !!}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="wrap-price">

                                                        <div class="list-attr">
                                                            {{-- <div class="attr-item">
                                                                <div class="form-group">
                                                                    <label for="">Charm</label>
                                                                    <select name="" id="input" class="form-control" required="required">
                                                                        <option value="">Vui lòng chọn</option>
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            <div class="attr-item">
                                                                <h3>Chọn size để xem giá sản phẩm</h3>
                                                                <div class="price">
                                                                    @if ($data->price_after_sale)
                                                                    <span>Giá:</span> <span id="priceChange">{{ number_format($data->price_after_sale) }} <span>Vnđ</span></span>
                                                                    @else
                                                                    Liên hệ
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="attr-item">
                                                                <div class="form-group">
                                                                    <label for="">Size Viên Đá</label>
                                                                    <select name="" id="input" class="form-control optionChange" required="required" >
                                                                        <option value="{{ $data->price_after_sale??0 }}-0">{{ $data->size??'Mặc định '.$data->size }}</option>
                                                                        @foreach ($data->options as $item)
                                                                             <option value="{{ $item->price_after_sale??0 }}-{{ $item->id }}">{{ $item->size }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="attr-item">
                                                                <div class="form-group">
                                                                    <label for="">Số lượng</label>
                                                                    <div class="wrap-add-cart" id="product_add_to_cart">
                                                                        <div class="box-add-cart">

                                                                            <div class="pro_mun">
                                                                                <a class="cart_qty_reduce cart_reduce">
                                                                                    <span class="iconfont icon fas fa-minus" aria-hidden="true"></span>
                                                                                </a>
                                                                                <input type="text" value="1" class="" name="cart_quantity" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" maxlength="5" min="1" id="cart_quantity" placeholder="">

                                                                                <a class="cart_qty_add">
                                                                                    <span class="iconfont icon fas fa-plus" aria-hidden="true"></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="attr-item">
                                                                <div class="form-group">
                                                                    <label for="">Size cổ tay</label>
                                                                    <input type="number" min="0" max="21" step="0.5" class="form-control" value="12">
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="text-left">
                                                            <div class="box-buy">
                                                                <a class="add-to-cart" id="addCart" data-url="{{ route('cart.add',['id' => $data->id,]) }}" data-start="{{ route('cart.add',['id' => $data->id,]) }}">Thêm vào giỏ hàng</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="box-price">
                                                        <span class="price price-number">
                                                        {{ number_format($data->price_after_sale) }} {{ $unit }}
                                                        </span>
                                                        @if ($data->sale)
                                                        <span class="price old-price"> {{ number_format($data->price) }} {{ $unit }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="box-buy">
                                                        <a class="btn-buynow addnow" href="{{ route('cart.buy',['id' => $data->id,]) }}"><span>Mua ngay</span></a>
                                                        <a class="add-to-cart" data-url="{{ route('cart.add',['id' => $data->id,]) }}"><span>Thêm vào giỏ</span></a>
                                                        <a class="add-compare" data-url="{{ route('compare.add',['id' => $data->id,]) }}"><span>Thêm vào so sánh</span></a>
                                                    </div> --}}


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-product">
                                        <div role="tabpanel">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                <li class="nav-item">
                                                  <a class="nav-link active"  data-toggle="tab" href="#mota" role="tab" aria-controls="profile" aria-selected="false">Chi tiết sản phẩm</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  data-toggle="tab" href="#chinhsach" role="tab" aria-controls="home" aria-selected="true">Thông tin liên hệ</a>
                                                  </li>
                                              </ul>
                                              <div class="tab-content" id="myTabContent">

                                                <div class="tab-pane fade  show active" id="mota" role="tabpanel" aria-labelledby="profile-tab">
                                                    {!! $data->content !!}
                                                </div>
                                                <div class="tab-pane fade" id="chinhsach" role="tabpanel" aria-labelledby="home-tab">  Đang cập nhập...</div>
                                              </div>


                                        </div>



                                        {{-- <div class="tab-link">
                                            <ul>
                                                <li><a href="#chinhsach" class="active">Chính sách</a></li>
                                                <li><a href="#mota" class="">Mô tả sản phẩm</a></li>
                                                <li><a href="#thongso">Thông số kỹ thuật</a></li>
                                                <li><a href="#chinhsachvanchuyen">Chính sách vận chuyển</a></li>
                                                <li><a href="#chinhsachbaohanh">Chính sách bảo hành</a></li>
                                            </ul>
                                        </div>

                                        <div class="tab-pro-content" id="wrapSizeChange">
                                            <div class="tab-item" id="chinhsach">
                                                Đang cập nhập
                                            </div>
                                            <div class="tab-item" id="mota">
                                                {!! $data->content !!}
                                            </div>
                                            <div class="tab-item" id="thongso">
                                                {!! $data->content2 !!}
                                            </div>
                                            <div class="tab-item" id="chinhsachvanchuyen">
                                                {!! $data->content3 !!}
                                            </div>
                                            <div class="tab-item" id="chinhsachbaohanh">
                                                {!! $data->content4 !!}
                                            </div>
                                        </div> --}}
                                    </div>
									<div class="product-relate">
                                        <div class="group-title">
                                            <div class="title title-img">Sản phẩm liên quan</div>
                                            <div class="img-title">
                                                <img src="{{ asset('frontend/images/bg-title.png') }}" alt="">
                                            </div>

                                    </div>
                                @isset($dataRelate)
                                    @if ($dataRelate->count())
                                        <div class="list-product-card autoplay4-pro category-slide-1">
                                            <!-- START BLOCK : cungloai -->

                                                @foreach ($dataRelate as $product)
                                                    @php
                                                        $tran=$product->translationsLanguage()->first();
                                                        $link=$product->slug_full;
                                                    @endphp
                                                    <div class="col-product-item col-lg-4 col-md-4 col-sm-6 col-12">
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
                                                                        @if ($product->price_after_sale)
                                                                        <span>{{ number_format($product->price_after_sale) }} vnđ</span>
                                                                        @else
                                                                        <span>Liên hệ</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            <!-- END BLOCK : cungloai -->
                                        </div>
                                    @endif
                                @endisset

                            </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-sm-12 col-xs-12 block-content-left">
                            @isset($sidebar)
                                @include('frontend.components.sidebar',[
                                    "categoryProduct"=>$sidebar['categoryProduct'],
                                    "categoryPost"=>$sidebar['categoryPost'],
                                    'fill'=>true,
                                    'product'=>true,
                                    'post'=>false,
                                    'urlActive'=>makeLink('category_products',$data->category->id,$data->category->slug) ,
                                ])
                            @endisset

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="get" name="formfill" id="formfill" class="d-none">
        @csrf
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.autoplay1').slick({
                dots: false,
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                speed: 300,
                autoplaySpeed: 3000,
            });
            $('.column').click(function() {
                var src = $(this).find('img').attr('src');
                $(".hrefImg").attr("href", src);
                $("#expandedImg").attr("src", src);
            });
            $('.slide_small').slick({
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                }]
            });


            $(document).on('click','.tab-link ul li a',function(){
                    $('.tab-link ul li a').removeClass('active');
                    $(this).addClass('active');
            });
            $('.autoplay5-product-detail').slick({
                dots: false,
                vertical:true,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
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
    <script type="text/javascript">
        $(document).ready(function() {
            var boxnumber = $('.box-add-cart input').val();
            parseInt(boxnumber);
            $('.cart_qty_add').click(function() {
                if ($(this).parent().parent().find('input').val() < 50) {
                    var a = $(this).parent().parent().find('input').val(+$(this).parent().parent().find(
                        'input').val() + 1);
                        let url = $('#addCart').data('start');
                        url += "?quantity=" + $('#cart_quantity').val();
                        $('#addCart').attr('data-url',url);
                }
            });
            $('.cart_qty_reduce').click(function() {
                if ($(this).parent().parent().find('input').val() > 1) {
                    if ($(this).parent().parent().find('input').val() > 1) $(this).parent().parent().find(
                        'input').val(+$(this).parent().parent().find('input').val() - 1);
                        let url = $('#addCart').data('start');
                        url += "?quantity=" + $('#cart_quantity').val();
                        $('#addCart').attr('data-url',url);
                }
            });
            $(document).on('change','.optionChange',function(){
                let val= ($(this).val()) ;
                let arrPriceAndId= val.split("-").map(function(value,index){
                    return parseInt(value);
                });
                console.log(arrPriceAndId);
                var nf = Intl.NumberFormat();

                let text= 'Liên hệ';
                let url = $('#addCart').data('start');
                url += "?quantity=" + $('#cart_quantity').val();
                if(arrPriceAndId[1]){
                    url += "&option=" + arrPriceAndId[1];
                }
                if(arrPriceAndId[0]>0){
                    let price= nf.format(arrPriceAndId[0]);
                    text=price+' vnđ';
                }
                $('#addCart').attr('data-url',url);
                $('#priceChange').text(text);
            });
        });
    </script>
@endsection
@section('js')
@endsection
