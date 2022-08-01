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


                <div class="wrap-ykkh" style="background: unset;">
                    <div class="container">
                        <div class="row">
                            @if (isset($data)&&$data)
                            <div class="col-12 col-sm-12">
                                <div class="group-title">
                                    <div class="title title-img">{{ $data->name }}</div>
                                    <div class="img-title">
                                        <img src="{{ asset('frontend/images/bg-title.png') }}" alt="">
                                    </div>
                                    <div class="desc-title2">
                                         {!! $data->description !!}
                                    </div>
                                </div>
								<div class="col-12 col-sm-12">
									<div class="list-ykkh row">
										 @foreach ($data->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                                    @php
                                        $tran=$item->translationsLanguage()->first();
                                    @endphp
										<div class="col-lg-4 col-md-4 col-sm-6 col-12">
											<div class="col-ykkh-item1">
												<div class="item-ykkh">
													<div class="nd_ykien">
														{!! $tran->description !!}
													</div>
													<div class="box">
														<img src="{{ asset($item->image_path) }}" alt="{{ $tran->name }}">
													</div>
													<div class="box_right">
														<h2>{{ $tran->name }}</h2>
														<p>{{ $tran->slug }}</p>
													</div>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

        </div>
    </div>

    {{-- <script>
        $(function() {
            $("#form-contact").submit(function(event) {
                if ($("#agree").prop("checked")) {
                    return true
                } else {
                    alert("{{ __('bao-gia.ban_phai_dong_y') }}");
                    return false;
                }
            });
        });
    </script> --}}


@endsection
@section('js')

@endsection
