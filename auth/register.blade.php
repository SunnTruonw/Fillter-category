@extends('frontend.layouts.main')
@section('content')

{{-- <div class="text-left wrap-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="breadcrumb">
                    <li class="breadcrumbs-item">
                        <a href="{{ makeLink('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumbs-item"><a href="javascript:;" class="currentcat">Đăng ký tài khoản</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
<div class="block-register desktop">
	<div class="container">
		<div class="title">  {{ isset($url) ? ucwords($url) : ""}}Đăng ký thành viên</div>
		<div id="errors-list">

		</div>
		@if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif
		<div class="content">
			@isset($url)
						<form method="POST" id="sendRegister" action='{{ url("register/$url") }}' aria-label="{{ __('auth.register') }}">
						@else
						<form method="POST" id="sendRegister" action="{{ route('register') }}" aria-label="{{ __('auth.register') }}">
						@endisset
							@csrf
						<div class="row">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="name" type="text" class="form-control input-register @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên (*)" autocomplete="name" >
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<div class="form-err" id="errorName" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-name-error">Thông tin bắt buộc</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="email" type="email" class="form-control input-register @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Nhập Email" autocomplete="email">

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<div class="form-err" id="errorEmail" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-email-error">Email không hợp lệ</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="phone" type="text" class="form-control input-register @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Nhập Số điện thoại (*)" autocomplete="phone">

										@error('phone')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<div class="form-err" id="errorPhone" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-phone-error">Số điện thoại không hợp lệ</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="username" type="text" class="form-control input-register @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Nhập tài khoản đăng nhập (*)" autocomplete="username" autofocus>
										@error('username')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<div class="form-err" id="errorUsername" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-username-error">Thông tin bắt buộc</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="password" type="password" class="form-control input-register @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu (*)" autocomplete="new-password">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
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
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group row">
									<div class="col-md-12">
										<input id="confirm-password" type="password" class="form-control input-register" name="confirm-password" placeholder="Xác nhận lại mật khẩu (*)" autocomplete="new-password">
										<div class="form-err" id="errorConfirmPassword" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-confirm-password-error">Mật khẩu > 8 ký tự</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row mb-0 text-center">
							<div class="wrap-btn-register">
								<button type="submit" class="btn btn-primary btn-register">
									Đăng ký tài khoản
								</button>
								<div class="dky mt-2">
									<p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>.</p>
								</div>
							</div>
						</div>
						</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	function isUsername(username) {
		var regex = /^[a-z0-9_.]+$/;
		return regex.test(username);
	}

	

	function validateCreateRegister (name,email,phone,username,password,confirmPassword)
	{
		var removeChar = function (strInput) {
			return strInput.replace(/(<([^>]+)>)/ig, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
		}

		if(name == '' || phone.replace(/\s/g, '').length < 1){
            $('#errorName').show();
            var errorName = false;
        }else{
            if(name.length > 191){
                $('.text-name-error').text('Tên đã vượt quá 191 ký tự');
                $('#errorName').show();
                var errorName = false;
            }else{
                $('#errorName').hide();
            }
        }

		if(phone == '' || phone.replace(/\s/g, '').length < 1){
			$('#errorPhone').show();
			$('#phoneComment').parent().addClass('is-invalid');
			var errorPhone = false;
		}else{
			if(phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false){
				$('.text-phone-error').text('Số điện thoại không hợp lệ');
				$('#errorPhone').show();
				$('#phoneComment').parent().addClass('is-invalid');
				var errorPhone = false;
			}else{
				$('#errorPhone').hide();
			}
		}

		if(email != '' || email.length > 0 || email.replace(/\s/g, '').length > 0 || removeChar(email) != ''){
			if(isEmail(email) == false){
				$('#errorEmail').show();
				return false;
			}else{
				$('#errorEmail').hide();
			}
		}else{
			$('#errorEmail').hide();
		}
		
		if(username == '' || username.replace(/\s/g, '').length < 1){
			$('#errorUsername').show();
			var errorUsername = false;
		}else{
			if(isUsername(username) == false){
				$('.text-username-error').text('Tên đăng nhập viết liền không có dấu');

				$('#errorUsername').show();
				return false;
			}else{
				$('#errorUsername').hide();
			}
		}

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

		if(confirmPassword == '' || confirmPassword.length < 8){
            $('#errorConfirmPassword').show();
            var errorConfirmPassword = false;
        }else{
            if(confirmPassword.length < 8){
                $('.text-password-error').text('Mật khẩu > 8 ký tự');
                $('#errorConfirmPassword').show();
                var errorConfirmPassword = false;
            }else{
                $('#errorConfirmPassword').hide();
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
			//check name
			if(extend == 'name'){
				if($(this).val().length < 0){
					$('.'+errorText).text('Thông tin bắt buộc');
					$('#'+elementHide).show();
					$('#'+elementHide).parent().children().addClass('is-invalid');
				}
			}

			//check username
			if(extend == 'username'){
				var username = $(this).val();
				if($(this).val().length > 0){
					if(username != '' && username.replace(/\s/g, '').length > 0){
						if(isUsername(username) == false){
							$('.'+errorText).text('Tên đăng nhập viết liền không có dấu');

							$('#'+elementHide).show();
							$('#'+elementHide).parent().children().addClass('is-invalid');
							return false;
						}else{
							$('#'+elementHide).hide();
							$('#'+elementHide).parent().children().removeClass('is-invalid');
						}
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

		//check email
		if(invaliEmail != false){
			$(document).on('keyup', '#'+elementKeyup, function(){
				var email = $(this).val();
				if(email != '' && email.length > 5 && email.replace(/\s/g, '').length > 0){
					if(isEmail(email) == false){
						$('#'+elementHide).show();
						$('#'+elementHide).parent().children().addClass('is-invalid');
						return false;
					}else{
						$('#'+elementHide).hide();
						$('#'+elementHide).parent().children().removeClass('is-invalid');
					}
				}else{
					$('#'+elementHide).hide();
					$('#'+elementHide).parent().children().removeClass('is-invalid');
				}
			});
		}
	}

	function callKeyUpValidate ()
	{
		//validate create
		keyUpValidate('name', 'errorName', 'none', 'name', 'text-name-error');
		keyUpValidate('phone', 'errorPhone', 'none', 'phone', 'text-phone-error');
		keyUpValidate('email', 'errorEmail', 'none', 'none', 'none','none','none', 'is-email');
        keyUpValidate('username', 'errorUsername', 'none', 'username', 'text-username-error');
        keyUpValidate('password', 'errorPassword', 'none', 'password', 'text-password-error');
        keyUpValidate('confirm-password', 'errorConfirmPassword', 'none', 'confirm-password', 'text-confirm-password-error');

	}

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

	function sendRegister ()
	{
		$("#sendRegister").on("submit", function () {
			let name = $('#name').val();
			let phone = $('#phone').val();
			let email = $('#email').val();
			let username = $('#username').val();
			let password = $('#password').val();
			let confirmPassword = $('#confirm-password').val();

			var validate = validateCreateRegister(name, email, phone, username, password, confirmPassword);

			if(validate == false){
				return false;
			}

			// var e=this;
       
            // $(this).find("[type='submit']").html("Đăng ký...");

            // $.post($(this).attr('action'),$(this).serialize(),function(data){
              
            //   $(e).find("[type='submit']").html("Đăng ký");
            // //   if(data.status){
            // //     window.location='/';
            // //   }
              

            // }).fail(function(response) {
             
            //   $(e).find("[type='submit']").html("Đăng nhập");
            //   $(".alert").remove();
            //   var erroJson = JSON.parse(response.responseText);
            //   for (var err in erroJson) {
            //     for (var errstr of erroJson[err])
            //     $("[name='" + err + "']").after("<div class='alert alert-danger'>" + errstr + "</div>");
            //   }

            // });
        	// return false;
		});

			
   
	}


	$(document).ready(function(){
		sendRegister();
		//keyup validate
		callKeyUpValidate();
	});
</script>

@endsection
