<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="vi" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="abstract" content="@yield('abstract')" />
    <meta name="ROBOTS" content="Metaflow" />
    <meta name="ROBOTS" content="noindex, nofollow, all" />
    <meta name="AUTHOR" content="Phan văn tân" />
    <meta name="revisit-after" content="1 days" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:url" content="{{ makeLink('home') }}" />
    <link rel="canonical" href="{{ makeLink('home') }}" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <script type="text/javascript" src="{{ asset('lib/jquery/jquery-3.2.1.min.js') }} "></script>

    <!--
    <link rel="stylesheet" href="{linkhost}/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{linkhost}/css/lightbox.min.css" type="text/css" />
    <link rel="stylesheet" href="{linkhost}/css/animate.css" type="text/css" />
    <link href="{linkhost}/css/slick.css" rel="stylesheet" />
    <link href="{linkhost}/css/slick-theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="{linkhost}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    -->

    <!--
    <link rel="stylesheet" href="{linkhost}/css/stylesheet-2.css" type="text/css" />
    <link rel="stylesheet" href="{linkhost}/css/header.css" type="text/css" />
    <link rel="stylesheet" href="{linkhost}/css/footer.css" type="text/css" />
    <link rel="stylesheet" href="{linkhost}/css/cart.css" type="text/css" />
    -->


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-4.5.3-dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('font/fontawesome-5.13.1/css/all.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('font/font-awesome-4.7.0/css/font-awesome.min.css') }}"> --}}
    <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/wow/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/lightbox-plus/css/lightbox.min.css') }}">
    {{--<link rel="stylesheet" type="text/css"
         href="{{ asset('lib/datetimepicker/css/jquery.datetimepicker.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/reset.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">


    @yield('css')
    <style>
        #sidebar-profile {}

        .avatar {}

        .avatar h4 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .avatar h5{
            color: red;
            font-size: 16px;
            margin-bottom: 0;
            font-weight: bold;
        }
        .avatar .media img {
            margin-top: 0;
        }

        .avatar .media {
            align-items: center;
        }

        .wrap-profile-container {
            background-color: #f4f6f9;
            padding: 30px 0;
        }

        #sidebar-profile nav .nav-item {
            white-space: nowrap;
            border-bottom: 1px solid #e5e5e5;
        }

        #sidebar-profile nav .nav-item:last-child {
            border: unset;
        }

        .bg-left {
            background-color: #fff;
            margin-bottom: 15px;
        }

        #sidebar-profile nav .nav-item .nav-link {
            white-space: nowrap;
            overflow: hidden;
        }

        #sidebar-profile nav .nav-item .nav-link p {
            display: inline-block;
            margin: 0;
            font-size: 15px;
        }

        #sidebar-profile nav .nav-item .nav-link i {
            margin-right: 5px;
            font-size: 10px;
        }

        h1 {
            font-size: 25px;
            font-weight: bold;
            margin-top: 0;
        }

        .card-title h3 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }

        .load-multiple-img>img {
            width: 32%;
            border: 1px solid #eee;
            padding: 5px;
        }

        .title_thongtin {
            width: 100%;
            background: #eee;
            color: #e90000;
            padding: 10px;
            margin: 0 0 15px 0;
        }

        .title_thongtin h2 {
            margin: 0;
            padding: 0;
            font-size: 15px;
            text-align: left;
            font-weight: 600;
        }

        .wrap-profile-container {
            padding: 0;
        }

        .breadcrumbs {
            background: #fff;
            margin-bottom: 20px;
        }

        .info-box {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            border-radius: .25rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            padding: .5rem;
            position: relative;
            width: 100%;
        }

        .info-box .info-box-icon {
            border-radius: .25rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 10px;
        }

        .info-box .info-box-text,
        .info-box .progress-description {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .info-box .info-box-number {
            display: block;
            margin-top: .25rem;
            color: #f00;
            font-weight: 700;
        }

        .card {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            padding: .75rem 1.25rem;
            position: relative;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }

        .card-title {

            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
            margin-bottom: 10px;
        }

        .card-header>.card-tools {

            margin-right: -.625rem;
        }

        .table td,
        .table th {
            text-align: left;
            padding: 5px 10px;
        }

        .table thead th {
            text-align: left;
            padding: 10px 5px;
            text-transform: uppercase;
        }

        .btn-info {
            font-size: 12px;
            border: none;
        }

        .btn-danger {
            font-size: 12px;
            border: none;
        }

        .btn-success {
            font-size: 12px;
            text-align: center;
            border: none;
        }

        thead {
            font-size: 13px;
        }

        table {
            font-size: 13px;
        }

        .badge-1 {
            background: #f00;

            padding: 10px 15px;
            color: #fff;
        }

        .badge-2 {
            background: #ffc107;
            padding: 10px 15px;

        }

        .badge-3 {
            background: #28a745;
            color: #fff;
            padding: 10px 15px;

        }

        .badge-4 {
            background: #17a2b8;
            color: #fff;
            padding: 10px 15px;

        }

        .load-status>span {
            cursor: pointer;
        }
        .status-transaction {
            width: auto;
            margin-top: 15px;
        }
        .title-profile{
            font-size: 18px;
            margin-top: 0;
            font-weight: bold;
        }
    </style>

</head>

<body class="template-search">
    <div class="wrapper home">
        <!-- Navbar -->
        @include('frontend.partials.header')
        <!-- /.navbar -->
        <div class="wrap-profile-container">
            {{-- <div class="text-left wrap-breadcrumbs">
                <div class="breadcrumbs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <ul>
                                    <li class="breadcrumbs-item">
                                        <a href="">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumbs-item"><a href="#" class="currentcat">Quản lý tài khoản</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <div class="row">
                    @php
                        $user = auth()->user();
                        $pointM=new \App\Models\Point();
                        $totalPoint = $pointM->sumPointCurrent($user->id);
                    @endphp
                    <div class="col-md-3 bg-left">
                        <div id="sidebar-profile" class="pt-3 pb-3">
                            <div class="avatar text-center p-3">
                                <a href="{{ route('profile.index') }}">
                                    <img src="{{ $user->avatar_path ? $user->avatar_path : $shareFrontend['userNoImage'] }}"
                                        alt="{{ $user->name }}" class="mb-3 rounded-circle"
                                        style="width:120px; height: 120px;">
                                    <h4>{{ $user->name }}</h4>
                                    {{-- <h5>{{ number_format($totalPoint) }} điểm</h5> --}}
                                </a>
                            </div>
                            <nav class="mt-2">
                                <div class="title_thongtin">
                                    <h2>QUẢN LÝ TRANG CÁ NHÂN</h2>
                                </div>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <i class="fas fa-edit"></i>
                                            <p> Mã ID: <strong>8866{{ $user->id }}</strong></p>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.editInfo') }}">
                                            <i class="fas fa-edit"></i>
                                            <p> Thay đổi thông tin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home.changePassword') }}">
                                            <i class="fas fa-edit"></i>
                                            <p> Đổi mật khẩu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ ('profile.history') }}">
                                            <i class="fas fa-edit"></i>
                                            <p> Lịch sử mua hàng </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contact.index') }}">
                                            <i class="fas fa-question"></i>
                                            <p> Hỗ trợ </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('password.request') }}">
                                           <i class="fas fa-edit"></i><p> Quên mật khẩu</p>
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-edit"></i>
                                            <p> Thoát</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            {{-- @if ($user->active == 1)
                                <nav class="mt-2">
                                    <div class="title_thongtin">
                                        <h2>Quản lý gian hàng</h2>
                                    </div>
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                        data-accordion="false">
                                        @if (!$user->isCreateShop())
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.createShop') }}">
                                                <i class="fas fa-edit"></i>
                                                <p> Tạo gian hàng</p>
                                            </a>
                                        </li>
                                        @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.editShop') }}">
                                                <i class="fas fa-edit"></i>
                                                <p> Sửa thông tin gian hàng</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.createProduct') }}">
                                                <i class="fas fa-edit"></i>
                                                <p> Đăng sản phẩm</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.listProduct') }}">
                                                <i class="fas fa-edit"></i>
                                                <p> Gian hàng</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.transaction') }}">
                                                <i class="fas fa-cart-plus"></i>
                                                <p>Quản lý giao dịch</p>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.createPayment') }}">
                                                <i class="fas fa-money-check-alt"></i><p> Nạp tiền vào tài khoản</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('profile.historyPoint') }}">
                                                <i class="fas fa-money-check-alt"></i><p> Lịch sử</p>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            @endif --}}
                            {{-- <nav class="mt-2">
                                <div class="title_thongtin">
                                    <h2>Quản lý review</h2>
                                </div>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.listReview') }}">
                                            <i class="fas fa-list-ol"></i> Danh sách review</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.createReview') }}">
                                            <i class="fas fa-edit"></i>
                                            <p> Viết review</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <nav class="mt-2">
                                <div class="title_thongtin">
                                    <h2>Quản lý lịch sử</h2>
                                </div>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.orderTour') }}">
                                            <i class="fas fa-list-ol"></i> Lịch sử đặt tour</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.orderYacht') }}">
                                            <i class="fas fa-list-ol"></i>
                                            <p> Lịch sử đặt vé máy bay</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.orderHotel') }}">
                                            <i class="fas fa-list-ol"></i>
                                            <p> Lịch sử đặt khách sạn</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>


        @include('frontend.partials.footer')


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('lib/jquery/jquery-3.2.1.min.js') }} "></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript" src="{{ asset('lib/lightbox-plus/js/lightbox-plus-jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script type="text/javascript" src="{{ asset('lib/bootstrap-4.5.3-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/slick-1.8.1/js/slick.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="{{ asset('lib/datetimepicker/js/jquery.datetimepicker.full.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('lib/components/js/Cart.js') }}"></script>
    <script src="{{ asset('frontend/js/load-address.js') }}"></script>

    <script>
        $(function() {
            $(document).on('change', '#city_s', function() {
                let urlRequest = $(this).data("url");
                let mythis = $(this);
                let value = $(this).val();
                let defaultCity = "<option value=''>Chọn tỉnh/thành phố</option>";
                let defaultDistrict = "<option value=''>Chọn quận/huyện</option>";
                let defaultCommune = "<option value=''>Chọn xã/phường/thị trấn</option>";
                if (!value) {
                    $('#district_s').html(defaultDistrict);
                    $('#commune_s').html(defaultCommune);
                } else {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: {
                            'cityId': value
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                let html = defaultDistrict + data.data;
                                $('#district_s').html(html);
                                $('#commune_s').html(defaultCommune);
                            }
                        }
                    });
                }
            })
            $(document).on('change', '#district_s', function() {
                let urlRequest = $(this).data("url");
                let mythis = $(this);
                let value = $(this).val();
                let defaultCity = "<option value=''>Chọn tỉnh/thành phố</option>";
                let defaultDistrict = "<option value=''>Chọn quận/huyện</option>";
                let defaultCommune = "<option value=''>Chọn xã/phường/thị trấn</option>";
                if (!value) {
                    $('#commune_s').html(defaultCommune);
                } else {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: {
                            'districtId': value
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                let html = defaultCommune + data.data;
                                $('#commune_s').html(html);
                            }
                        }
                    });
                }
            });
            $(document).on('change', '.city_s2', function() {
                let urlRequest = $(this).data("url");
                let mythis = $(this);
                let value = $(this).val();
                let defaultCity = "<option value=''>Chọn tỉnh/thành phố</option>";
                let defaultDistrict = "<option value=''>Chọn quận/huyện</option>";
                let defaultCommune = "<option value=''>Chọn xã/phường/thị trấn</option>";
                if (!value) {
                    mythis.parents('form').find('.district_s2').html(defaultDistrict);
                    mythis.parents('form').find('.commune_s2').html(defaultCommune);
                } else {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: {
                            'cityId': value
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                let html = defaultDistrict + data.data;
                                mythis.parents('form').find('.district_s2').html(html);
                                mythis.parents('form').find('.commune_s2').html(defaultCommune);
                            }
                        }
                    });
                }
            })
            $(document).on('change', '.district_s2', function() {
                let urlRequest = $(this).data("url");
                let mythis = $(this);
                let value = $(this).val();
                let defaultCity = "<option value=''>Chọn tỉnh/thành phố</option>";
                let defaultDistrict = "<option value=''>Chọn quận/huyện</option>";
                let defaultCommune = "<option value=''>Chọn xã/phường/thị trấn</option>";
                if (!value) {
                    mythis.parents('form').find('.commune_s2').html(defaultCommune);
                } else {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: {
                            'districtId': value
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                let html = defaultCommune + data.data;
                                mythis.parents('form').find('.commune_s2').html(html);
                            }
                        }
                    });
                }
            });

            $(document).on('click', ".dropdown-login .dropdown-toggle", function() {
                event.preventDefault();
                $(this).parent('.dropdown-login').find('.dropdown-menu').slideToggle();
            });

            $(document).on('click', '.pt_icon_right', function() {
                event.preventDefault();
                $(this).parentsUntil('ul', 'li').children("ul").slideToggle();
                $(this).parentsUntil('ul', 'li').toggleClass('active');
            });
            $(document).on('change', '#typeGD_s', function() {
                let urlRequest = $(this).data("url");
                let mythis = $(this);
                let value = $(this).val();
                let defaultCategoryChild = "<option value=''>Chọn danh mục</option>";
                if (!value) {
                    $('#categoryChild_s').html(defaultCategoryChild);
                } else {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data: {
                            'id': value
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                let html = defaultCategoryChild + data.html;
                                $('#categoryChild_s').html(html);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>

    </script>
    @yield('js')
</body>

</html>
