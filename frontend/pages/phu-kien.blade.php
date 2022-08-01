@extends('frontend.layouts.main')

@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')
    <div class="content-wrapper">
        <div class="main">
            <div class="text-left wrap-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumbs-item">
                                    <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                                </li>
                                @foreach ($breadcrumbs as $item)
                                @if ($loop->last)
                                <li class="breadcrumbs-item active"><a href="{{ makeLink($typeBreadcrumb,$item['id']??'',$item['slug']??'') }}" class="currentcat">{{ $item['name'] }}</a></li>
                                @else
                                    @if($item['id'] == 2)                                    
                                    @else
                                        <li class="breadcrumbs-item"><a href="{{ makeLink($typeBreadcrumb,$item['id']??'',$item['slug'])??'' }}" class="currentcat">{{ $item['name'] }}</a></li>
                                    @endif
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{dd($category->file)}} --}}
            @if ($category->file)
			<div class="video_box">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="video_slide">
								<video controls muted autoplay>
									  <source src="{{ asset($category->file) }}" type="video/mp4">
								</video>
							</div>
						</div>
					</div>
				</div>
			</div>
            @endif      
            <div class="block-product" style="margin-top:30px">
				<div class="phukien_box">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-sm-12  block-content-right">
								<div class="group-title">
									<div class="title title-img">{{ $category->name }}</div>
								</div>
								@if($category->parent_id == 169)
								<div class="wrap-fill">
								<div class="form-group">
									<select name=""  class="form-control field-change-link" >
									@foreach($category->childs as $item)
										<option value="{{route('product.productByCategory',[$item->slug])}}">{{ $item->name }}</option>
									@endforeach
									</select>
								</div>
								</div>
								@endif                            
								@isset($sidebar)
									@include('frontend.components.sidebar-1',[
									   // "categoryProduct"=>$sidebar['categoryProduct'],
										// "categoryPost"=>$sidebar['categoryPost'],
										'category'=>$category,
										"categoryProductActive"=>$categoryProductActive,
										'fill'=>true,
										'product'=>true,
										'post'=>false,
									])
								@endisset

								@if ($category->content)
								<div class="content-category" id="wrapSizeChange">
									{!! $category->content !!}
								</div>
								@endif

								@isset($data)
									<div class="wrap-list-product" id="dataProductSearch">
										<div class="list-product-card">
											<div class="row">
												@if (isset($data)&&$data)
													@foreach ($data as $product)
														@php
															$tran=$product->translationsLanguage()->first();
															$link=$product->slug_full;
														@endphp
														<div class="col-product-item col-lg-3 col-md-4 col-sm-6 col-6">
															<div class="product-item">
																<div class="box">
																	<div class="image">
																		<a href="{{ $link }}">
																			<img src="{{ asset($product->avatar_path) }}" alt="{{ $tran->name }}">
																			@if ($product->old_price)
																				<span class="sale"> {{  ceil(100 - ($product->old_price/$product->price)*100)." %"}}</span>
																			@endif
																			{{-- @if($product->baohanh)
																				<div class="km">
																					{{ $product->baohanh }}
																				</div>
																			@endif --}}
																		</a>
																	</div>
																	<div class="content">
																		<div class="sao">
																			<i class="fa-solid fa-droplet" aria-hidden="true" style="color:rgb(250, 243, 3)"></i>
																			<i class="fa-solid fa-droplet" aria-hidden="true" style="color:rgb(192, 192, 192)"></i>
																			<i class="fa-solid fa-droplet" aria-hidden="true" style="color:rgb(0, 0, 0)"></i>
																		</div>
																		<div class="many_color">
																			<ul>
																				@if($product->color)
																				<li><a href="{{ $link }}"><i class="fas fa-tint" style="color: #{{ $product->color}};"></i></a><span class="tooltip__content">{{ $product->size }}</span></li>
																				@endif
																				@if($product->options->count()>0)
																				@foreach ($product->options as $color)
																				<li><a href="{{ $link }}"><i class="fas fa-tint" style="color: #{{ $color->color  }};"></i></a><span class="tooltip__content">{{ $color->size }}</span></li>
																				@endforeach
																				@endif
																			</ul>
																		</div>
																		<h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                                        @if(isset($tran->title))
                                                                        <div class="box_title_in">
                                                                            {{$tran->title}}
                                                                        </div>
                                                                        @endif
																		<div class="box-price">
																			<span class="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</span>
																			@if ($product->old_price>0)
																				<span class="old-price">{{ $unit  }} {{ number_format($product->old_price) }} </span>
																			@endif
																		</div>
																		<!-- <div class="dathang">
																			<a class="add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}">Đặt hàng ngay</a>
																		</div> -->
																	</div>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>
										</div>
										<div class="col-md-12">
											@if (count($data))
											{{$data->appends(request()->all())->onEachSide(1)->links()}}
											@endif
										</div>
									</div>
								@endisset

							   {{-- @endif --}}
								{{-- end make --}}

							</div>
						</div>
					</div>
				</div>
            </div>
            @php
                $listIdCatePhuKien = collect($listIdCatePhuKien);
                $checkCatePhuKien = $listIdCatePhuKien->contains($category->id);

            @endphp
            @if(!$checkCatePhuKien)
                @if(isset($listPhuKien) && $listPhuKien->count()>0 )
                <div class="wrap_phukien">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="group_title_left">
                                    <div class="title">
                                        Phụ kiện {{ $listPhuKien->first()->supplier->name }}
                                    </div>
                                    <div class="view_all">
                                        <a href="{{ $listPhuKien->first()->category->slug_full }}">
                                            Xem thêm
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="row">
                                    <div class="list_phukien autoplay6_phukien category-slide-1 category-slide-2">

                                        @foreach($listPhuKien as $item)
                                        <div class="item">
                                            <div class="box_item">
                                                <div class="image">
                                                    <a href="{{ $item->slug_full }}">
                                                        <img src="{{ asset($item->avatar_path) }}" alt="{{ $item->name }}">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <h3>
                                                        <a href="{{ $item->slug_full }}">
                                                            {{ $item->name }}
                                                        </a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endif
            <form action="#" method="get" name="formfill" id="formfill" class="d-none">
                @csrf
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).on('change','.field-form',function(){
          // $( "#formfill" ).submit();
           let contentWrap = $('#dataProductSearch');
            let urlRequest = '{{ url()->current() }}';
            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                }
            });
        });
        $(document).on('change','.field-change-link',function(){
          // $( "#formfill" ).submit();

           let link=$(this).val();
           if(link){
               window.location.href=link;
           }
        });
        // load ajax phaan trang
        $(document).on('click','.pagination a',function(){
            event.preventDefault();
            let contentWrap = $('#dataProductSearch');
            let href=$(this).attr('href');
            //alert(href);
            $.ajax({
                type: "Get",
                url: href,
            // data: "data",
                dataType: "JSON",
                success: function (response) {
                    let html = response.html;

                    contentWrap.html(html);
                }
            });
        });
    });
</script>
@endsection
