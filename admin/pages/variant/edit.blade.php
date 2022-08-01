@extends('admin.layouts.main')
@section('title',"Sửa biến thể")

@section('content')

  <div class="content-wrapper">
    @include('admin.partials.content-header',['name'=>"Biến thể","key"=>"Sửa biến thể"])
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
                <form action="{{route('admin.variant.update',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
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
                                   <h3 class="card-title">Thông tin biến thể</h3>
                                </div>
                                <div class="card-body table-responsive p-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 control-label" for="">Tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control nameChangeSlug
                                                @error('name') is-invalid @enderror" id="name" value="{{ old('name')?? $data->name }}" name="name" placeholder="Nhập tên">
                                                @error('name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
