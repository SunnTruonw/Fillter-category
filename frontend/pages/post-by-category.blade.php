@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('css')
<style type="text/css">
    .wrap-breadcrumbs{
        margin-bottom: 0;
    }
    .title-template-in .title-inner{
        padding-top: 30px;
        display: none;
    }
</style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="main">
            @if ($category->id==13)

            @else
                @isset($breadcrumbs,$typeBreadcrumb)
                    @include('frontend.components.breadcrumbs',[
                        'breadcrumbs'=>$breadcrumbs,
                        'type'=>$typeBreadcrumb,
                    ])
                @endisset
            @endif
                <div class="block-news">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9 col-sm-12  block-content-right1">
								<h1 class="title-template-in">
                                    <span class="title-inner"> {{ $category->name??"" }} </span>
                                </h1>
                                @isset($data)
                                    <div class="wrap-list-news">
                                        <div class="list-card-news-horizontal">
                                            <div class="row">
                                                @foreach($data as $post_item)
                                                @php
                                                    $slug_post1 = explode('tin-tuc/', $post_item->slug);
                                                    $slug_post = implode($slug_post1);
                                                    // dd($slug_post1);
                                                    // $slug_post = $post_item->slug;
                                                @endphp
                                                <div class="col-card-news-horizontal col-sm-4">
                                                    <div class="card-news-horizontal card-news-horizontal-2">
                                                        <div class="box">
                                                            <div class="image">
                                                                <a href="{{ makeLink('post',$post_item->id, $slug_post) }}">
                                                                    <img src="{{ $post_item->avatar_path != null ? asset($post_item->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{$post_item->name}}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h3><a href="{{ makeLink('post', $post_item->id,$slug_post) }}">{{$post_item->name}}</a></h3>
                                                                 {{--<div class="date"><i class="far fa-calendar-alt"></i> {{ Illuminate\Support\Carbon::parse($post_item->created_at)->format('d/m/Y') }} - {{ __('post.dang_boi') }}</div>--}}
                                                                <div class="desc">
                                                                    {{$post_item->description}}
                                                                </div>
                                                               {{--<div class="text-right">
                                                                <a href="{{ makeLink('post',$post_item->id,$slug_post) }}" class="btn-viewmore btn btn-light"><i class="fas fa-angle-double-right"></i> {{ __('post.xem_them') }}</a>
                                                               </div>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @if (count($data))
                                            {{$data->appends(request()->all())->links()}}
                                            @endif
                                        </div>
                                    </div>
                                @endisset
                                @if ($category->content)
                                <div class="content-category" id="wrapSizeChange">
                                    {!! $category->content !!}
                                </div>
                                @endif
                            </div>
							<div class="col-lg-3 col-md-12 col-sm-12 col-12 block-content-left">
								@isset($sidebar)
								@include('frontend.components.sidebar',[
									"categoryProduct"=>$sidebar['categoryProduct'],
									"categoryPost"=>$sidebar['categoryPost'],
									"categoryProductActive"=>$categoryProductActive  ?? null,
									"postsHot"=>$sidebar['postsHot'],
									"support_online"=>$sidebar['support_online'],
									'fill'=>true,
									'product'=>true,
									'post'=>false,
								])
							@endisset
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

    })
</script>
@endsection
