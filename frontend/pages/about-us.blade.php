@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('content')
    <div class="content-wrapper">
        <div class="main">
            @include('frontend.components.breadcrumbs',[
                'breadcrumbs'=>$breadcrumbs,
                'breadcrumbs'=>$breadcrumbs,
                'type'=>$typeBreadcrumb,
            ])

            <div class="blog-about-us">

                <div class="wrap-about-us">
                    <div class="container">
                        <div class="row d-flex before-after-unset">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="about-text">
                                    <div class="group-title">
                                        <div class="title title-red text-left">
                                            {{$data->name}}
                                        </div>
                                    </div>
                                    <div class="desc-about">
                                       {!! $data->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('.slider-single').slick({
                slidesToShow: 1,
                autoplay: true,
                slidesToScroll: 1,
                arrows: false,
                dot: false,

                fade: false, //lam phai màu mờ dần
                adaptiveHeight: true,
                autoplaySpeed: 3000, // default 3000 tu dong chay sau 2000milisecon
                infinite: true,
                useTransform: true,
                speed: 400,
                cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',

            });

            $('.slider-nav')
                .on('init', function(event, slick) {
                    $('.slider-nav .slick-slide.slick-current').addClass('is-active');
                })
                .slick({
                    slidesToShow: 9,
                    slidesToScroll: 1,
                    dots: false,
                    focusOnSelect: false,
                    infinite: true,
                    arrows: true,
                    center: true,
                    autoplay: false,
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 6,
                        }
                    }, {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 4,
                        }
                    }, {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 3,
                        }
                    }],
                });
            $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
                $('.slider-nav').slick('slickGoTo', currentSlide);
                var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
                $('.slider-nav .slick-slide.is-active').removeClass('is-active');
                $(currrentNavSlideElem).addClass('is-active');
            });
            $('.slider-nav').on('click', '.slick-slide', function(event) {
                event.preventDefault();
                var goToSingleSlide = $(this).data('slick-index');
                $('.slider-single').slick('slickGoTo', goToSingleSlide);
            });
        });
    </script>
@endsection
@section('js')

@endsection
