@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')

{{-- <style>
    .tab-content{
        display: none;
    }
    .tab-content.current{
        display: block !important;
    }
</style> --}}
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset
            <div class="wrap-content-main wrap-template-product template-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-right">
                            <h3 class="title-template">Đơn đặt hàng của tôi</h3>
                            <div class="menu-order">
                                <ul class="nav-main-order">
                                    <li class="nav-item-order active-cart-title" data-tab="dang-xu-ly" data-id_status="all"> 
                                        <a><span>Tất cả đơn hàng</span></a>
                                    </li>

                                    <li class="nav-item-order" data-tab="nhan-don" data-id_status="1"> 
                                        <a><span> Đơn mới</span> </a>
                                    </li>
                                
                                    <li class="nav-item-order" data-tab="dang-van-chuyen" data-id_status="3">
                                        <a><span>Đang vận chuyển</span> </a>
                                    </li>
                                
                                    <li class="nav-item-order" data-tab="giao-thanh-cong" data-id_status="4">
                                        <a><span> Đơn giao thành công</span> </a>
                                    </li>
                                
                                    <li class="nav-item-order" data-tab="huy" data-id_status="5">
                                        <a><span> Đơn đã hủy</span> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-main-order">
                                <div class="tab-content content1 current">
                                    <div class="block-item">
                                        <div class="container">
                                            <div class="cart-top" id="results">
                                                <table>
                                                    <thead>
                                                        <tr class="cart-table-header">
                                                            <td>STT</td>
                                                            <td>Tên sản phẩm</td>
                                                            <td>Số lượng</td>
                                                            <td>Tổng tiền</td>
                                                            <td>Trạng thái</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $value)
                                                            @foreach($value->orders as $item)
                                                                <tr>
                                                                    <td>
                                                                        {{$key+1}}
                                                                    </td>
                                                                    <td>
                                                                        <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                                                            <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                                                                        </a>
                                            
                                                                        <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                                                                        @if(isset($value->color_name) || isset($value->size_name))
                                                                        <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="cart-title-pro">
                                                                        {{$item->quantity}}
                                                                    </td>
                                                                    <td class="cart-title-pro">
                                                                        @php
                                                                            $total = $item->new_price * $item->quantity;
                                                                        @endphp
                                                                        {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                                                                    </td>
                                                                    <td class="cart-title-pro">
                                                                        @include('admin.components.status',[
                                                                            'dataStatus'=>$value,
                                                                            'listStatus'=>$listStatus,
                                                                        ])
                                                                     </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="cboth"></div>
                                            </div>
                                            <!-- end cart top-->
                                        </div>
                                    </div>                                    
                                </div>
                                {{-- <div class="tab-content content2">
                                    <div class="block-item">
                                        <div class="container">
                                            <div class="cart-top">
                                                <table>
                                                    <thead>
                                                        <tr class="cart-table-header">
                                                            <td>STT</td>
                                                            <td>Tên sản phẩm</td>
                                                            <td>Số lượng</td>
                                                            <td>Tổng tiền</td>
                                                            <td>Trạng thái</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $value)
                                                            @if($value->status == 2)
                                                                @foreach($value->orders as $item)
                                                                    <tr>
                                                                        <td>
                                                                            {{$key+1}}
                                                                        </td>
                                                                        <td>
                                                                            <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                                                                <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                                                                            </a>
                                                
                                                                            <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                                                                            @if(isset($value->color_name) || isset($value->size_name))
                                                                            <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            {{$item->quantity}}
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @php
                                                                                $total = $item->new_price * $item->quantity;
                                                                            @endphp
                                                                            {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @include('admin.components.status',[
                                                                                'dataStatus'=>$value,
                                                                                'listStatus'=>$listStatus,
                                                                            ])
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="cboth"></div>
                                            </div>
                                            <!-- end cart top-->
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab-content content3">
                                    <div class="block-item">
                                        <div class="container">
                                            <div class="cart-top">
                                                <table>
                                                    <thead>
                                                        <tr class="cart-table-header">
                                                            <td>STT</td>
                                                            <td>Tên sản phẩm</td>
                                                            <td>Số lượng</td>
                                                            <td>Tổng tiền</td>
                                                            <td>Trạng thái</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $value)
                                                            @if($value->status == 3)
                                                                @foreach($value->orders as $item)
                                                                    <tr>
                                                                        <td>
                                                                            {{$key+1}}
                                                                        </td>
                                                                        <td>
                                                                            <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                                                                <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                                                                            </a>
                                                
                                                                            <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                                                                            @if(isset($value->color_name) || isset($value->size_name))
                                                                            <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            {{$item->quantity}}
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @php
                                                                                $total = $item->new_price * $item->quantity;
                                                                            @endphp
                                                                            {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @include('admin.components.status',[
                                                                                'dataStatus'=>$value,
                                                                                'listStatus'=>$listStatus,
                                                                            ])
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="cboth"></div>
                                            </div>
                                            <!-- end cart top-->
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab-content content4">
                                    <div class="block-item">
                                        <div class="container">
                                            <div class="cart-top">
                                                <table>
                                                    <thead>
                                                        <tr class="cart-table-header">
                                                            <td>STT</td>
                                                            <td>Tên sản phẩm</td>
                                                            <td>Số lượng</td>
                                                            <td>Tổng tiền</td>
                                                            <td>Trạng thái</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $value)
                                                            @if($value->status == 4)
                                                                @foreach($value->orders as $item)
                                                                    <tr>
                                                                        <td>
                                                                            {{$key+1}}
                                                                        </td>
                                                                        <td>
                                                                            <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                                                                <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                                                                            </a>
                                                
                                                                            <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                                                                            @if(isset($value->color_name) || isset($value->size_name))
                                                                            <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            {{$item->quantity}}
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @php
                                                                                $total = $item->new_price * $item->quantity;
                                                                            @endphp
                                                                            {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @include('admin.components.status',[
                                                                                'dataStatus'=>$value,
                                                                                'listStatus'=>$listStatus,
                                                                            ])
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="cboth"></div>
                                            </div>
                                            <!-- end cart top-->
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab-content content5">
                                    <div class="block-item">
                                        <div class="container">
                                            <div class="cart-top">
                                                <table>
                                                    <thead>
                                                        <tr class="cart-table-header">
                                                            <td>STT</td>
                                                            <td>Tên sản phẩm</td>
                                                            <td>Số lượng</td>
                                                            <td>Tổng tiền</td>
                                                            <td>Trạng thái</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $value)
                                                            @if($value->status == 5)
                                                                @foreach($value->orders as $item)
                                                                    <tr>
                                                                        <td>
                                                                            {{$key+1}}
                                                                        </td>
                                                                        <td>
                                                                            <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                                                                <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                                                                            </a>
                                                
                                                                            <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                                                                            @if(isset($value->color_name) || isset($value->size_name))
                                                                            <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            {{$item->quantity}}
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @php
                                                                                $total = $item->new_price * $item->quantity;
                                                                            @endphp
                                                                            {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                                                                        </td>
                                                                        <td class="cart-title-pro">
                                                                            @include('admin.components.status',[
                                                                                'dataStatus'=>$value,
                                                                                'listStatus'=>$listStatus,
                                                                            ])
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="cboth"></div>
                                            </div>
                                            <!-- end cart top-->
                                        </div>
                                    </div> 
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).on('click', '.nav-item-order', function() {   
        
        //tab
        // var tab_name = $(this).data('tab');
        // // console.log(tab_name);
        // $('.tab-content').removeClass('current');
        // $("." + tab_name).addClass('current');
        
        $('.nav-item-order').removeClass('active-cart-title');
        $(this).addClass('active-cart-title');

        let id_status = $(this).data('id_status');
        let tab_name = $(this).data('tab');
        let urlRequest = window.location;
        urlRequest = urlRequest + '?' + 'status' + '=' + tab_name;

        if (id_status != '') {
            $.ajax({
                url: urlRequest,
                method: "GET",
                data : {id_status : id_status},
                success: function(data) {
                    $('#results').html(data.data);
                }
            })
        }
    });
</script>
@endsection
