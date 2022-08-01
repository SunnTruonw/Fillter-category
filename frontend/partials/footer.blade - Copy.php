    {{-- <div class="wrap-bg wow fadeInUp" style="background-image: url('{{ asset ($footer['banner_shipping']->image_path) }}');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-bg">
                        <img src="{{ asset ($footer['banner_giua']->image_path) }}" alt="Image">
                        <div class="d-flex box-bg-content">
                            <div class="logo-bg">
                                <img src="{{ asset ($footer['logo_banner_shipping']->image_path) }}" alt="Logo">
                            </div>
                            <div class="button_tuvan">
                                <a href="{{makeLinkToLanguage('bao-gia',null,null,App::getLocale())}}" class="btn-view"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{$footer['nhan_tu_van']->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
--}}
    <div class="wrap-partner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="list-item autoplay5-doitac category-slide-1">
                        @if ($footer['doitac'])
                        @foreach ($footer['doitac']->childs()->orderby('order')->orderByDesc('created_at')->get() as $item)
                        <div class="item">
                            <div class="box">
                                <a href=""><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--
    <div class="dangky_cuoitrang">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-12">
                    @if (isset($footer['sign_now']) && $footer['sign_now'])
                    <div class="box_info">
                        <div class="title">
                            {{ $footer['sign_now']->name }}
                        </div>
                        <div class="giam">
                            {!! $footer['sign_now']->description !!}
                        </div>
                    </div>
                    @endif
                    <div class="box_form_dky">
                        <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
                            @csrf
                            <input class="form-control" type="email" name="email" placeholder="Nhập email của bạn!" required>
                            <button name="submit">Gửi <i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
	<div class="main_footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 çol-12">
						<div class="content">
							<div class="box_menu_foot">
								<ul>
									@if ($footer['linklienket'])
                        			@foreach ($footer['linklienket']->childs()->orderby('order')->orderByDesc('created_at')->get() as $item)
									<li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>
									@endforeach
                        			@endif
								</ul>
							</div>
							<ul class="pt_social">
								@if (isset($footer['socialParent']) && $footer['socialParent'])
                                    @foreach ($footer['socialParent']->childs()->where('active',1)->orderby('order')->latest()->get() as $social)
                                        <li>
                                            <a href="{{ $social->slug }}" target="blank" rel="noopener noreferrer">
                                                @if($social->image_path != null)
                                                <img src="{{ asset($social->image_path) }}" alt="{{ $social->name }}">
                                                @else
                                                {!! $social->value !!}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    <div class="footer">
        <div class="footer-main">
            <div class="container">
                <div class="row">
					<div class="col-lg-5 col-md-12 col-sm-12 col-12 content-box">
						@if (isset($footer['dataAddress']) && $footer['dataAddress'])
                        <div class="link-footer">
                            <div class="logo_foot">
                                <a href="{{ makeLink('home') }}"><img src="{{ asset($footer['dataAddress']->image_path) }}" alt="Logo footer"></a>
                            </div>
                            <div class="title-footer">{{ $footer['dataAddress']->slug }}</div>
                            <ul class="pt_list_addres">
								@foreach ($footer['dataAddress']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                	<li><img src="{{ asset($item->image_path) }}" alt="{{$item->name}}"> <strong>{{ $item->value }}</strong></li>
								@endforeach
                            </ul>
                        </div>
						@endif
                    </div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-12 content-box">
                        <div class="link-footer">
                            <div class="title-footer">Thời gian làm việc</div>
                            <div class="thoigianlamviec">
                                @if (isset($footer['worktime']) && $footer['worktime'])
                                <div>{!! $footer['worktime']->description !!}</div>
                                @endif
                            </div>
                            <div class="title title-footer">
                                Đăng ký nhận bảng tin
                            </div>
                            <div class="pt_box_form">
                                <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
                                    @csrf
                                    <div class="pt_box">
                                        <input type="email" name="email" id="txtemail" placeholder="Email của bạn">
                                        <i class="far fa-envelope"></i>
                                        <button type="submit" name="gone" id="gone">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 content-box">
                        <div class="link-footer">
                            <div class="title-footer">Thông tin hữu ích</div>
                            <ul class="list-link">
                                @if (isset($footer['socialParent1']) && $footer['socialParent1'])
                                @foreach ($footer['socialParent1']->childs()->where('active',1)->orderby('order')->latest()->get() as $social)
                                <li><a href="{{ $social->slug }}"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ $social->name }}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="coppy-right">
                           @if (isset($footer['coppy_right'])&&$footer['coppy_right'])
                           {{ $footer['coppy_right']->value }}
                           @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="back_to_top" id="back-to-top">
                            <a onclick="topFunction();">
                                <img src="{{ asset('frontend/images/icon_back_to_top.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="pt_contact_vertical">
    <div class="contact-mobile">
        @if (isset($footer['zalo'])&&$footer['zalo'])
        <div class="contact-item">
            <a class="contact-icon zalo" title="zalo" href="https://zalo.me/0945268833" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('frontend/images/zalo-icon.png') }}" alt="icon">
            </a>
        </div>
        @endif
        @if (isset($footer['messenger'])&&$footer['messenger'])
        <div class="contact-item">
            <a class="contact-icon fb-mess" title="facebook" href="https://m.me/{{ $footer['messenger']->slug }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('frontend/images/facebook-icon.png') }}" alt="icon">
            </a>
        </div>
        @endif
        <div class="clearfix"></div>
    </div>
</div>

<div class="quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon">
    <div class="tel_phone">
        <a href="tel:0945268833">0945.268.833</a>
    </div>
    <a href="tel:0945268833">
        <div class="quick-alo-ph-circle"></div>
        <div class="quick-alo-ph-circle-fill"></div>
        <div class="quick-alo-ph-img-circle"></div>
    </a>
</div>
{{-- <div class="back_to_top hidden-xs" id="back-to-top">
    <a onclick="topFunction();">
        <span>Về đầu trang</span>
        <img src="{{ asset('frontend/images/icon_back_to_top.png') }}">
    </a>
</div>
<div class="contact_fixed">
    <li><a href="tel:0945268833"><i class="fa fa-phone"></i></a></li>
    <li><a href="https://zalo.me/0945268833"><img src="{{ asset('frontend/images/zalo2.png') }}" alt="Zalo"></a></li>
    <li><a href="https://m.me/"><img src="{{ asset('frontend/images/messenger2.png') }}" alt="Messenger"></a></li>
    <li><a onclick="topFunction();" href="javascript:;"><img src="{{ asset('frontend/images/icon_back_to_top.png') }}" alt="Back to top"></a></li>
</div> --}}


<script>

        // ajax load form
        $(document).on('submit',"[data-ajax='submit']",function(){
            let myThis=$(this);
            let formValues = $(this).serialize();
            let dataInput=$(this).data();
            // dataInput= {content: "#content", href: "#modalAjax", target: "modal", ajax: "submit", url: "http://127.0.0.1:8000/contact/store-ajax"}

            $.ajax({
                type: dataInput.method,
                url: dataInput.url,
                data: formValues,
                dataType: "json",
                success: function (response) {
                    if(response.code==200){
                        myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val('');
                        if(dataInput.content){
                            $(dataInput.content).html(response.html);

                        }
                        if(dataInput.target){
                            switch (dataInput.target) {
                                case 'modal':
                                    $(dataInput.href).modal();
                                    break;
                                case 'alert':
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.html,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                default:
                                    break;
                            }
                        }
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                   // console.log( response.html);
                },
                error:function(response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
            return false;
        });
    </script>



