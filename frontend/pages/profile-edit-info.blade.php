@extends('frontend.layouts.main-profile')

@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')
<style>
	.wrap-content-main {
		padding: 0;
	}
	.form-group label {
		font-weight: 600;
	}
	.btn-primary {
		margin-top: 0px;
		background: #e90000;
		padding: 5px 20px;
		color: #fff;
		border-radius:0;
		border: none;
	}
	.btn-danger {
		margin-top: 0px;
		background: #ccc;
		padding: 5px 20px;
		color: #333;
		border-radius:0;
		border: none;
	}
	.form-control {
		font-size: 14px;
	}
    .load-address .box-address{
            margin-top: 20px;
            padding:15px;

            background-color: #eee;

        }
        .load-address h3{
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
        }
    @media (max-width: 550px){
        .wrap-slide-home{
            display: none;
        }
    }

</style>
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
                    <div class="col-md-12">

                        @if ($user->active==0)
                        <div class="col-md-12">
                            <div class="alert alert-danger" style=" font-size: 150%;">
                                <strong>warning!</strong> Tài khoản của bạn chưa được kích hoạt <br>
                                <span style="font-size: 14px;">(Các thông số tài khoản sẽ là thông số của tài khoản sau khi được kích hoạt)</span>
                              </div>
                        </div>
                        @elseif($user->active==2)
                        <div class="col-md-12">
                            <div class="alert alert-danger" style=" font-size: 150%;">
                                <strong>warning!</strong> Tài khoản của bạn đã bị khóa <br>
                              </div>
                        </div>
                        @endif

                        @if(session("alert"))
                        <div class="alert alert-success">
                            {{session("alert")}}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-warning">
                            {{session("error")}}
                        </div>
                        @endif

                        <form id="formEditUser" action="{{route('profile.updateInfo',['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
									<div class="title-h">
										<span>Thông tin tài khoản</span>
									</div>
                                    <div class="card card-outline card-primary">
                                        <div class="card-body table-responsive p-3">
                                            <div class="row">
                                                @if (!$data->provider)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Họ và tên <span class="red">*</span></label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{old('name')?? $data->name }}"
                                                         name="name" placeholder="Họ và tên">
                                                        @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email liên hệ <span class="red">*</span></label>
                                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"  value="{{old('email')?? $data->email }}"
                                                            name="email" placeholder="Email">
                                                        @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-err" id="errorEmail" style="display: none;">
                                                            <div class="alert alert-danger-cus alert-des ">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                                <span class="text-email-error">Thông tin bắt buộc</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Tài khoản <span class="red">*</span></label>
                                                        <input id="username" type="text" class="form-control  @error('username') is-invalid @enderror"
                                                        value="{{old('username')?? $data->username }}" name="username" placeholder="username">
                                                        @error('username')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-err" id="errorUsername" style="display: none;">
                                                            <div class="alert alert-danger-cus alert-des ">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                                <span class="text-username-error">Thông tin bắt buộc</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Số điện thoại <span class="red">*</span></label>
                                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ old('phone')?? $data->phone }}" name="phone" placeholder="Số điện thoại">
                                                        @error('phone')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-err" id="errorPhone" style="display: none;">
                                                            <div class="alert alert-danger-cus alert-des ">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                                <span class="text-phone-error">Thông tin bắt buộc</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="">Mật khẩu</label>
                                                        <input
                                                            type="password"
                                                            class="form-control"
                                                            id=""
                                                            value="{{ old('password') }}"  name="password"
                                                            placeholder="Mật khẩu"
                                                        >
                                                        @error('password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nhập lại mật khẩu</label>
                                                        <input
                                                            type="password"
                                                            class="form-control"
                                                            id=""
                                                            value="{{ old('password_confirmation') }}"  name="password_confirmation"
                                                            placeholder="Nhập lại mật khẩu"
                                                        >
                                                        @error('password_confirmation')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="item_col_left">
                                                            <label for="">Ngày sinh <span class="red">*</span></label>
                                                        </div>
                                                        <div class="item_col_right">
                                                            <input type="date" class="form-control  @error('date_birth') is-invalid @enderror"
                                                            value="{{ old('date_birth')??$data->date_birth }}" name="date_birth" placeholder="Ngày sinh">
                                                            @error('date_birth')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <div class="item_col_left">
                                                            <label for="">Bạn muốn trở thành <span class="red">*</span></label>
                                                        </div>
                                                        <div class="item_col_right">
                                                            <input type="text" class="form-control  @error('you_become') is-invalid @enderror"
                                                            value="{{ old('you_become')??$data->you_become}}" name="you_become" placeholder="Bạn muốn trở thành">
                                                            @error('you_become')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="item_col_left">
                                                            <label for="">Sở thích <span class="red">*</span></label>
                                                        </div>
                                                        <div class="item_col_right">
                                                            <textarea class="form-control  @error('info_more') is-invalid @enderror"
                                                             cols="30" rows="2" placeholder="Sở thích của bạn" name="info_more"
                                                             >{{old('info_more') ??$data->info_more }}</textarea>
                                                            @error('info_more')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="form-group">
                                                        <label for="">Ngày sinh</label>
                                                        <input type="date" class="form-control  @error('date_birth') is-invalid @enderror"
                                                        value="{{ old('date_birth')?? $data->date_birth }}" name="date_birth" placeholder="Ngày sinh">
                                                        @error('date_birth')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div> --}}


                                                    {{-- <div class="form-group">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1" name="sex" @if((old('sex')?? $data->sex)=="1"||$data->sex==null) {{'checked'}} @endif>Nam
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="0" @if( (old('sex')?? $data->sex)=="0"){{'checked'}} @endif name="sex">Nữ
                                                            </label>
                                                        </div>
                                                        @error('sex')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div> --}}
                                                    @if (!$data->provider)
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh đại diện</label>
                                                            <input type="file" class="form-control-file img-load-input border" id="" name="avatar_path">
                                                        </div>
                                                        @error('avatar_path')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <img class="img-load border p-1 w-100" src="{{$data->avatar_path?$data->avatar_path:$shareFrontend['userNoImage']}}" alt="{{$data->name}}" style="height: auto;width:auto;max-width:150px;object-fit:cover;">
                                                    </div>
                                                    @endif

                                                </div>
												<div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Chỉnh sửa thông tin</button>
                                                        <button type="reset" class="btn btn-danger">Làm lại</button>
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
<script>

   $(function(){
        // js load image khi upload
    $(document).on('change', '.img-load-input', function() {
        let input = $(this);
        displayImage(input, '.wrap-load-image', '.img-load');
    });

    function displayImage(input, selectorWrap, selectorImg) {
        let img = input.parents(selectorWrap).find(selectorImg);
        let file = input.prop('files')[0];
        let reader = new FileReader();

        reader.addEventListener("load", function() {
            // convert image file to base64 string
            img.attr('src', reader.result);
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
   });

</script>

<script>
	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	function isUsername(username) {
		var regex = /^[a-z0-9_.]+$/;
		return regex.test(username);
	}

	function validateCreateRegister (email,username,phone)
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
				var errorEmail = false;

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

        if(errorPhone == false || errorUsername == false || errorEmail == false){
        return false;
    }
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

	function handle ()
	{
		$("#formEditUser").on("submit", function () {
            // e.preventDefault();
			let phone = $('#phone').val();
			let email = $('#email').val();
			let username = $('#username').val();

			var validate = validateCreateRegister(email, username,phone);

			if(validate == false){
				return false;
			}
		});

			
   
	}


	$(document).ready(function(){
		handle();
		//keyup validate
	});
</script>

@endsection
