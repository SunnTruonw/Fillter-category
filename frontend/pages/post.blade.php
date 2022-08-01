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

            <h1 class="title-template-news hidden">{{ $category->name??"" }}</h1>
                <div class="blog-news">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-9">

                                <div class="group-title">
                                    <div class="title title-red">
                                        {{ __('post.tin_tuc_noi_bat') }}
                                    </div>
                                </div>
                                @isset($data_hot)
                                <div class="list-news-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 right list-news-blog list-news-blog-nb">
                                            <div class="row d-flex before-after-unset">
                                                @foreach ($data_hot as $post)
                                                <div class="fo-03-col-news  col-xs-12 col-sm-3 col-md-3">
                                                    <div class="fo-03-news">
                                                        <div class="box">
                                                            <div class="image">
                                                                <a href="{{ makeLink('post',$post->id,$post->slug) }}"><img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h3><a href="{{ makeLink('post',$post->id,$post->slug) }}">{{ $post->name }}</a></h3>
                                                                <div class="desc">{!! $post->description  !!}</div>
                                                                <div class="block-action-news">
                                                                    <a href="{{ makeLink('post',$post->id,$post->slug) }}" class="xemthem">{{ __('post.xem_them') }}</a>
                                                                    <span class="date">{{ date_format($post->updated_at,"d/m/Y")}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endisset

                                <div class="line-div-long"></div>

                                <div class="group-title">
                                    <div class="title title-red">
                                        {{ $category->name??"" }}
                                    </div>
                                </div>
                                @isset($data)
                                <div class="list-news-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 right list-news-blog">
                                            <div class="row d-flex before-after-unset">
                                                @foreach ($data as $post)
                                                <div class="fo-03-col-news  col-xs-12 col-sm-3 col-md-3">
                                                    <div class="fo-03-news">
                                                        <div class="box">
                                                            <div class="image">
                                                                <a href="{{ makeLink('post',$post->id,$post->slug) }}"><img src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h3><a href="{{ makeLink('post',$post->id,$post->slug) }}">{{ $post->name }}</a></h3>
                                                                <div class="desc">{!! $post->description  !!}</div>
                                                                <div class="block-action-news">
                                                                    <a href="{{ makeLink('post',$post->id,$post->slug) }}" class="xemthem">{{ __('post.xem_them') }}</a>
                                                                    <span class="date">{{ date_format($post->updated_at,"d/m/Y")}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 right">
                                            <div class="pagination-group">
                                                <div class="pagination">
                                                    @if (count($data))
                                                    {{$data->links()}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisset
                            </div>
							<div class="col-lg-3 col-md-12 col-sm-12 col-12 block-content-left">
                            @isset($sidebar)
                                @include('frontend.components.sidebar',[
                                    "categoryProduct"=>$sidebar['categoryProduct'],
                                    "categoryPost"=>$sidebar['categoryPost'],
                                    "categoryProductActive"=>$categoryProductActive,
                                    'fill'=>true,
                                    'product'=>true,
                                    'post'=>false,
                                ])
                            @endisset
							<div class="side-bar">
							<div class="title-sider-bar">
								TIN TỨC NỔI BẬT
							</div>
                            @if( isset($postsHot) && $postsHot->count()>0 )
							<div class="list-trending">
								<ul>
                                    @foreach($postsHot as $item)
                                    @php
                                        $postTrans = $item->translationsLanguage()->first();
                                    @endphp
    									<li>
    										<div class="box">
    											<div class="icon">
    												<a href="{{ $item->slug_full }}"><img src="{{ asset($item->avatar_path) }}" alt="{{ $postTrans->name }}"></a>
    											</div>
    											<div class="content">
    												<h3 class="name"><a href="{{ $item->slug_full }}">{{ $postTrans->name }}</a></h3>
    												<div class="desc">{{ $postTrans->description }}</div>
    											</div>
    										</div>
    									</li>
                                    @endforeach
								</ul>
							</div>
                            @endif
						</div>
						
                        @if( isset($footer['support_online']) && $footer['support_online']->count()>0 )
                            @php
                                $transupport = $footer['support_online']->translationsLanguage()->first();
                            @endphp
    						<div class="side-bar">
                                <div class="title-sider-bar">
                                    {{ $transupport->name }}
                                </div>
    							<div class="support1">
    								<img src="{{ asset($footer['support_online']->image_path) }}">
                                    @foreach($footer['support_online']->childs()->where('active',1)->orderBy('order')->get() as $item)
                                        @php
                                            $supportItem = $item->translationsLanguage()->first();
                                        @endphp
        								<div class="support_in">
        									<h2>{{ $supportItem->name }}</h2>
        									<div class="support_in_in">
        										<img src="{{ asset($item->image_path) }}" alt="{{ $supportItem->name }}">
        										{{ $supportItem->slug }}
        									</div>
        								</div>
    								@endforeach
    							</div>
    						</div>
                        @endif
						@if (isset($dichvu)&&$dichvu)
								@foreach ($dichvu->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
								<div class="quang_cao_home">
									<a href="{{ $dichvu->slug }}">
										<img src="{{ asset($item->image_path) }}" alt="{{$item->name}}">
									</a>
								</div>
								@endforeach
							 @endif
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
