@extends('admin.layouts.main')
@section('title',"Sửa sản phẩm")

@section('css')
@endsection
@section('content')
<style>
	.card-body .form-group {
		margin-bottom: 5px;
	}
</style>
<div class="content-wrapper lb_template_product_edit">
    @include('admin.partials.content-header',['name'=>"Sản phẩm","key"=>"Sửa sản phẩm"])

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
                        {{--
                        <a href="{{ route('admin.product.tab',['product_id'=>$data->id]) }}" class="btn btn-sm btn-success">Danh sách tab</a>

                        <a href="{{ route('admin.product.parameter',['product_id'=>$data->id]) }}" class="btn btn-sm btn-success">Danh sách thông số</a>
                        --}}
                        <a href="{{ route('admin.product.option',['product_id'=>$data->id]) }}" class="btn btn-sm btn-success">Danh sách Màu Gỗ</a>
                        <a href="{{ route('admin.product.coupon',['product_id'=>$data->id]) }}" class="btn btn-sm btn-success">Danh sách Mã giảm giá</a>
                    </div>
                    <form class="form-horizontal" action="{{route('admin.product.update',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-8">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                       <h3 class="card-title">Thông tin sản phẩm</h3>
                                    </div>
                                    <div class="card-body table-responsive p-3">
										<ul class="nav nav-tabs">
                                            <li class="nav-item">
                                              <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng quan</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#du_lieu">Dữ liệu</a>
                                            </li> -->
                                            <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình ảnh</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" data-toggle="tab" href="#seo">Seo</a>
                                            </li>
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
                                                                <label class="col-sm-2 control-label" for="">Tên sản phẩm</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control nameChangeSlug
                                                                    @error('name_'.$langItem['value']) is-invalid @enderror" id="name_{{$langItem['value']}}" value="{{ old('name_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->name }}" name="name_{{$langItem['value']}}" placeholder="Nhập tên sản phẩm">
                                                                    @error('name_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Slug</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control resultSlug
                                                                    @error('slug_'.$langItem['value']) is-invalid  @enderror" id="slug_{{ $langItem['value'] }}" value="{{ old('slug_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->slug }}" name="slug_{{ $langItem['value'] }}" placeholder="Nhập slug">
                                                                    @error('slug_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Thương hiệu</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control
                                                                    @error('model_'.$langItem['value']) is-invalid @enderror" id="model_{{$langItem['value']}}" value="{{ old('model_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->model }}" name="model_{{$langItem['value']}}" placeholder="Nhập Thương hiệu">
                                                                    @error('model_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Trạng thái</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control
                                                                    @error('tinhtrang_'.$langItem['value']) is-invalid @enderror" id="tinhtrang_{{$langItem['value']}}" value="{{ old('tinhtrang_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->tinhtrang }}" name="tinhtrang_{{$langItem['value']}}" placeholder="Nhập Trạng thái">
                                                                    @error('tinhtrang_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Khuyến mại đặc biệt</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control
                                                                    @error('baohanh_'.$langItem['value']) is-invalid @enderror" id="baohanh_{{$langItem['value']}}" value="{{ old('baohanh_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->baohanh }}" name="baohanh_{{$langItem['value']}}" placeholder="Khuyến mại đặc biệt">
                                                                    @error('baohanh_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        
                                                        {{--
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Phụ kiện tặng kèm</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control
                                                                    @error('xuatsu_'.$langItem['value']) is-invalid @enderror" id="xuatsu_{{$langItem['value']}}" value="{{ old('xuatsu_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->xuatsu }}" name="xuatsu_{{$langItem['value']}}" placeholder="Nhập phụ kiện tặng kèm">
                                                                    @error('xuatsu_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        --}}


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập giới thiệu</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('description_'.$langItem['value']) is-invalid @enderror" name="description_{{$langItem['value']}}" id="" rows="3"  placeholder="Nhập giới thiệu">{{ old('description_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->description  }}</textarea>
                                                                    @error('description_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập giới thiệu phải</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('content4_'.$langItem['value']) is-invalid @enderror" name="content4_{{$langItem['value']}}" id="" rows="3"  placeholder="Nhập giới thiệu phải">{{ old('content4_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->content4  }}</textarea>
                                                                    @error('content4_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Khuyến mại sản phẩm</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('content3_'.$langItem['value']) is-invalid  @enderror" name="content3_{{$langItem['value']}}" id="" rows="3" value="" placeholder="Nhập khuyến mại sản phẩm">
                                                                    {{ old('content3_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->content3 }}
                                                                    </textarea>
                                                                    @error('content3_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập mô tả sản phẩm</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('content_'.$langItem['value']) is-invalid  @enderror" name="content_{{$langItem['value']}}" id="" rows="20" value="" placeholder="Nhập mô tả sản phẩm">
                                                                    {{ old('content_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->content }}
                                                                    </textarea>
                                                                    @error('content_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                       {{-- <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập chính sách bảo hành</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('content2_'.$langItem['value']) is-invalid  @enderror" name="content2_{{$langItem['value']}}" id="" rows="20" value="" placeholder="Nhập chính sách bảo hành">
                                                                    {{ old('content2_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->content2 }}
                                                                    </textarea>
                                                                    @error('content2_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        
                                                        
                                                        {{--
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="">Nhập chính sách bảo hành</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control tinymce_editor_init @error('content4_'.$langItem['value']) is-invalid  @enderror" name="content4_{{$langItem['value']}}" id="" rows="20" value="" placeholder="Nhập chính sách bảo hành">
                                                                    {{ old('content4_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->content4 }}
                                                                    </textarea>
                                                                    @error('content4_'.$langItem['value'])
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="form-group form-check">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label">

                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <input type="checkbox" class="form-check-input" name="checkrobot" id="">
                                                                    <label class="form-check-label" for="" required>Tôi đồng ý</label>
                                                                </div>
                                                            </div>
                                                            @error('checkrobot')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div> --}}
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
                                            <div id="hinh_anh" class="container tab-pane fade"><br>

                                                <div class="wrap-load-image mb-3">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đại diện</label>
                                                        <input type="file" class="form-control-file img-load-input border" id="" name="avatar_path">
                                                    </div>
                                                    @error('avatar_path')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                    @if ($data->avatar_path)
                                                    <img class="img-load border p-1 w-100" src="{{$data->avatar_path}}" alt="{{$data->name}}" style="height: 200px;object-fit:cover; max-width: 260px;">
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
                                                                <a class="btn btn-sm btn-danger lb_delete_image"  data-url="{{ route('admin.product.destroy-image',['id'=>$productImageItem->id]) }}"><i class="far fa-trash-alt"></i></a>
                                                             </div>
                                                         @endforeach
                                                         @if (!$data->images()->get()->count())
                                                            Chưa thêm hình ảnh nào
                                                         @endif
                                                    </div>
                                                    <hr>
                                                    <span class="badge badge-primary mb-3">Thêm ảnh</span>
                                                    <div class="form-group">
                                                        {{-- <label for="">Thêm ảnh</label> --}}
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


                                            </div>
                                            <!-- END Hình Ảnh -->

                                            <!-- START Seo -->
                                            <div id="seo" class="container tab-pane fade"><br>
                                                <ul class="nav nav-tabs">
                                                    @foreach ($langConfig as $langItem)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$langItem['value']==$langDefault?'active':''}}" data-toggle="tab" href="#seo_{{$langItem['value']}}">{{ $langItem['name'] }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content">
                                                    @foreach ($langConfig as $langItem)
                                                        <div id="seo_{{$langItem['value']}}" class="container tab-pane {{$langItem['value']==$langDefault?'active show':''}} fade">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-2 control-label" for="">Nhập title seo</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control @error('title_seo_'.$langItem['value']) is-invalid @enderror" id="" value="{{ old('title_seo_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->title_seo }}" name="title_seo_{{ $langItem['value'] }}" placeholder="Nhập title seo">
                                                                        @error('title_seo_'.$langItem['value'])
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-2 control-label" for="">Nhập mô tả seo</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control @error('description_seo_'.$langItem['value']) is-invalid @enderror" id="" value="{{ old('description_seo_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->description_seo }}" name="description_seo_{{ $langItem['value'] }}" placeholder="Nhập mô tả seo">
                                                                        @error('description_seo_'.$langItem['value'])
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-2 control-label" for="">Nhập từ khóa seo</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control @error('keyword_seo_'.$langItem['value']) is-invalid @enderror" id="" value="{{ old('keyword_seo_'.$langItem['value'])??optional($data->translationsLanguage($langItem['value'])->first())->keyword_seo  }}" name="keyword_seo_{{ $langItem['value'] }}" placeholder="Nhập mô tả seo">
                                                                        @error('keyword_seo_'.$langItem['value'])
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-2 control-label" for="">Nhập tags</label>
                                                                    <div class="col-sm-10">
                                                                        {{-- {{ dd(old('tags_'.$langItem['value'])) }} --}}
                                                                        <select class="form-control tag-select-choose w-100" multiple="multiple" name="tags_{{$langItem['value']}}[]">
                                                                            @if (old('tags_'.$langItem['value']))
                                                                                @foreach (old('tags_'.$langItem['value']) as $tag)
                                                                                    <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                                                                @endforeach
                                                                            @else
                                                                            @foreach($data->tagsLanguage($langItem['value'])->get() as $tagItem)
                                                                             <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        @error('title_seo')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>


                                            </div>
                                            <!-- END Seo -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin khác</h3>
                                     </div>
                                     <div class="card-body table-responsive p-3">
                                        <div class="form-group">
                                            <label class="control-label" for="">Nhập mã sản phẩm</label>
                                            <input type="text" min="0" class="form-control  @error('masp') is-invalid  @enderror"  value="{{ old('masp')??$data->masp }}" name="masp" placeholder="Nhập mã sản phẩm">
                                            @error('masp')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label" for="">Nhập màu</label>
                                            <input type="text"   class="form-control  @error('file3') is-invalid  @enderror"  value="{{ old('file3')??$data->file3 }}" name="file3" placeholder="Nhập mầu">
                                            @error('file3')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label class=" control-label" for="">Chọn danh mục</label>
                                            <select class="form-control custom-select select-2-init @error('category_id')
                                                is-invalid
                                                @enderror" id="" value="{{ old('category_id') }}" name="category_id">

                                                <option value="0">--- Chọn danh mục cha ---</option>

                                                @if (old('category_id')||old('category_id')==='0')
                                                    {!! \App\Models\CategoryProduct::getHtmlOption(old('category_id')) !!}
                                                @else
                                                {!!$option!!}
                                                @endif
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class=" control-label" for="">Chọn bộ sưu tập</label>
                                            <select class="form-control custom-select select-2-init @error('bo_suu_tap')
                                                is-invalid
                                                @enderror" id="" value="{{ old('bo_suu_tap') }}" name="bo_suu_tap">

                                                <option value="0">--- Chọn bộ sưu tập ---</option>

                                                @if (old('bo_suu_tap')||old('bo_suu_tap')==='0')
                                                    {!! \App\Models\CategoryProduct::getHtmlOptionBoSuuTap(old('bo_suu_tap')) !!}
                                                @else
                                                {!!$optionBTS!!}
                                                @endif
                                            </select>
                                            @error('bo_suu_tap')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                         {{-- <div class="form-group">
                                            <label class="control-label" for="">Chọn nhà cung cấp</label>
                                            <select class="form-control @error('supplier')
                                                is-invalid
                                                @enderror" id="" value="{{ old('supplier_id') }}" name="supplier_id">

                                                <option value="0">--- Chọn nhà cung cấp ---</option>
                                                @foreach ($supplier as $item)
                                                <option value="{{ $item->id }}" {{ (old('supplier')??$data->supplier_id)==  $item->id ?"selected":""}}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="control-label" for="">Số thứ tự</label>
                                            <input type="number" min="0" class="form-control  @error('order') is-invalid  @enderror"  value="{{ old('order')??$data->order }}" name="order" placeholder="Nhập số thứ tự">
                                            @error('order')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>


                                       {{-- <div class="form-group">
                                            <label class=" control-label" for="">Sale(%)</label>
                                            <input type="number" min="0" class="form-control  @error('sale') is-invalid  @enderror"  value="{{ old('sale')??$data->sale }}" name="sale" placeholder="Nhập sale">

                                            @error('sale')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>--}}

                                        <div class="form-group">
                                            <label class="control-label" for="">Sản phẩm bán chạy</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input @error('sp_ngoc') is-invalid
                                                        @enderror" value="1" name="hot" @if(old('hot')==="1"||$data->hot==1 ) {{'checked'}} @endif>
                                                </label>
                                            </div>
                                            @error('hot')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="">Giá tốt mỗi tuần</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input @error('sp_km') is-invalid
                                                        @enderror" value="1" name="sp_km" @if(old('sp_km')==="1"||$data->sp_km==1 ) {{'checked'}} @endif>
                                                </label>
                                            </div>
                                            @error('sp_km')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{--
                                        <div class="form-group">
                                            <label class="control-label" for="">Sản phẩm yêu thích</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input @error('sp_ngoc') is-invalid
                                                        @enderror" value="1" name="sp_ngoc" @if(old('sp_ngoc')==="1"||$data->sp_ngoc==1 ) {{'checked'}} @endif>
                                                </label>
                                            </div>
                                            @error('sp_ngoc')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="">Bộ sưu tập</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input @error('bo_suu_tap') is-invalid
                                                        @enderror" value="1" name="bo_suu_tap" @if(old('bo_suu_tap')==="1"||$data->bo_suu_tap==1 ) {{'checked'}} @endif>
                                                </label>
                                            </div>
                                            @error('bo_suu_tap')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label" for="">Sản phẩm Ngọc</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input @error('sp_ngoc') is-invalid
                                                        @enderror" value="1" name="sp_ngoc" @if(old('sp_ngoc')==="1"||$data->sp_ngoc==1 ) {{'checked'}} @endif>
                                                </label>
                                            </div>
                                            @error('sp_ngoc')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        --}}
                                        <div class="form-group">
                                            <label class="control-label" for="">Trạng thái</label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="1" name="active" @if(old('active')==='1' || $data->active==1) {{'checked'}} @endif>Hiện
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="0" @if(old('active')==="0" || $data->active==0){{'checked'}} @endif name="active">Ẩn
                                                </label>
                                            </div>
                                            @error('active')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <hr>
                                       {{-- <div class="alert alert-light  mt-3 mb-1">
                                            <strong>Chọn thuộc tính</strong>
                                          </div>

                                         @foreach ($attributes as $key=> $attribute)

                                            <div class="form-group">
                                                <label class="control-label" for="">{{ $attribute->name }}</label>
                                                <select class="form-control"  name="attribute[]" >
                                                    <option value="0">--Chọn--</option>
                                                    @foreach ($attribute->childs()->orderby('order')->get() as $k=> $attr)
                                                        <option value="{{ $attr->id }}"
                                                            @if (old('attribute'))
                                                                @if ($attr->id==old('attribute')[$key])
                                                                    selected
                                                                @else
                                                                    {{ $data->attributes()->get()->pluck('id')->contains($attr->id)?'selected':"" }}
                                                                @endif
                                                            @else
                                                            {{ $data->attributes()->get()->pluck('id')->contains($attr->id)?'selected':"" }}
                                                            @endif
                                                        >
                                                            {{ $attr->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('attribute.'.$key)
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                         @endforeach
                                            <hr>
                                        
                                        <div class="alert alert-light mt-3 mb-1">
                                            <strong>Upload file</strong>
                                          </div>

                                        <div class="form-group">
                                            <label for="">Brochure</label>
                                          <div>
                                            <a href="{{ $data->file }}" download>{{ $data->file }}</a>
                                          </div>
                                            <input type="file" class="form-control-file img-load-input border @error('file')
                                            is-invalid
                                            @enderror" id="" name="file">
                                            @error('file')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Hướng dẫn sử dụng</label>
                                            <div>
                                                <a href="{{ $data->file2 }}" download>{{ $data->file2 }}</a>
                                            </div>
                                            <input type="file" class="form-control-file img-load-input border @error('file2')
                                            is-invalid
                                            @enderror" id="" name="file2">
                                            @error('file2')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Drive</label>
                                            <div>
                                                <a href="{{ $data->file3 }}" download>{{ $data->file3 }}</a>
                                            </div>
                                            <input type="file" class="form-control-file img-load-input border @error('file3')
                                            is-invalid
                                            @enderror" id="" name="file3">
                                            @error('file3')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        --}}
                                     </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Nhập giá sản phẩm</h3>
                                    </div>
                                     <div class="card-body table-responsive p-3">
                                            <div class="item-price-default">
                                                <div class="form-group">
                                                    <label class="control-label" for="">Giá</label>
                                                    <input type="number" min="0" class="form-control  @error('price') is-invalid  @enderror"  value="{{ old('price')??$data->price }}" name="price" placeholder="Nhập giá">
                                                    @error('price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="">Giá cũ</label>
                                                    <input type="number" min="0" class="form-control  @error('old_price') is-invalid  @enderror"  value="{{ old('old_price')??$data->old_price }}" name="old_price" placeholder="Nhập giá cũ">
                                                    @error('old_price')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                {{-- <div class="form-group">
                                                    <label class="control-label" for="">Số kg</label>
                                                    <input type="text" min="0" class="form-control  @error('size') is-invalid  @enderror"  value="{{ old('size')??$data->size }}" name="size" placeholder="Nhập số kg">
                                                    @error('size')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}
                                            </div>
                                            
                                            {{-- <div class="list-item-option wrap-option mt-3">
                                                <h5>Các loại sản phẩm</h5>
                                                @foreach ($data->options()->latest()->get() as $key=>$item)
                                                <div class="item-price">
                                                    <div class="box-content-price">
                                                        <div class="form-group">
                                                            <label class="control-label" for="">Nhập số kg</label>
                                                            <input type="text" min="0" class="form-control  @error('sizeOptionOld.'.$key) is-invalid  @enderror" value="{{  old('sizeOptionOld')[$key]??$item->size }}" name="sizeOptionOld[]" placeholder="Nhập số kg">
                                                            @error('sizeOptionOld.'.$key)
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label" for="">Giá</label>
                                                            <input type="hidden" name="idOption[]" value="{{ $item->id }}">
                                                            <input type="number" min="0" class="form-control  @error('priceOptionOld.'.$key) is-invalid  @enderror"  value="{{ old('priceOptionOld')[$key]??$item->price }}" name="priceOptionOld[]" placeholder="Nhập giá">
                                                            @error('priceOptionOld.'.$key)
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="">Giá cũ</label>
                                                            <input type="number" min="0" class="form-control  @error('old_priceOptionOld.'.$key) is-invalid  @enderror"  value="{{ old('old_priceOptionOld')[$key]??$item->old_price }}" name="old_priceOptionOld[]" placeholder="Nhập giá cũ">
                                                            @error('old_priceOptionOld.'.$key)
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                        <a  class="btn btn-sm btn-danger deleteOptionProductDB" data-url="{{ route('admin.product.destroyOptionProduct',['id'=>$item->id]) }}"><i class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div> --}}
                                            
                                            {{-- <div class="">Thêm loại mới  <a data-url="{{ route('admin.product.loadOptionProduct') }}" class="btn  btn-info btn-md float-right " id="addOptionProduct">+ Thêm loại</a></div>
                                            <div class="list-item-option wrap-option mt-3" id="wrapOption">
                                                @if (old('priceOption')&&old('priceOption'))
                                                    @foreach (old('priceOption') as $key=>$value)
                                                    <div class="item-price">
                                                        <div class="box-content-price">

                                                            <div class="form-group">
                                                                <label class="control-label" for="">Nhập số kg</label>
                                                                <input type="text" min="0" class="form-control  @error('sizeOption.'.$key) is-invalid  @enderror"  value="{{ old('sizeOption')[$key] }}" name="sizeOption[]" placeholder="Nhập số kg">
                                                                @error('sizeOption.'.$key)
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label" for="">Giá</label>
                                                                <input type="number" min="0" class="form-control  @error('priceOption.'.$key) is-invalid  @enderror"  value="{{ $value }}" name="priceOption[]" placeholder="Nhập giá">
                                                                @error('priceOption.'.$key)
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label" for="">Giá cũ</label>
                                                                <input type="number" min="0" class="form-control  @error('old_priceOption.'.$key) is-invalid  @enderror"  value="{{ $value }}" name="old_priceOption[]" placeholder="Nhập giá cũ">
                                                                @error('old_priceOption.'.$key)
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="action">
                                                            <a  class="btn btn-sm btn-danger deleteOptionProduct"><i class="far fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div> --}}
                                            
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
<script>
    // đoạn văn
    $(document).on('click', '.addOptionProductSize', function() {
        // alert('a');
        let id = $(this).data('id');
        event.preventDefault();
        //  let wrapActive = $(this).parents('.wrap-load-active');
        let urlRequest = $(this).data("url");
        //let i = $('.wrap-paragraph tbody').find('tr').length;
        //  alert(urlRequest);
        $.ajax({
            type: "GET",
            url: urlRequest,
            // data: { i: i },
            success: function(data) {
                if (data.code == 200) {
                    let html = data.html;
                    $('#wrapOptionSize'+ id).append(html);
                    // if ($("textarea.tinymce_editor_init").length) {
                    //     tinymce.init(editor_config);
                    // }
                }
            }
        });
    });
    $(document).on('click', '.deleteOptionProductSize', function() {
        event.preventDefault();
        let $this = $(this);
        Swal.fire({
            title: "Bạn có muốn xóa option?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tôi đồng ý'
        }).then((result) => {
            if (result.isConfirmed) {
                $this.parents('.item-price').remove();
            }
        })
    });
     // load delete đáp án  khi đáp án chưa thêm database
     $(document).on('click', '.deleteOptionProductDB', function() {
        event.preventDefault();
        let urlRequest = $(this).data("url");
        let mythis = $(this);
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa option này',
            text: "Bạn sẽ không thể khôi phục điều này",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tôi đồng ý!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function(data) {
                        if (data.code == 200) {
                            mythis.parents(".item-price").remove();
                        }
                    },
                    error: function() {

                    }
                });
                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // )
            }
        })
    });
</script>
@endsection
