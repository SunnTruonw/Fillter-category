@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')

    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset
            <div class="wrap-content-main wrap-template-product template-detail">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-right">
                            <div class="wrapper-content-account">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="account-sidebars">
                                            <div class="avatar_account">
                                                <div class="clientlogin-group">
                                                    <p class="clientlogin-name">{{\Auth::check() ? \Auth::user()->name  : ''}}</p>
                                                </div>
                                            </div>
                                            <div class="account-sidebar">
                                                <div class="account-sidebar-items">
                                                    <a href="{{route('home.my-account')}}" class="account-sidebar-item {{Request::segment(1) == 'my-account' ? 'active' : '' }}">
                                                        Thông tin cá nhân
                                                    </a>
                                                    <a href="{{route('home.my-order')}}" class="account-sidebar-item {{Request::segment(1) == 'my-order' ? 'active' : '' }}">
                                                        Danh sách đơn hàng
                                                    </a>
                                                    <a href="{{route('home.changePassword')}}" class="account-sidebar-item {{Request::segment(1) == 'change-password' ? 'active' : '' }}">
                                                        Đổi mật khẩu
                                                    </a>
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="account-sidebar-item">
                                                        Thoát
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                            
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                                        <div class="content-account" id="results">
                                            <div class="clientlogin-name">
                                                Thông tin tài khoản
                                            </div>
                                            
                                            <div class="clientlogin-content">
                                                <form action="" class="form-change-info" method="GET" id="form-change-info">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Họ tên</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('name') is-invalid @enderror" id="name" value="{{ Auth::user()->name ?? '' }}" name="name" placeholder="Họ tên của bạn">
                                                                @error('name')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('email') is-invalid @enderror" id="email" value="{{ \Auth::user()->email ?? '' }}" name="email" placeholder="Email của bạn" disabled="disabled">
                                                                @error('name')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Số điện thoại</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('phone') is-invalid @enderror" id="phone" value="{{ \Auth::user()->phone ?? '' }}" name="phone" placeholder="SĐT của bạn">
                                                                @error('phone')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-err" id="errorPhone" style="display: none;">
                                                                    <div class="alert alert-danger-cus alert-des ">
                                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                                        <span class="text-phone-error-comment">Số điện thoại không hợp lệ</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Tên tài khoản</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('username') is-invalid @enderror" id="username" value="{{ \Auth::user()->username ?? '' }}" name="username" placeholder="Tên tài khoản">
                                                                @error('username')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Mật khẩu</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('password') is-invalid @enderror" id="password" value="" name="password" placeholder="Mật khẩu của bạn">
                                                                @error('password')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div> --}}
    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Tỉnh/Thành</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <select name="city_id" id="city" class="form-control @error('city_id') is-invalid   @enderror"  data-url="{{ route('ajax.address.districts') }}"">
                                                                            <option value="">Chọn tỉnh/Thành phố</option>

                                                                            {!! $cities !!}
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="district_id" id="district" class="form-control    @error('district_id') is-invalid   @enderror"  data-url="{{ route('ajax.address.communes') }}">
                                                                            <option value="">Chọn quận/huyện</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="commune_id" id="commune" class="form-control   @error('commune_id')is-invalid   @enderror">
                                                                            <option value="">Chọn xã/phường/thị trấn</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Địa chỉ cụ thể</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control
                                                                    @error('address') is-invalid @enderror" id="address" value="{{  $user->address }}" name="address" placeholder="Địa chỉ (ví dụ: 103 Vạn Phúc, phường Vạn Phúc)">
                                                                @error('address')
                                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="box_section_account">
                                                        <button type="submit" class="btn btn-primary btn-submit-form">Cập nhật tài khoản</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('frontend/js/load-address.js') }}"></script>
<script>
    function phonenumber(mobile) {
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        // var mobile = $('#mobile').val();
        if(mobile !==''){
            if (vnf_regex.test(mobile) == false) 
            {
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    function validatePhone (phone)
    {
        var removeChar = function (strInput) {
            return strInput.replace(/(<([^>]+)>)/ig, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
        }
        if(phone == '' || phone.replace(/\s/g, '').length < 1){
            $('#errorPhone').show();
            $('#phoneComment').parent().addClass('is-invalid');
            var errorPhone = false;
        }else{
            if(phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false){
                $('.text-phone-error-comment').text('Số điện thoại không hợp lệ');
                $('#errorPhone').show();
                $('#phoneComment').parent().addClass('is-invalid');
                var errorPhone = false;
            }else{
                $('#errorPhone').hide();
            }
        }

        if(errorPhone == false){
            return false;
        }
    }

    


    function keyUpValidate (elementKeyup, elementHide, elementName = false, extend = false, errorText, star = false,  invaliEmail = false)
    {
        var removeChar = function (strInput) {
            return strInput.replace(/(<([^>]+)>)/ig, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
        }

        $(document).on('keyup', '#'+elementKeyup, function(){
            if($(this).val() != '' && $(this).val().replace(/\s/g, '').length > 0 && removeChar($(this).val()) != ''){
                $('#'+elementHide).hide();
                $('#'+elementHide).parent().children().removeClass('is-invalid');
            }else{
                $('#'+elementHide).show();
                $('#'+elementHide).parent().children().addClass('is-invalid');
            }
            //check phone
            if(extend == 'phone'){
                if($(this).val().length > 0){
                    if($(this).val().length < 10 || $(this).val().length > 10 || phonenumber($(this).val()) == false){
                        $('.'+errorText).text('Số điện thoại không hợp lệ');
                        $('#'+elementHide).show();
                        $('#'+elementHide).parent().children().addClass('is-invalid');
                    }else{
                        $('#'+elementHide).hide();
                        $('#'+elementHide).parent().children().removeClass('is-invalid');
                    }
                }else{
                    $('.'+errorText).text('Thông tin bắt buộc');
                    $('#'+elementHide).show();
                    $('#'+elementHide).parent().children().addClass('is-invalid');
                }
            }
        });
    }

    function callKeyUpValidate ()
    {
        //validate create comment
        keyUpValidate('phone', 'errorPhone', 'none', 'phone', 'text-phone-error-comment');
    }

    function handle()
    {
        $(document).on('submit','#form-change-info',function(){
            event.preventDefault();

            let phone = $('#phone').val();
            var validate = validatePhone(phone);
            if(validate == false){
                return false;
            }

            let href=$(this).attr('href');
            let formValues = $(this).serialize();
            $.ajax({
                type: "Get",
                url: href,
                data: formValues,
                dataType: "JSON",
                success: function (response) {
                    if(response.code==200){
                        $('.clientlogin-name').html(response.name);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error:function(response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Lỗi rồi! Vui lòng thử lại',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    }


    $(document).ready(function(){
        handle();
        //keyup validate

        callKeyUpValidate();
    });
</script>

@endsection
