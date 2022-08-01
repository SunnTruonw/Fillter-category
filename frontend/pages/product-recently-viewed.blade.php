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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-left">
                                <div class="info-count-pro">
                                    <div class="count-pro">
                                        Sản phẩm vừa xem
                                    </div>
                                </div>
                                {{-- @if ($category->content)
                                <div class="content-category" id="wrapSizeChange">
                                    {!! $category->content !!}
                                </div>
                                @endif --}}
                                <div class="wrap-list-product" id="dataProductSearch">
                                    
                                </div>
                            
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

        $(document).on('click','.btn-search',function(event){
          // $( "#formfill" ).submit();
          event.preventDefault();

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

        $(document).on('submit',"[data-ajax='submit']",function(event){
          // $( "#formfill" ).submit();
          event.preventDefault();

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

        $(document).on('change','.field-change-link',function(){
          // $( "#formfill" ).submit();

           let link=$(this).val();
           if(link){
               window.location.href=link;
           }
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
    $(function(){
        // Sản phẩm vừa xem
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        let route = '{{route('product.renderProductView')}}';
        isCheckScroll = false;
        // $(document).on('load',function(){
            $(window).on('load', function() {

            // alert(123);
            // if($(window).scrollTop() > 50 && isCheckScroll == false){
            //     isCheckScroll = true;
                let products = localStorage.getItem("products");
                products = $.parseJSON(products);

                // console.log('log', products);

                if(products && products.length > 0){
                    $.ajax({
                        url : route,
                        data : {id : products},
                        method : 'GET',
                        success : function(data){
                            // console.log(data.data);
                            $('#dataProductSearch').html('').append(data.data);
                        }
                    })
                }
            // }
        });
        //End sản phẩm vừa xem
    })
</script>
@endsection
