@extends('admin.layouts.main')
@section('title',"Thêm biến thể")

@section('content')
<div class="content-wrapper">
   @include('admin.partials.content-header',['name'=>"biến thể","key"=>"Thêm biến thể"])
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
               <form action="{{route('admin.variant.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf

                <div class="row">
                    <div class="col-md-6">
                        @if ($errors->all())
                        <div class="card-header">
                            @foreach ($errors->all() as $message)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @endforeach
                         </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="card-tool p-3 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                            <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin biến thể</h3>
                            </div>
                            
                        </div>
                    </div> --}}

                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Thông tin biến thể</h3>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 control-label" for="">Tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control
                                            @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Nhập tên">
                                            @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class=" control-label" for="">Chọn danh mục</label>
                                    <select class="form-control custom-select select-2-init @error('parent_id')
                                        is-invalid
                                        @enderror" id="" value="{{ old('parent_id') }}" name="parent_id">

                                        <option value="0">--- Root ---</option>

                                        @if (old('parent_id'))
                                            {!! \App\Models\Attribute::getHtmlOptionAddWithParent(old('parent_id')) !!}
                                        @else
                                        {!!$option!!}
                                        @endif
                                    </select>
                                    @error('parent_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label class="control-label" for="">Số thứ tự</label>
                                    <input type="number" min="0" class="form-control  @error('order') is-invalid  @enderror"  value="{{ old('order') }}" name="order" placeholder="Nhập số thứ tự">
                                    @error('order')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label class="control-label" for="">Trạng thái</label>

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

@endsection
