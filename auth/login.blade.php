@extends('frontend.layouts.main')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="box-auth" id="login">
				<div class="box-center__body">
					<div class="row box-center__form auth justify-content-center">
						<div class="col-12 col-sm-8 auth-right">
							<div class="auth-title">Bạn đã có tài khoản:</div>
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
							<div class="auth-form">
								<form id="handleAjax" action="{{ route('login') }}" method="POST">
									@csrf
									<div class="form-group">
										<label for="">Tên đăng nhập :</label>
										<input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror"
											placeholder="Tên đăng nhập" value="{{ old('username') }}">
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
									<div class="form-group">
										<label for="">Mật khẩu:</label>
										<input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
											placeholder="Mật khẩu" autocomplete="off">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<div class="form-err" id="errorPassword" style="display: none;">
											<div class="alert alert-danger-cus alert-des ">
												<i class="fa fa-minus" aria-hidden="true"></i>
												<span class="text-password-error">Thông tin bắt buộc</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<a href="{{ route('password.request') }}" target="blank"
											class="forgot-password">Quên mật khẩu?</a>
									</div>

									<div class="form-group checkbox">
										<input type="checkbox" class="btn-checkbox" name="remember"
											{{ old('remember') ? 'checked' : '' }}>
										<label for="remember-me">Ghi nhớ đăng nhập</label>
									</div>

									<div class="form-submit">
										<button type="submit" class="btn btn-primary">Đăng nhập</button>
									</div>
								</form>
							</div>
							{{-- <div class="auth-title">Đăng nhập với:</div>
							<div class="auth-social">
								<a href="{{ route('login.social', ['social' => 'facebook']) }}"
									class="btn btn-blue">
									<i class="fab fa-facebook-f"></i>
									Đăng nhập với Facebook</a>
								<a href="{{ route('login.social', ['social' => 'google']) }}" class="btn btn-red">
									<i class="fab fa-google"></i> Đăng nhập với Google</a>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function isUsername(username) {
		var regex = /^[a-z0-9_.]+$/;
		return regex.test(username);
	}

	function validateCreateComment (username,password)
	{
		var removeChar = function (strInput) {
			return strInput.replace(/(<([^>]+)>)/ig, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
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
		});

		
	}

	function callKeyUpValidate ()
	{
		//validate create
        keyUpValidate('username', 'errorUsername', 'none', 'username', 'text-username-error');
        keyUpValidate('password', 'errorPassword', 'none', 'password', 'text-password-error');

	}

	function sendLogin ()
	{
		// handle submit event of form
		$(document).on("submit", "#handleAjax", function() {
			var e = this;
			let username = $('#username').val();
			let password = $('#password').val();

			var validate = validateCreateComment(username, password);

			if(validate == false){
				return false;
			}
			// change login button text before ajax
			$(this).find("[type='submit']").html("Đang đang nhập...");

			$.post($(this).attr('action'), $(this).serialize(), function(data) {

			$(e).find("[type='submit']").html("Đăng nhập");
			if (data.status) { // If success then redirect to login url
				window.location = data.redirect_location;
			}
			}).fail(function(response) {
				// handle error and show in html
			$(e).find("[type='submit']").html("Đăng nhập");
			//   $(".alert").remove();
			var erroJson = JSON.parse(response.responseText);
			console.log(erroJson);
			for (var err in erroJson) {
				for (var errstr of erroJson[err])
				$("#errors-list").html("<div class='alert alert-danger'>" + errstr + "</div>");

			}

			});
			return false;
		});
	}


	$(document).ready(function(){
		sendLogin();
		//keyup validate
		callKeyUpValidate();
	});
</script>
@endsection
