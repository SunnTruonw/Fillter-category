@extends('admin.layouts.main')
@section('title',"Danh sách Size")
@section('css')

@endsection
@section('control')
<a href="{{route('admin.product.create')}}" class="btn btn-info btn-md mb-2">+ Thêm mới</a>
@endsection
@section('content')
<div class="content-wrapper lb_template_list_product">

    @include('admin.partials.content-header',['name'=>"tab","key"=>"Danh sách Size"])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(session("alert"))
                <div class="alert alert-success">
                    {{session("alert")}}
                </div>
                @elseif(session('error'))
                <div class="alert alert-warning">
                    {{session("error")}}
                </div>
                @endif
                <div class="d-flex justify-content-between ">
                    
                    <a href="{{route('admin.product.size.create',['product_id' => $product_id, 'option_id' => $option_id])}}" class="btn btn-info btn-md mb-2">+ Thêm mới</a>
                    
                    
                    <a href="{{route('admin.product.option',['product_id'=>$product_id])}}" class="btn ml-2 btn-info btn-md mb-2">Danh sách màu</a>
                    <a href="{{route('admin.product.edit',['id'=>$product_id])}}" class="btn ml-2 btn-info btn-md mb-2">Sửa thông tin sản phẩm</a>
                    
                </div>



                <div class="card card-outline card-primary">
                    <div class="card-body table-responsive p-0 lb-list-category">
                        <table class="table table-head-fixed" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Khung</th>
                                    <th>Giá</th>
                                    <th>Giá cũ</th>
                                    <th>Sản phẩm</th>
                                    <th>Màu gỗ</th>
                                    <th>Thứ tự</th>
                                    <th>Trạng thái</th>
                                    <th>Mặc định</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $tabItem)
           
                                <tr>
                                    <td>{{$loop->index}}</td>
                                    <td>{{$tabItem->size}}</td>
                                    <td>{{ number_format($tabItem->price) }}</td>
                                    <td>{{ number_format($tabItem->old_price) }}</td>
                                    <td>{{$tabItem->products->name}}</td>
                                    <td>{{$tabItem->options->size}}</td>
                                    <td>
                                        <input data-url="{{ route('admin.loadOrderVeryModel',['table'=>'sizes','id'=>$tabItem->id]) }}" class="lb-order text-center"  type="number" min="0" value="{{ $tabItem->order?$tabItem->order:0 }}" style="width:50px" />
                                    </td>
                                    <td class="wrap-load-active" data-url="{{ route('admin.product.load.active.size',['id'=>$tabItem->id]) }}">
                                        @include('admin.components.load-change-active',['data'=>$tabItem,'type'=>'size'])
                                    </td>
                                    <td class="wrap-load-default" data-url="{{ route('admin.product.load.default.size',['id'=>$tabItem->id]) }}">
                                        @include('admin.components.load-change-default',['data'=>$tabItem,'type'=>'size'])
                                    </td>
                                    <td>
                                        <a href="{{route('admin.product.size.edit',['id'=>$tabItem->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a data-url="{{route('admin.product.destroySize',['id'=>$tabItem->id])}}" class="btn btn-sm btn-danger lb_delete"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
        </div>
      </div>
    </div>
</div>

@endsection

@section('js')

@endsection
