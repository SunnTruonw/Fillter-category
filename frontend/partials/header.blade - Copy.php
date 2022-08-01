    <div class="menu_fix_mobile">
        <div class="close-menu">
            <a href="javascript:;" id="close-menu-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
        <ul class="nav-main">
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
    </div>

    <div id="header" class="header">
        <div class="header-main">
            <div class="container">
                <div class="box-header-main">
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
                    <div class="search_kh">
                        <form class="box_search_kh" method="get" action="{{ makeLink('search') }}">
                            <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" required>
                            <button type="submit" name="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="hotline_kh">
                        {!! $header['hotline_top']->description !!}
                    </div>
                    <div class="box-header-main-right">
                        <ul>
                            <li class="icon-search show_search"><a><i class="fas fa-search"></i></a></li>
                            <li class="cart">
                                <a href="{{ route('cart.list') }}">
                                    {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> --}}
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                        <g>
                                        <g id="Bag">
                                        <g>
                                        <path d="M27.996,8.91C27.949,8.395,27.519,8,27,8h-5V6c0-3.309-2.69-6-6-6c-3.309,0-6,2.691-6,6v2H5
                                        C4.482,8,4.051,8.395,4.004,8.91l-2,22c-0.025,0.279,0.068,0.557,0.258,0.764C2.451,31.882,2.719,32,3,32h26
                                        c0.281,0,0.549-0.118,0.738-0.326c0.188-0.207,0.283-0.484,0.258-0.764L27.996,8.91z M12,6c0-2.206,1.795-4,4-4s4,1.794,4,4v2h-8
                                        V6z M4.096,30l1.817-20H10v2.277C9.404,12.624,9,13.262,9,14c0,1.104,0.896,2,2,2s2-0.896,2-2c0-0.738-0.404-1.376-1-1.723V10h8
                                        v2.277c-0.596,0.347-1,0.984-1,1.723c0,1.104,0.896,2,2,2c1.104,0,2-0.896,2-2c0-0.738-0.403-1.376-1-1.723V10h4.087l1.817,20
                                        H4.096z"></path>
                                    </svg>
                                    <span class="number-cart">{{ $header['totalQuantity'] }}</span>
                                </a>
                                <span class="d-none">Giỏ hàng</span>
                            </li>
                        </ul>
                        {{--
                        <div class="menu-top">
                            <ul class="nav-main">
                                @include('frontend.components.menu',[
                                    'limit'=>3,
                                    'icon_d'=>'<i class="fa fa-angle-down"></i>',
                                    'icon_r'=>"<i class='fa fa-angle-right'></i>",
                                    'data'=>$header['menu-2'],
                                    'active'=>false
                                ])
                            </ul>
                        </div>
                        <div class="group-social-full">
                            <ul>
                                @if (isset($header['socialParent'])&&$header['socialParent'])
                                    @foreach ($header['socialParent']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)

                                       @if ($item->image_path)
                                       <li class=""><a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"> <span>{{ $item->name }}</span></a></li>
                                       @else
                                             <li class=""><a href="{{ $item->slug }}">{!! $item->value !!} <span>{{ $item->name }}</span></a></li>
                                       @endif
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">

                <div class="box-header-bottom">
                    {{-- <div class="dropdown">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                            Shop by Category <i class="fas fa-chevron-circle-down"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Link 1</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Link 2</a>
                          <a class="dropdown-item" href="#"><i class="fas fa-angle-right"></i> Link 3</a>
                        </div>
                    </div> --}}
                    <div class="menu menu-desktop">
                        {{-- @include('frontend.components.menu',[
                            'limit'=>7,
                            'icon_d'=>'<i class="fa fa-angle-down"></i>',
                            'icon_r'=>"<i class='fa fa-angle-right'></i>",
                            'data'=>$header['menu'],
                            'active'=>true
                        ]) --}}

                        <ul class="nav-main">
                            {{--
                            @include('frontend.components.menu-2',[
                                'limit'=>3,
                                'icon_d'=>'<i class="fa fa-angle-down"></i>',
                                'icon_r'=>"<i class='fa fa-angle-right'></i>",
                                'data'=>$header['menu-mega'],
                                'active'=>false
                            ])
                            --}}

                            @include('frontend.components.menu',[
                                'limit'=>3,
                                'icon_d'=>'<i class="fa fa-angle-down"></i>',
                                'icon_r'=>"<i class='fa fa-angle-right'></i>",
                                'data'=>$header['menu'],
                                'active'=>false
                            ])
                        </ul>
                        
						<div class="dangnhap">
                            <div id="before-dangnhap"></div>
							<ul class="navbar-nav form_account">
								@guest
									<li class="nav-item">
										<a class="nav-link" href="{{ route('login') }}">
											<span class="icon_account"><img src="{{ asset('frontend/images/oto.png') }}" alt="icon oto"></span>
											<span class="name_account">{{ __('Đăng nhập') }}</span>
										</a>
									</li>
								@else
									<li class="nav-item dropdown">
										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
											@if(Auth::guard('web')->check())
											<span class="icon_account"><i class="fas fa-user"></i></span>
											<span class="name_account">{{ Auth::guard()->user()->name }}</span>
											@endif
										</a>

										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											@if(Auth::guard('web')->check())
												<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												{{ __('Đăng xuất') }}
											 </a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@endif
												@csrf
											</form>
											<a class="dropdown-item" href="{{ route('profile.editInfo') }}">Tài khoản</a>
										</div>
									</li>
								@endguest
							</ul>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="search">
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
        </div>
    </div>