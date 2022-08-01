@extends('admin.layouts.main')
@section('title',"Thêm Size")
@section('css')
<link href="{{asset('lib/select2/css/select2.min.css')}}" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
    }
    .select2-container .select2-selection--single {
        height: auto;
    }
    .tinymce_editor_init{
        height: 300px !important;
    }
</style>

@endsection
@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name'=>"Size","key"=>"Thêm Size"])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has("alert"))
                    <div class="alert alert-success">
                        {{session()->get("alert")}}
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-warning">
                        {{session("error")}}
                    </div>
                    @endif
                    <form class="form-horizontal" action="{{route('admin.product.size.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header">
                                    @foreach ($errors->all() as $message)
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @endforeach
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-tool p-3 text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                    <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                       <h3 class="card-title">Thông tin Khung</h3>
                                    </div>
                                    <div class="card-body table-responsive p-3">
										<ul class="nav nav-tabs">
                                            <li class="nav-item">
                                              <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng quan</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#du_lieu">Dữ liệu</a>
                                            </li> -->
                                            {{--
                                            <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                            </li>
                                            --}}
                                        </ul>

                                        <div class="tab-content">
                                            <!-- START Tổng Quan -->
                                            <div id="tong_quan" class="container tab-pane active "><br>

                                                <ul class="nav nav-tabs">
                                                    @foreach ($langConfig as $langItem)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$langItem['value']==$langDefault?'active':''}}" data-toggle="tab" href="#tong_quan_{{$langItem['value']}}">{{ $langItem['name'] }}</a>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                                <div class="tab-content">
                                                    @foreach ($langConfig as $langItem)
                                                    <div id="tong_quan_{{$langItem['value']}}" class="container tab-pane {{$langItem['value']==$langDefault?'active show':''}} fade">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Tên size</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('size') is-invalid @enderror" value="{{ old('size') }}" name="size" placeholder="Nhập tên size">
                                                                    @error('size')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror


                                                                    <input type="hidden" class="form-control"
                                                                    value="{{ $product_id }}" name="product_id">

                                                                    <input type="hidden" class="form-control"
                                                                    value="{{ $option_id }}" name="option_id">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Giá</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" name="price" placeholder="Nhập giá">
                                                                    @error('price')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
														<div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Giá cũ</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('old_price') is-invalid @enderror" id="old_price" value="{{ old('old_price') }}" name="old_price" placeholder="Nhập giá cũ">
                                                                    @error('old_price')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Số thứ tự</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" min="0" class="form-control  @error('order') is-invalid  @enderror"  value="{{ old('order') }}" name="order" placeholder="Nhập số thứ tự">
                                                                    @error('order')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if( isset($attributes) && $attributes->count()>0 )
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="control-label col-sm-2" for="">{{ $attributes->name }}</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control"  name="attribute" >
                                                                        <option value="0">-- Chọn thuộc tính --</option>
                                                                        @foreach ($attributes->childs()->orderby('order')->get() as $attr)
                                                                            <option value="{{ $attr->id }}" @if (old('attribute')) {{ $attr->id== old('attribute')?'selected':"" }} @endif>{{ $attr->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('attribute')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Tình trạng</label>
                                                                <div class="col-sm-10">
                                                                    <div class="form-check-inline">
                                                                        <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" value="1" name="stock" @if(old('stock')==='1' ||old('stock')===null) {{'checked'}} @endif>Còn hàng
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" value="0" @if(old('stock')==="0" ){{'checked'}} @endif name="stock">Hết hàng
                                                                        </label>
                                                                    </div>
                                                                    @error('stock')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Mặc định</label>
                                                                <div class="col-sm-10">
                                                                    <input type="checkbox" class=" @error('is_default')
                                                                            is-invalid
                                                                            @enderror" value="1" name="is_default" @if(old('is_default')==="1" ) {{'checked'}} @endif>
                                                                </div>
                                                                @error('is_default')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Trạng thái</label>
                                                                <div class="col-sm-10">
                                                                    <div class="form-check-inline">
                                                                        <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" value="1" name="active" @if(old('active')==='1' ||old('active')===null) {{'checked'}} @endif>Hiện
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" value="0" @if(old('active')==="0" ){{'checked'}} @endif name="active">Ẩn
                                                                        </label>
                                                                    </div>
                                                                    @error('active')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <!-- END Tổng Quan -->

                                            <!-- START Dữ Liệu -->
                                            <!-- <div id="du_lieu" class="container tab-pane fade"><br>
                                            </div> -->
                                            <!-- END Dữ Liệu -->
                                            {{--
                                            <!-- START Hình Ảnh -->
                                            <div id="hinh_anh" class="container tab-pane fade"><br>
                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đại diện</label>
                                                        <input type="file" class="form-control-file img-load-input border @error('avatar_type')
                                                        is-invalid
                                                        @enderror" id="" name="avatar_type">
                                                        @error('avatar_type')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <img class="img-load border p-1 w-100" src="{{asset('admin_asset/images/upload-image.png')}}" style="height: 200px;object-fit:cover; max-width: 260px;">
                                                </div>

                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Ảnh liên quan</label>
                                                        <input type="file" class="form-control-file img-load-input-multiple border @error('image')
                                                            is-invalid
                                                            @enderror" id="" name="image[]" multiple>
                                                    </div>
                                                    @error('image')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    <div class="load-multiple-img">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}">
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            --}}
                                            <!-- END Hình Ảnh -->

                                        </div>
                                    </div>
                                </div>
                            </div>
           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')




@endsection
