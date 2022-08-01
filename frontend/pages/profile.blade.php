@extends('frontend.layouts.main-profile')

@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="main">
            {{-- @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset --}}
            <div class="wrap-content-main">
                <div class="row">
                    <div class="col-md-{{ $openPay?'6':'12' }} col-sm-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-cart-plus"></i></span>
                            <div class="info-box-content">
                               <span class="info-box-text"> Tổng số điểm hiện có</span>
                               <span class="info-box-number"> <strong>{{ $sumPointCurrent  }}</strong> Điểm</span>
                            </div>
                         </div>
                    </div>

                    @isset($sumEachType)
                        @foreach ($sumEachType as $item)
                            <div class="col-md-{{ $openPay?'6':'12' }} col-sm-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-cart-plus"></i></span>
                                    <div class="info-box-content">
                                       <span class="info-box-text"> {{ $typePoint[$item['type']]['name']  }}</span>
                                       <span class="info-box-number"> <strong>{{ $item['total']  }}</strong> Điểm</span>
                                    </div>
                                 </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
            {{-- @if ($openPay)
                <div class="wrap-pay">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            @if(session("alert"))
                                <div class="alert alert-success">
                                    {{session("alert")}}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-warning">
                                    {{session("error")}}
                                </div>
                            @endif

                            <form action="{{route('profile.drawPoint')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-primary">
                                            <div class="card-header1">
                                                <h3 class="card-title">Rút điểm</h3>
                                                <div class="desc">Rút điểm chỉ được mở từ ngày 1- 2 hàng tháng</div>
                                            </div>
                                            <div class="card-body table-responsive p-3">
                                                <div class="form-group">
                                                    <label for="">Số điểm rút</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id=""
                                                        value="{{ old('pay') }}"  name="pay"
                                                        placeholder="Nhập số điểm"
                                                    >
                                                    @error('pay')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" name="checkrobot" id="checkrobot" required>
                                                <label class="form-check-label" for="checkrobot">Tôi đồng ý</label>
                                                </div>
                                                @error('checkrobot')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info">Chấp nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).on('click','.pt_icon_right',function(){
            event.preventDefault();
            $(this).parentsUntil('ul','li').children("ul").slideToggle();
            $(this).parentsUntil('ul','li').toggleClass('active');
        })
    })
</script>
@endsection
