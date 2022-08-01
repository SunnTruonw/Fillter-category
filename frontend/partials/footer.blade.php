{{--
<div class="wrap-partner">
    <div class="container-fluid">
        <div class="row">
			<div class="col-12 col-sm-12">
                <div class="group-title">
                    <div class="title title-img">Đối Tác Chiến Lược</div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="list-item autoplay5-doitac category-slide-1">
                    @if ($footer['doitac'])
                    @foreach ($footer['doitac']->childs()->orderby('order')->orderByDesc('created_at')->get() as $item)
                    <div class="item">
                        <div class="box">
                            <a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
--}}

<div class="section_email">
    <div class="container-fluid">
        <div class="box_section_email">
            <div class="title">
                Đăng ký nhận bảng tin khuyến mãi
            </div>
            <div class="form_email">
                <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Nhập email của bạn" required>
                    <button type="submit" name="submit">Gửi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="footer">
        <div class="footer-main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-sm-12 col-item-footer">
                        <div class="box-footer-main-info">
                            @if (isset($footer['dataAddress']) && $footer['dataAddress'])
                                <div class="logo-footer">
                                    <a href="{{ makeLink('home') }}"><img src="{{ asset($footer['dataAddress']->image_path) }}" alt="Logo footer"></a>
                                </div>
                                <div class="content-address-footer">
                                    {!! $footer['dataAddress']->description !!}
                                </div>
                                <div class="list-address-footer">
                                    <ul>
                                        @foreach ($footer['dataAddress']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                            <li>
                                                <strong>{{ $item->name }}</strong>
                                                <span>: {{ $item->value }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
					<div class="col-lg-2 col-md-12 col-sm-12 col-item-footer">
                        @if(isset($footer['linklienket']) && $footer['linklienket']->count()>0 )
                            <div class="title-footer">
                                {{ __('footer.lien_ket_huu_ich') }}
                            </div>
                            <div class="list-link-footer">
                                <ul class="footer-link">
                                    @foreach ($footer['linklienket']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                    <li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="row">
							@if(isset($footer['listCategory']) && $footer['listCategory']->count()>0 )
                            <div class="col-lg-5 col-md-12 col-sm-12 col-item-footer">
                                <div class="title-footer">
                                    Danh mục sản phẩm
                                </div>
                                <div class="list-link-footer">
                                    <ul class="footer-link">
                                        @foreach ($footer['listCategory'] as $item)
                                        <li><a href="{{ $item->slug_full }}">{{ $item->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
							@endif
							<div class="col-lg-7 col-md-12 col-sm-12 col-item-footer">
								<div class="title-footer">
								{{ __('footer.dangky_nhanbantin') }}
								</div>
                                {{--
								<div class="box_form_dky">
									<p>{{ __('footer.duoc_giam_gia') }}!</p>
									<form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
										@csrf
										<input class="form-control" type="email" name="email" placeholder="{{ __('footer.nhap_mail') }}" required>
										<button name="submit"> <i class="fas fa-paper-plane"></i></button>
									</form>
								</div>
                                --}}
                                <ul class="pt_social">
									<p>Kết nối tới chúng tôi</p>
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
                                <div class="chung_chi">
                                    <a href="#" target="_blank"><img src="/frontend/images/logo_1576741719.png" alt="DMCA"></a>
                                    <a href="#" target="_blank"><img src="/frontend/images/logo_bct.webp" alt="Bộ công thương"></a>
                                </div>
							</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container-fluid">
                <div class="row line_bottom">
                    <div class="col-md-12 col-sm-12">
                        <div class="coppy-right">
                           @if (isset($footer['coppy_right'])&&$footer['coppy_right'])
                           {{ $footer['coppy_right']->value }}
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form-tv" id="modal-form-dky" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
        <div class="modal-body">
            <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
               @csrf
                <input type="hidden" name="title" value="Đăng ký tư vấn">
                <div class="box-content-form">
                    <h4 class="modal-title">
                        <a href=""><img src="{{ asset(optional($header['logo'])->image_path) }}"></a>
                    </h4>
                    <div class="title-form-m">
                        Đăng ký tư vấn
                    </div>
                    <div class="title-form-sm">
                        Liên hệ với chúng tôi để được hỗ trợ
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="name" placeholder="Họ tên">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="phone" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="content" placeholder="Nội dung tư vấn">
                    </div>
                    <button type="submit">Gửi đi</button>
                    <div class="text-center">
                        <a class="close-form-modal" data-dismiss="modal" aria-label="Close">Đóng lại X</a>
                    </div>
                    {{-- <div class="text">
                        Chúng tôi sẽ gọi lại cho quý khách hàng ngay khi nhận được thông tin quý khách hàng gửi.
                    </div> --}}
                </div>
            </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
</div>

{{--
<div class="pt_contact_vertical">
    <div class="contact-mobile">
        @if (isset($footer['zalo'])&&$footer['zalo'])
        <div class="contact-item">
            <a class="contact-icon zalo" title="zalo" href="https://zalo.me/{{ $footer['zalo']->slug }}" target="_blank" rel="noopener noreferrer">
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
--}}
{{--
<div class="quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon">
    <div class="tel_phone">
        <a href="tel:{{ optional($footer['hotline'])->value }}">{{ optional($footer['hotline'])->value }}</a>
    </div>

    <a href="tel:{{ optional($footer['hotline'])->value }}">
        <div class="quick-alo-ph-circle"></div>
        <div class="quick-alo-ph-circle-fill"></div>
        <div class="quick-alo-ph-img-circle"></div>
    </a>


</div>
--}}

{{-- <div class="float-contact">
    @if (isset($footer['zalo'])&&$footer['zalo'])
    <button class="chat-zalo">
        <a href="https://zalo.me/{{ $footer['zalo']->slug }}">Chat Zalo</a>
    </button>
    @endif
    @if (isset($footer['messenger'])&&$footer['messenger'])
    <button class="chat-face">
        <a href="https://m.me/{{ $footer['messenger']->slug }}">Chat Facebook</a>
    </button>
    @endif
    <button class="hotline">
        <a href="tel:{{ optional($footer['hotline'])->value }}">Hotline:{{ optional($footer['hotline'])->value }}</a>
    </button>
</div>

<div class="bottom-contact">
    <ul>
        <li>
            <a href="tel:{{ optional($footer['hotline'])->value }}">
                <img data-lazyloaded="1" src="https://maylocnuocaqualaed.vn/wp-content/plugins/tien-ich-lien-he/anh/call.png">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Gọi Ngay</span>
            </a>
        </li>
        <li>
            <a href="">
                <img src="https://maylocnuocaqualaed.vn/wp-content/plugins/tien-ich-lien-he/anh/gmail.png" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Gửi Email</span>
            </a>
        </li>
        <li>
            <a href="">
                <img src="https://m.me/{{ $footer['messenger']->slug }}" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Chat Facebook</span>
            </a>
        </li>
        <li>
            <a href="https://zalo.me/{{ $footer['zalo']->slug }}">
                <img src="https://maylocnuocaqualaed.vn/wp-content/plugins/tien-ich-lien-he/anh/zalo.png" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Chat Zalo</span>
            </a>
        </li>
    </ul>
</div> --}}

<div class="float-contact">
    @if (isset($footer['zalo'])&&$footer['zalo'])
    <button class="chat-zalo">
        <a href="https://zalo.me/{{ $footer['zalo']->slug }}">Chat Zalo</a>
    </button>
    @endif
    @if (isset($footer['messenger'])&&$footer['messenger'])
    <button class="chat-face">
        <a href="https://m.me/{{ $footer['messenger']->slug }}">Chat Facebook</a>
    </button>
    @endif
    <button class="hotline">
        <a href="tel:{{ optional($footer['hotline'])->value }}">Hotline:{{ optional($footer['hotline'])->value }}</a>
    </button>
</div>

<div class="bottom-contact">
    <ul>
        @if (isset($footer['linkFooter'])&&$footer['linkFooter'])
            @foreach ($footer['linkFooter']->childs()->where('active', 1)->orderBy('order')->get() as $value)
                <li>
                    <a href="{{ $value->slug }}">
                        <img src="{{ asset($value->image_path) }}">
                        <br>
                        <span style="font-weight: 500;font-size: 13px;">{{$value->value}}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>


<div id="quick-view-modal" class="wrapper-quickview" style="display:none;">
    <div class="quickviewOverlay"></div>
    <div class="jsQuickview">
        <div class="modal-header clearfix" style="width:100%">
            <h4 id="product_quickview_title" class="p-title modal-title"></h4>
            <div class="quickview-close">
                <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-5">
                    <div id="product_quickview_image" class="quickview-image image-zoom">
                    </div>
                    <div id="quickview-sliderproduct">
                        <div class="quickview-slider">
                            <ul class="slides"></ul>
                        </div>          
                    </div>
                </div>
                <div class="col-md-7">
                    <form id="form-quickview" method="post" action="/cart/add">
                        <div class="quickview-information">
                            <div class="form-input">                            
                                <div class="quickview-price product-price">
                                    <span id="product_quickview_price"></span>
                                    <del id="product_quickview_price_old"></del>
                                </div>
                            </div>
                            <div id="product_quickview_quantity" class="form-input">
                                
                            </div>

                            <div id="dat_mua" class="form-input" style="width: 100%">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- <div class="back_to_top hidden-xs" id="back-to-top">
    <a onclick="topFunction();">
        <span>Về đầu trang</span>
        <img src="{{ asset('frontend/images/icon_back_to_top.png') }}">
    </a>
</div>
<div class="contact_fixed">
    <li><a href="tel:"><i class="fa fa-phone"></i></a></li>
    <li>
        <a href="https://zalo.me/{{ $footer['hotline']->value }}"><img src="{{ asset('frontend/images/zalo2.png') }}" alt="Zalo"></a>
    </li>
    <li>
        <a href="https://m.me/"><img src="{{ asset('frontend/images/messenger2.png') }}" alt="Messenger"></a>
    </li>
    <li>
        <a onclick="topFunction();" href="javascript:;"><img src="{{ asset('frontend/images/icon_back_to_top.png') }}" alt="Back to top"></a>
    </li>
</div> --}}



<script>

        //quickview

        $(document).ready(function(){
            $('.quickview').click(function(){

                var product_id = $(this).data('id_product');
                var _token = $('input[name="_token"]').val();
                $('.wrapper-quickview').fadeIn(500);
                $('.jsQuickview').fadeIn(500);
                $.ajax({
                    url:"{{url('/quickview')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{product_id:product_id, _token:_token},
                    success:function(data){
                        $('#product_quickview_title').html(data.product_name);
                        $('#product_quickview_id').html(data.product_id);
                        $('#product_quickview_image').html(data.product_image);
                        $('#product_quickview_price').html(data.product_price);
                        $('#product_quickview_quantity').html(data.product_quantity);
                        $('#product_quickview_price_old').html(data.product_price_old);
                        $('#dat_mua').html(data.dat_mua);
                        /*
                        
                        $('#product_quickview_gallery').html(data.product_gallery);
                        $('#product_quickview_desc').html(data.product_desc);
                        $('#product_quickview_content').html(data.product_content);*/
                    }
                });
            });
        });

        $(document).on('click', '.quickview-close, .quickviewOverlay', function(e){
            $(".wrapper-quickview").fadeOut(500);
            $('.jsQuickview').fadeOut(500);
        });

        $(document).on('change','#quantity-quickview',function(){
            if ($(this).val() > 1) {
                var a = $(this).val();
                 //   $(".optionChange").trigger('change');
                
                let url2 = $('#buyCartQuickView').attr('href');
                     url2 += "?quantity=" + $('#quantity-quickview').val();
                     $('#buyCartQuickView').attr('href',url2);
            }
        });

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
                        // if(dataInput.content){
                        //     $(dataInput.content).html(response.html);
                        // }
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

        //Search-Ajax
        $('.js-input-search').keyup(function(){
            var keywords = $(this).val();

            if(keywords != ''){
                $.ajax({
                    url : "{{url('search-ajax')}}",
                    method : "Get",
                    data : {keywords : keywords},
                    // beforeSend: function () {
                    //     $('#search-loader').show();
                    // },
                    success : function(data){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data.data);
						// $("#search-loader").hide();
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });

        var width = $(window).width();
            function search_scroll() {
                let input = $('.js-input-search');
                input.click(function () {
                    previousScrollY = window.scrollY;
                    $('.lc__mask').addClass('lc__block').css({
                    'opacity': '1',
                    'z-index': '1049',
                    'visibility': 'visible'
                    });
                    $(this).closest('.section-search').addClass('is-open')
                    // if (width > 992) {
                    //     $('html, body').animate({
                    //         scrollTop: $('.section-search').offset().top - 200
                    //     }, 800);
                    // };
                })
            };

        // $('.lc__mask_search_suggest').click(function () {
        //     $(this).removeClass('lc__block').css({
        //         'opacity': '0',
        //         'visibility': 'hidden'
        //     });
        //     $('.box-search-result').hide();
        // });

        $('body').click(function (event) 
        {
           if(!$(event.target).closest('#searchInput').length && !$(event.target).is('#searchInput')) {
                $('.lc__mask_search_suggest').removeClass('lc__block').css({
                    'opacity': '0',
                    'visibility': 'hidden'
                });
                $('.box-search-result').hide();
           }     
        });

        function init() {
            search_scroll();
        }

        init();
            
    </script>
    



