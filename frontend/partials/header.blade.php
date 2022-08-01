    <div class="menu_fix_mobile">
        <div class="close-menu">
			<p><a href="{{ makeLink('home') }}"><img src="{{ $header['logo']->image_path }}" alt="Logo"></a></p>
            <a href="javascript:;" id="close-menu-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
        <div class="scroll_menu">
	        <ul class="nav-main2">
	        	<li>
	        		<hr class="line_menu">
	        	</li>
				<li class="menu_item">
	        		<a href="{{route('product.sale')}}">
	        			<div class="icon" style="color: #bd140c"><i class="fas fa-bookmark"></i></div>
	        			<div class="value" style="color: #bd140c; font-weight:600">Sản phẩm Sale </div>
	        		</a>
	        	</li>
				<li>
	        		<hr class="line_menu">
	        	</li>
	        	<li class="menu_item">
	        		<a href="{{\Auth::check() ? route('home.my-account') : route('login')}}">
	        			<div class="icon"><i class="fas fa-user"></i></div>
	        			<div class="value">
	        				Tài khoản
							<p>{{\Auth::check() ? \Auth::user()->name  : ''}}</p>
	        			</div>
	        		</a>
	        	</li>
	        	<li class="menu_item">
	        		<a href="{{\Auth::check() ? route('home.my-order') : route('login')}}">
	        			<div class="icon"><i class="fas fa-shopping-cart"></i></div>
	        			<div class="value">Đơn đặt hàng</div>
	        		</a>
	        	</li>
	        	<li><hr class="line_menu"></li>
	        	<li class="menu_item">
	        		<a href="{{route('product.renderProductView')}}">
	        			<div class="icon"><i class="fas fa-heart"></i></div>
	        			<div class="value">Sản phẩm đã xem</div>
	        		</a>
	        	</li>
				@if($header['productAll'] && $header['productAll'])
					<li class="menu_item">
						<a href="{{$header['productAll']->slug_full}}">
							<div class="icon"><i class="fas fa-award"></i></div>
							<div class="value">Tất cả Sản phẩm</div>
						</a>
					</li>
				@endif

	        	<li class="menu_item">
	        		<a href="{{route('product.gift')}}">
	        			<div class="icon"><i class="fas fa-bullhorn"></i></div>
	        			<div class="value">Quà tặng </div>
	        		</a>
	        	</li>

	        	 <li class="menu_item">
	        		<a href="{{route('product.bo-suu-tap-root')}}">
	        			<div class="icon"><i class="fas fa-calendar-check"></i></div>
	        			<div class="value">Bộ sưu tập</div>
	        		</a>
	        	</li>
	        	<li>
	        		<hr class="line_menu">
	        	</li>
	        	{{--<li class="menu_item">
	        		<a href="">
	        			<div class="icon">
	        				<i class="fas fa-heart"></i>
	        			</div>
	        			<div class="value">
	        				Room Ideas
	        			</div>
	        		</a>
	        	</li>
	        	<li class="menu_item">
	        		<a href="">
	        			<div class="icon">
	        				<i class="fas fa-heart"></i>
	        			</div>
	        			<div class="value">
	        				Wayfair Credit Card
	        			</div>
	        		</a>
	        	</li>
	        	<li class="menu_item">
	        		<a href="">
	        			<div class="icon">
	        				<i class="fas fa-heart"></i>
	        			</div>
	        			<div class="value">
	        				Wayfair Financing
	        			</div>
	        		</a>
	        	</li>
	        	<li class="menu_item">
	        		<a href="">
	        			<div class="icon">
	        				<i class="fas fa-heart"></i>
	        			</div>
	        			<div class="value">
	        				Gift Card
	        			</div>
	        		</a>
	        	</li> --}}
	        	<li class="menu_item">
	        		<a href="{{ makeLinkToLanguage('contact', null, null, App::getLocale()) }}">
	        			<div class="icon"><i class="fas fa-map-marked"></i></div>
	        			<div class="value">
	        				Liên hệ & Hỗ trợ
	        			</div>
	        		</a>
	        	</li>
	        </ul>
	        <ul class="nav-main">
				<li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
	                <a href="{{makeLink('home')}}"><span>Trang chủ</span></a>
	            </li>
	            {{-- 
	            @if(isset($header['menuNew3']))
	                @foreach ($header['menuNew3'] as $value)
	                    <li class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }}">
	                        <a href="{{ $value['slug_full'] }}"><span>{!!  $value['name']  !!}</span>
	                            @isset($value['childs'])
	                            <i class="fa fa-angle-down"></i>
	                            @endisset
	                        </a>
	                    </li>
	                @endforeach
	            @endif
	            --}}
	            
		        @include('frontend.components.menu',[
		            'limit'=>3,
		            'icon_d'=>'<i class="fa fa-angle-down mn-icon"></i>',
		            'icon_r'=>'<i class="fa fa-angle-down mn-icon"></i>',
		            'data'=>$header['menu_mobile'],
		            'active'=>false
		        ])
		        
		        {{-- @include('frontend.components.menu',[
		            'limit'=>3,
		            'icon_d'=>'<i class="fa fa-angle-down mn-icon"></i>',
		            'icon_r'=>'<i class="fa fa-angle-down mn-icon"></i>',
		            'data'=>$header['menu-mega'],
		            'active'=>false
		        ]) --}}

	        </ul>
	        {{--
			@if (isset($header['socialParent']) && $header['socialParent'])
			<div class="social-menu-mb">
				<div class="title">
					{{ $header['socialParent']->name }}
				</div>
				<div class="social-menu-main">
					<ul class="social">
						@foreach ($header['socialParent']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
						<li><a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a></li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif
			--}}
			@if(\Auth::check())
				<div class="sign_in_menu">
					<a class="pl-Button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<span class="pl-Button-content">Thoát</span>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			@else
				<div class="sign_in_menu">
					<a class="pl-Button" href="{{route('login')}}">
						<span class="pl-Button-content">Đăng nhập</span>
					</a>
				</div>
			@endif
		</div>
    </div>

    <div class="header2">
		<div class="top-banner">
			<div class="top-banner-container">
				<div class="top-banner-content">
					<a class="top-banner-links">
						<picture class="top-banner-overlay">
							<source media="(min-width: 800px)" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" style="">
							<source media="(min-width: 320px)" srcset="https://secure.img1-fg.wfcdn.com/im/92774645/compr-r100/2101/210102407/PromoBanner.png" style="">
							<img class="SWBPicture-image" alt="4th of July SALE | SAVE up to 60% Now!" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" style="">
						</picture>
					</a>
				</div>
			</div>
		</div>
		<div class="header-top">
			<div class="container-fluid">
				<div class="box-header-top">
					<nav class="top-nav top-nav-left">
                        <ul>
                            <li><a href="{{ $header['tai_sao']->slug }}" class="smooth">{{ $header['tai_sao']->value }} <i class="fas fa-arrow-right"></i></a>
                            </li>
							{{--<li class="mobile_mb"><a class="smooth" href="/danh-muc-tin-tuc/he-thong-cua-hang" fixed-sn="" title="">
                                <img src="/frontend/images/icon-store.png" style="vertical-align: text-bottom"> 
								Hệ thống cửa hàng</a>
                            </li>--}}
                        </ul>
                    </nav>
					<nav class="top-nav">
                        <ul>
                            <li><a class="smooth" href="">Thẻ toán online qua thẻ</a>
                                {{--<div class="sub_page">
                                    <ul>
                                        <li><a href="#">#</a></li>
                                    </ul>
                                </div>--}}
                            </li>
                            <li><a class="smooth" href="" title="">Miễn phí vận chuyển trên 35k*</a></li>
                        </ul>
                    </nav>
				</div>
			</div>
		</div>
		<div class="header_home">
            <div class="container-fluid">
                <div class="row">
                    
    					<div class="list-bar">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </div>
               
                        <div class="logo-head">
							<div class="image">
								<a href="{{ makeLink('home') }}"><img src="{{ $header['logo']->image_path }}" alt="Logo"></a>
							</div>
						</div>
						{{--
						<div class="section-search d-md-block d-sm-none d-none">
							<form action="{{ makeLink('search') }}" autocomplete="off" method="GET" class="cart_header">
								<div>
									<input type="text" name="keyword" class="header-top-search js-input-search" placeholder="Nhập từ khóa tìm kiếm trên Kena">
									<div class="search_mobile" type="submit">
										<svg focusable="false" viewBox="0 0 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable" aria-hidden="true" data-hb-id="pl-icon"><path d="M18.75 17.94l-4.53-4.53A5.44 5.44 0 0015.5 9.9a5.51 5.51 0 10-2 4.22l4.5 4.53a.52.52 0 00.71 0 .51.51 0 00.04-.71zM5.5 9.9a4.5 4.5 0 114.5 4.5 4.51 4.51 0 01-4.5-4.5z"></path></svg>
									</div>
								</div>
								<div class="box-search-result bsize" id="search_ajax"></div>
								
							</form>
						<div>
						--}}

						<div class="SearchBar-wrap">
							<form class="SearchBar SearchBar--centered" name="keyword" role="search" method="get" action="{{ makeLink('search') }}" data-enzyme-id="SearchBar" data-cypress-id="SearchBar">
								<div class="combobox-wrapper" aria-label="Search wayfair.com" data-cy-id="SearchBar">
									<div class="Combobox" role="combobox" aria-expanded="false" aria-haspopup="listbox" aria-owns="SearchBarDropdown">
										<div class="HomebaseTextInput HomebaseTextInput--hiddenLabel HomebaseTextInput--hasPrefix" data-hb-id="Combobox">
											<div class="HomebaseTextInput-fieldWrap">
												<div class="HomebaseTextInput-labelWrap">
													<label class="HomebaseTextInput-label" for="searchInput">
														<span class="HomebaseTextInput-prefix" data-enzyme-id="textInput-prefix" id="prefix" data-cypress-id="textInput-prefix">
															<svg focusable="false" viewBox="0 0 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable" aria-hidden="true" data-hb-id="pl-icon"><path d="M18.75 17.94l-4.53-4.53A5.44 5.44 0 0015.5 9.9a5.51 5.51 0 10-2 4.22l4.5 4.53a.52.52 0 00.71 0 .51.51 0 00.04-.71zM5.5 9.9a4.5 4.5 0 114.5 4.5 4.51 4.51 0 01-4.5-4.5z"></path></svg>
														</span>
														<span class="HomebaseTextInput-inputWrap">
															<input autocomplete="off" aria-controls="SearchBarDropdown" aria-autocomplete="list" aria-activedescendant="" class="StyledBox-owpd5f-0 FloatLabel__FloatLabelInput-sc-1i0wezz-1  guNylu HomebaseTextInput-input HomebaseTextInput-input pl-FloatLabel-input js-input-search" id="searchInput" type="search" name="keyword" required="" placeholder="Nhập từ khóa tìm kiếm trên Kena" data-enzyme-id="textInput" data-cypress-id="textInput" value="">
															<span class="StyledBox-owpd5f-0 FloatLabel__FloatLabelWrap-sc-1i0wezz-2  gXIwey HomebaseTextInput-labelText HomebaseTextInput-labelText pl-FloatLabel" data-enzyme-id="textInput-label" data-cypress-id="textInput-label">
																<span class="vdvxm0" data-hb-id="VisuallyHidden">Nhập từ khóa tìm kiếm trên Kena</span>
															</span>
														</span>
													</label>
													
												</div>
											</div>
										</div>
									</div>
									<div class="listbox box-search-result bsize" role="listbox" id="search_ajax" aria-label="SearchBarDropdown">
										
									</div>
								</div>
							</form>
						</div>
				
						<div class="CartButton">
							<a href="{{ route('cart.list') }}">
								<button class="CartButton-wrap" type="button" aria-label="Cart" data-cy-id="CartButton" data-enzyme-id="CartButton">
									<div class="CartContent CartContent--applyMercuryMinicartStyles">
										<div class="StyledBox-owpd5f-0 BoxV2___StyledStyledBox-sc-1wnmyqq-0 iKomgw" data-hb-id="BoxV2">
											<sup class="CartContent-badge" data-enzyme-id="CartContentBadgeQuantity">{{ $header['totalQuantity'] }}<span class="vdvxm0" data-hb-id="VisuallyHidden">{{ $header['totalQuantity'] }} sản phẩm trong giỏ hàng</span></sup>
											<svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable CartContent-icon" aria-hidden="true" data-hb-id="pl-icon">
												<path d="M21 15.54a.51.51 0 00.49-.38l2-8a.51.51 0 00-.1-.43.49.49 0 00-.39-.19H8.28L8 4.9a.51.51 0 00-.49-.4H5a.5.5 0 000 1h2.05L9 15l-2.36 4.74a.53.53 0 000 .49.5.5 0 00.42.23H21a.5.5 0 00.5-.5.5.5 0 00-.5-.5H7.89l1.92-3.92zm1.34-8l-1.73 7H9.92l-1.43-7zM10 21a1 1 0 101 1 1 1 0 00-1-1zM18 21a1 1 0 101 1 1 1 0 00-1-1z"></path>
											</svg>
										</div>
										<span class="CartContent-title" data-enzyme-id="CartContent" aria-hidden="true">Giỏ hàng</span>
									</div>
								</button>
							</a>
						</div>
						{{--
                        <div class="h-cart dropdown show" id="li_desktop_cart">
                            <a class="smooth d-flex" href="{{ route('cart.list') }}">
                                <img src="/frontend/images/cart.png" alt="cart" title="cart">
                                <span>Giỏ hàng</span>
                                <strong class="cart-badge-number" id="desktop-quick-cart-badge">{{ $header['totalQuantity'] }}</strong>
                                <label class="d-block d-lg-none cart-badge-number" id="desktop-quick-cart-mobi">{{ $header['totalQuantity'] }}</label>
                            </a>
                        </div>
                		--}}
                    
                </div>
            </div>
        </div>
		<div id="header" class="header">
            <div class="container-fluid">
				<div class="row">
					<div class="box-header-main">
						<div class="box_padding">
							<div class="menu menu-desktop">
								<ul class="nav-main">
									<li class="nav-item active_menu">
										<a href="{{ makeLink('about-us') }}"><span>Giới thiệu</span></a>
									</li>
									{{-- @include('frontend.components.menu-2',[
										'limit'=>3,//list ra 3 cap con
										'icon_d'=>'<i class="fa fa-angle-down"></i>',
										'icon_r'=>"<i class='fa fa-angle-right'></i>",
										'data'=>$header['menuM'],
										'active'=>false
									]) --}}

									{{-- {{dd($header)}} --}}

									{{-- <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
										<a href="{{makeLink('home')}}"><span>Trang chủ</span></a>
									</li>
									<li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
										<a href="{{makeLink('home')}}"><span>Hàng mới</span></a>
									</li>
									<li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
										<a href="{{makeLink('home')}}"><span>Bán chạy</span></a>
									</li> --}}

									{{-- @if(isset($header['menuNew3']))
										@foreach ($header['menuNew3'] as $value)
											<li class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }}">
												<a href="{{ $value['slug_full'] }}"><span>{!!  $value['name']  !!}</span>
													@isset($value['childs'])
													<i class="fa fa-angle-down"></i>
													@endisset
												</a>
												@isset($value['childs'])
													@if (count($value['childs'])>0)
														<ul class="nav-sub">
															@foreach ($value['childs'] as $childValue)
																<li class="nav-sub-item">
																	<a href="{{ $childValue['slug_full'] }}"><span>{{ $childValue['name'] }}</span>
																	</a>
																</li>
															@endforeach
														</ul>
													@endif
												@endisset
											</li>
										@endforeach
									@endif --}}

									{{-- <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
										<a href="{{makeLink('home')}}"><span>Bộ sưu tập</span></a>
									</li> --}}
									@include('frontend.components.menu',[
										'limit'=>1,
										'icon_d'=>'<i class="fa fa-angle-down"></i>',
										'icon_r'=>"<i class='fa fa-angle-right'></i>",
										'data'=>$header['menu_mobile'],
										'active'=>false
									])

									{{-- @include('frontend.components.menu',[
										'limit'=>3,
										'icon_d'=>'<i class="fa fa-angle-down"></i>',
										'icon_r'=>"<i class='fa fa-angle-right'></i>",
										'data'=>$header['menuNew2'],
										'active'=>false
									]) --}}
								</ul>
							</div>
							{{--
							<div class="box-header-main-right box-header-main-right-mobile">
								<ul>
									<div class="search_mobile" type="submit"><a><i class="fas fa-search"></i></a></div>
								</ul>
							</div>
							<div class="search_mobile"><a><i class="fas fa-search"></i></a></div>
							--}}
							<div class="search" id="search">
								<div class="form-s-mobile">
									<form action="{{ makeLink('search') }}" method="GET">
										<div class="input-group">
										  <input type="text" class="form-control" name="keyword" placeholder="Từ khóa">
										  <div class="input-group-append">
											<button class="input-group-text"  type="submit"><i class="fas fa-search"></i></button>
										  </div>
										</div>
									</form>
									<span class="close-search"><i class="fas fa-times"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 search_mb1">
                        <div class="header-top-right">
							<ul class="section-search">
								<form action="{{ makeLink('search') }}" method="GET" class="cart_header">
								<li>
									<input type="text" name="keyword" class="header-top-search js-input-search" placeholder="Nhập từ khóa tìm kiếm trên Kena">
									<div class="search_mobile" type="submit"><a>Tìm kiếm</a></div>
								</li>
								</form>
							</ul>
						</div>
                    </div>
				</div>
            </div>
        </div>
        {{--<div id="search">
            <div class="wrap-search-header-main  search-mobile" >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-search-header-main">
                                <div class="search-header">
                                    <form id="formSearchMb" name="formSearchMb" method="GET" action="{{ makeLink('search') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm...">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default"  type="submit"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="form-control close-search" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
        </div>--}}
    </div>

    <div class="lc__mask lc__mask_search_suggest"></div>

