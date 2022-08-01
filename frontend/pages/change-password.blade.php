@extends('frontend.layouts.main-profile')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')


<div class="content-account" id="results">
    <div class="clientlogin-name">
        Đổi mật khẩu
    </div>
    
    <div class="clientlogin-content">
        <form action="" class="form-change-info" method="GET" id="form-change-password">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="">Mật khẩu hiện tại</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control
                            @error('old_password') is-invalid @enderror" id="old-password" value="" name="old_password" placeholder="Mật khẩu hiện tại">
                        @error('old_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-err" id="errorOldPassword" style="display: none;">
                            <div class="alert alert-danger-cus alert-des ">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                <span class="text-old-password-error">Mật khẩu > 8 ký tự</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="">Mật khẩu mới</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control
                            @error('password') is-invalid @enderror" id="password" value="" name="password" placeholder="Mật khẩu mới">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-err" id="errorPassword" style="display: none;">
                            <div class="alert alert-danger-cus alert-des ">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                <span class="text-password-error">Mật khẩu > 8 ký tự</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="">Nhập lại mật khẩu mới</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control
                            @error('confirm_password') is-invalid @enderror" id="confirm-password" value="" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                        @error('confirm_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-err" id="errorConfirmPassword" style="display: none;">
                            <div class="alert alert-danger-cus alert-des ">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                <span class="text-confirm-password-error">Mật khẩu > 8 ký tự</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_section_account">
                <button type="submit" class="btn btn-primary btn-submit-form">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('frontend/js/load-address.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    function validatePassword(password, oldPassword, confirmPassword)
    {
        if(password == '' || password.length < 8){
            $('#errorPassword').show();
            var errorPassword = false;
        }else{
            if(password.length < 8){
                $('.text-password-error').text('Mật khẩu > 8 ký tự');
                $('#errorPassword').show();
                var errorPassword = false;
            }else{
                $('#errorPassword').hide();
            }
        }

        if(oldPassword == '' || oldPassword.length < 8){
            $('#errorPassword').show();
            var errorPassword = false;
        }else{
            if(oldPassword.length < 8){
                $('.text-password-error').text('Mật khẩu > 8 ký tự');
                $('#errorPassword').show();
                var errorPassword = false;
            }else{
                $('#errorPassword').hide();
            }
        }

        if(confirmPassword == '' || confirmPassword.length < 8){
            $('#errorPassword').show();
            var errorPassword = false;
        }else{
            if(confirmPassword.length < 8){
                $('.text-password-error').text('Mật khẩu > 8 ký tự');
                $('#errorPassword').show();
                var errorPassword = false;
            }else{
                $('#errorPassword').hide();
            }
        }

        if(errorPassword == false){
            return false;
        }
    }

    function keyUpValidate (elementKeyup, elementHide, elementName = false, extend = false, errorText, star = false,  invaliEmail = false)
    {
        $(document).on('keyup', '#'+elementKeyup, function(){
            if($(this).val() != ''){
                $('#'+elementHide).hide();
                $('#'+elementHide).parent().children().removeClass('is-invalid');
            }else{
                $('#'+elementHide).show();
                $('#'+elementHide).parent().children().addClass('is-invalid');
            }
            //check password
            if(extend == 'password'){
                if($(this).val().length > 0){
                    if($(this).val().length < 8){
                        $('.'+errorText).text('Mật khẩu > 8 ký tự');
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

            //check old password
            if(extend == 'old-password'){
                if($(this).val().length > 0){
                    if($(this).val().length < 8){
                        $('.'+errorText).text('Mật khẩu > 8 ký tự');
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

            //check confirm password
            if(extend == 'confirm-password'){
                if($(this).val().length > 0){
                    if($(this).val().length < 8){
                        $('.'+errorText).text('Mật khẩu > 8 ký tự');
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
        //validate create
        keyUpValidate('password', 'errorPassword', 'none', 'password', 'text-password-error');
        keyUpValidate('old-password', 'errorOldPassword', 'none', 'old-password', 'text-old-password-error');
        keyUpValidate('confirm-password', 'errorConfirmPassword', 'none', 'confirm-password', 'text-confirm-password-error');
    }

    function handle()
    {
        $(document).on('submit','#form-change-password',function(){
            event.preventDefault();

            let password = $('#password').val();
            let oldPassword = $('#old-password').val();
            let confirmPassword = $('#confirm-password').val();
            var validate = validatePassword(password,oldPassword, confirmPassword);


            if(validate == false){
                return false;
            }

            let url = '{{route('home.storeChangePassword')}}';

            let formValues = $(this).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: formValues,
                dataType: "JSON",
                success: function (response) {
                    if(response.code==200){
                        $('#form-change-password')[0].reset();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error:function(response){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Lỗi rồi! Vui lòng thử lại',
                        showConfirmButton: false,
                        timer: 3000
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
