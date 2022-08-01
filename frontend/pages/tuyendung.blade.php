@extends('frontend.layouts.main')



@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')




@section('content')
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset


            <h1 class="title-template-news hidden">{{ $data->name??"" }}</h1>

            <div class="blog-tuyendung">
                <div class="container">
                    <div class="row p-75">
                        <div class="col-md-8 col-sm-12 col-xs-12 block-content-left p-75">
                            <div class="shadow padding-content">
                                <div class="title-detail title-lg">
                                    {{ $data->name??"" }}
                                </div>
                                <div class="list-news-3">
                                    @isset($categoryAll)
                                    @foreach ($categoryAll as $post)

                                    <div class="card-news-horizontal">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ makeLink('tuyen-dung-detail',$post->id,$post->slug) }}"><img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}"></a>
                                            </div>
                                            <div class="content">
                                                <h3><a href="{{ makeLink('tuyen-dung-detail',$post->id,$post->slug) }}">{{ $post->name }}</a></h3>
                                                <div class="desc">
                                                    {!! $post->description  !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 block-content-right p-75" id="side-bar">
                            <div class="side-bar">
                                <div class="title-sider-bar">
                                    <span>{{ __('tuyen-dung.tin_tuyen_dung_noi_bat') }}</span>
                                </div>
                                @isset($post_hot)
                                <div class="list-trending">
                                    <ul>
                                        @foreach ($post_hot as $item)
                                        <li>
                                            <div class="box">
                                                <div class="icon">
                                                    <a href="{{ makeLink('tuyen-dung-detail',$item->id,$item->slug) }}"
                                                    >
                                                        <img src="{{ $item->avatar_path }}" alt="{{ $item->name }}">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h3 class="name">
                                                        <a href="{{ makeLink('tuyen-dung-detail',$item->id,$item->slug) }}">{{ $item->name }}</a>
                                                    </h3>
                                                    <div class="desc">
                                                        {!! $item->description  !!}
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="date">
                                                            {{ date_format($item->updated_at,"d/m/Y")}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).on('click','.pt_icon_right',function(){
            event.preventDefault();
            $(this).parentsUntil('ul','li').children("ul").slideToggle();
            $(this).parentsUntil('ul','li').toggleClass('active');
        })
    })
</script>
@endsection
