@extends('admin.layouts.main')
@section('title',"Sửa Mã giảm giá")

@section('css')
@endsection
@section('content')
<div class="content-wrapper lb_template_product_edit">
    @include('admin.partials.content-header',['name'=>"Mã giảm giá","key"=>"Sửa Mã giảm giá"])

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

                    <div class="box-link">
                
                        <a href="{{ route('admin.product.coupon',['product_id'=>$data->id]) }}" class="btn btn-sm btn-success">Danh sách Mã giảm giá</a>
         
                    </div>

                    <form class="form-horizontal" action="{{route('admin.product.coupon.update',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
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
                                       <h3 class="card-title">Thông tin Mã giảm giá</h3>
                                    </div>
                                    <div class="card-body table-responsive p-3">
										<ul class="nav nav-tabs">
                                            <li class="nav-item">
                                              <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng quan</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#du_lieu">Dữ liệu</a>
                                            </li> -->
                                            {{-- <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                            </li> --}}
                                        </ul>

                                        <div class="tab-content">
                                            <!-- START Tổng Quan -->
                                            <div id="tong_quan" class="container tab-pane active"><br>

                                                <ul class="nav nav-tabs">
                                                    @foreach ($langConfig as $langItem)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$langItem['value']==$langDefault?'active':''}}" data-toggle="tab" href="#tong_quan_{{$langItem['value']}}">{{ $langItem['name'] }}</a>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                                <div class="tab-content">
                                                    @foreach ($langConfig as $langItem)
                                                    <div id="tong_quan_{{$langItem['value']}}" class="container wrapChangeSlug tab-pane {{$langItem['value']==$langDefault?'active show':''}} fade">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Tên mã giảm giã</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('name') is-invalid @enderror" id="name" value="{{ old('name')??$data->name }}" name="name" placeholder="Nhập tên mã giảm giá">
                                                                    @error('name')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                    <input type="hidden" class="form-control"
                                                                    value="{{ $data->product_id }}" name="product_id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập code</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('code') is-invalid  @enderror" value="{{ old('code')??$data->code }}" name="code" placeholder="Nhập mã code">
                                                                    @error('code')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Tính năng mã</label>
                                                                <div class="col-sm-10">
                                                                    <select name="feature" class="form-control 
                                                                    @error('feature') is-invalid @enderror">
                                                                        <option value="">-- Chọn tính năng --</option>

                                                                        <option value="1" {{$data->feature == 1 ? 'selected' : ''}}> Giảm theo phần trăm </option>

                                                                        <option value="2" {{$data->feature == 2 ? 'selected' : ''}}> Giảm theo tiền </option>
                                                                    </select>
                                                                    @error('feature')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Số lượng</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('quantity') is-invalid  @enderror" value="{{ old('quantity')??$data->quantity }}" name="quantity" placeholder="Nhập số lượng">
                                                                    @error('quantity')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập số phần trăm hoặc tiền giảm</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control 
                                                                    @error('coupon_number') is-invalid  @enderror" value="{{ old('coupon_number')??$data->coupon_number }}" name="coupon_number" placeholder="Nhập số phần trăm hoặc tiền giảm">
                                                                    @error('coupon_number')
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

                                            <!-- START Hình Ảnh -->
                                            {{-- <div id="hinh_anh" class="container tab-pane fade"><br>

                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đại diện</label>
                                                        <input type="file" class="form-control-file img-load-input border" id="" name="avatar_type">
                                                    </div>
                                                    @error('avatar_type')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    @if ($data->avatar_type)
                                                    <img class="img-load border p-1 w-100" src="{{$data->avatar_type}}" alt="{{$data->size}}" style="height: 200px;object-fit:cover; max-width: 260px;">
                                                    @endif
                                                </div>

                                                <hr>


                                                <div class="wrap-load-image mb-3">
                                                    <label class="mb-3 w-100">Hình ảnh khác</label>

                                                    <span class="badge badge-success">Đã thêm</span>
                                                    <div class="list-image d-flex flex-wrap">
                                                        @foreach($data->images()->get() as $productImageItem)
                                                             <div class="col-image" style="width:20%;" >
                                                                <img class="" src="{{$productImageItem->image_path}}" alt="{{$productImageItem->name}}">
                                                                <a class="btn btn-sm btn-danger lb_delete_image"  data-url="{{ route('admin.product.option.destroy-image',['id'=>$productImageItem->id]) }}"><i class="far fa-trash-alt"></i></a>
                                                             </div>
                                                         @endforeach
                                                         @if (!$data->images()->get()->count())
                                                            Chưa thêm hình ảnh nào
                                                         @endif
                                                    </div>
                                                    <hr>
                                                    <span class="badge badge-primary mb-3">Thêm ảnh</span>
                                                    <div class="form-group">
                                                        <input type="file" class="form-control-file img-load-input-multiple border" id="" name="image[]" multiple>
                                                    </div>
                                                    @error('image')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    <div class="load-multiple-img">
                                                        @if (!$data->images()->get()->count())
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        <img class="" src="{{asset('admin_asset/images/upload-image.png')}}" alt="'no image">
                                                        @endif
                                                    </div>
                                                </div>


                                            </div> --}}
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
