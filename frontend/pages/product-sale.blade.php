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

            <div class="block-product">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-sm-12  block-content-right">

                           <div class="info-count-pro">
                               <div class="count-pro">
                                    @if (isset($category)&&$category)
                                        {{ $category->name }}
                                    @endif
                               </div>
                            <div class="orderby">
                                <select name="orderby" id="" class="form-control field-form" form="formfill">
                                    <option value="0">Sắp sếp theo</option>
                                    <option value="1">Giá tăng dần</option>
                                    <option value="2">Giá giảm dần</option>
                                    {{-- <option value="3">Sale tăng dần</option>
                                    <option value="4">Sale giảm dần</option> --}}
                                </select>
                               </div>
                           </div>
                            @isset($data)
                                <div class="wrap-list-product" id="dataProductSearch">
                                    <div class="list-product-card">
                                        <div class="row">
                                            @if (isset($data)&&$data)
                                                @foreach ($data as $product)
                                                    @php
                                                        $tran=$product->translationsLanguage()->first();
                                                        $link=$product->slug_full;
                                                    @endphp
                                                    <div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-12">
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
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if (count($data))
                                        {{$data->appends(request()->all())->links()}}
                                        @endif
                                    </div>
                                </div>
                            @endisset
                            @if ($category->content)
                            <div class="content-category" id="wrapSizeChange">
                                {!! $category->content !!}
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-3 col-sm-12 col-xs-12 block-content-left">
                            @isset($sidebar)
                                @include('frontend.components.sidebar',[
                                    "categoryProduct"=>$sidebar['categoryProduct'],
                                    "categoryPost"=>$sidebar['categoryPost'],
                                    "categoryProductActive"=>$categoryProductActive,
                                    'fill'=>true,
                                    'product'=>true,
                                    'post'=>false,
                                ])
                            @endisset

                        </div>

                    </div>
                </div>
            </div>

            <form action="#" method="get" name="formfill" id="formfill" class="d-none">
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
@endsection
