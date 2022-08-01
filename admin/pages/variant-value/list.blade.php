@extends('admin.layouts.main')
@section('title',"Danh sach biến thể")

@section('css')

@endsection
@section('content')
<div class="content-wrapper">

    @include('admin.partials.content-header',['name'=>"Biến thể","key"=>"Danh sách biến thể"])

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
                <div class="text-right">
                    <a href="{{route('admin.variant-value.create',['parent_id'=>request()->parent_id??0])}}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                </div>
                <div class="card card-outline card-info">
                    <div class="card-header pt-2 pb-2">
                        <div class="cart-title">
                            <i class="fas fa-list"></i> Biến thể
                        </div>
                    </div>
                </div>

                @if (isset($parentBr)&&$parentBr)
                <ol class="breadcrumb">
                  <li><a href="{{ route('admin.variant-value.index',['parent_id'=>0]) }}">Root</a></li>

                  @foreach ($parentBr->breadcrumb as $item)
                   <li><a href="{{ route('admin.variant-value.index',['parent_id'=>$item['id']]) }}">{{ $item['name'] }}</a></li>
                  @endforeach

                  <li><a href="{{ route('admin.variant-value.index',['parent_id'=>$parentBr->id]) }}">{{ $parentBr->name }}</a></li>
                </ol>
                @endif
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Giá trị biến thể</th>
                                        <th>Biến thể</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                @foreach($data as $value)
                                    <tr class="lb_item_delete">
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->value}}</td>
                                        <td>
                                            @if($value->variant)
                                                <span class="badge badge-primary">
                                                {{$value->variant->name}}
                                                   </span>
        
                                            @endif
                                        </td>
                                        <td class="lb_list_action_recusive">
                                            <a href="{{route('admin.variant-value.edit',['id'=>$value->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="{{route('admin.variant-value.create',['parent_id'=>$value->id])}}" class="btn btn-sm btn-info">+ Thêm</a> --}}
                                            <a data-url="{{route('admin.variant-value.destroy',['id'=>$value->id])}}" class="btn btn-sm btn-danger lb_delete_recusive"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
            <div class="col-md-12">
                {{$data->links()}}
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('js')
@endsection
