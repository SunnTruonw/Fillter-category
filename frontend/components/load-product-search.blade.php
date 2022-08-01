@isset($data)
    {{-- @if (isset($countProduct)&&$countProduct)
        <h2 class="count-search">{{ __('home.co') }} {{ $countProduct??0 }} {{ __('home.ket_qua_tim_kiem_voi_tu_khoa') }}</h2>
    @else
    <h2 class="count-search">{{ __('home.khong_tim_thay_san_pham') }}</h2>
    @endif --}}
    <div class="list-product-card">
        <div class="row">
            @if (isset($data)&&$data)
                @foreach ($data as $product)
                    @php
                        $tran=$product->translationsLanguage()->first();
                        $link=$product->slug_full;
                    @endphp
                    <div class="col-min-1500 col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="grid__column three-twelfths mobile--one-half slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0">
                            <div data-product-id="62a82c5bedcfe5596a2c471c" class="product-grid product not-sale-tag">
                                <div class="product-grid__thumbnail">
                                    <div  class="product-grid__image ">
                                        <a href="{{ $link }}" tabindex="0" class="">
                                            @if($product->options)
                                            @php
                                                $optionIsStock = $product->options()->where('stock',1)->orderBy('order')->first();
                                            @endphp
                                                    <img class="big-image" src="{{ asset($optionIsStock->avatar_type)}}" alt="{{ $product->name }}">
                                                <img class="has-hover" src="{{asset($optionIsStock->hover_path)}}" alt="{{ $optionIsStock->name }}" >
                                            @endif
                                        </a>    
                                    </div> 
                                    @if($product->stars()->count()>0)
                                        <div class="product-grid__reviews">
                                            <div data-review-count="215" data-review-avg="5" class="reviews-rating">
                                                @php
                                                    $avgRating = 0;
                                                    $sumRating = array_sum(array_column($product->stars()->where('active', 1)->get()->toArray(), 'star'));
                                                    $countRating = count($product->stars()->where('active', 1)->get());
                                                    if ($countRating != 0) {
                                                        $avgRating = $sumRating / $countRating;
                                                    }
                                                @endphp
                                                @for($i = 1; $i <= 5; $i++)

                                                    @if($i <= $avgRating)
                                                        <div class="reviews-rating__star is-active"></div> 
                                                    @else
                                                    @endif
                                                @endfor
                                                <div class="reviews-rating__number">({{$product->stars()->count()}})</div>
                                            </div>
                                        </div>
                                    @endif 
                                    <div class="product-grid__content">
                                        @if($product->options)
                                        @php
                                            $h = 0;
                                        @endphp
                                        <div class="product-grid__options">
                                            <div data-option-id="tshirt_color" class="options-color">
                                                @foreach($product->options()->orderBy('order')->get() as $item)
                                                    @if($item->stock)
                                                        @php
                                                            $h++;
                                                        @endphp
                                                        <div rel-script="option-color-change" data-value="mix-mau-{{$h}}" class="option-color__item" >
                                                            <span class="checkmark @if($h == 1) active @endif" style="background-color: {{$item->color}};" data-url="{{asset($item->avatar_type)}}"></span>
                                                        </div>
                                                    @endif 
                                                @endforeach
                                            </div>
                                        </div> 
                                        @endif
                                        
                                        <h3 class="product-grid__title">
                                            <a href="{{ $link }}" rel-script="product-title" tabindex="0">
                                            {{ $product->name }}
                                            </a>
                                        </h3> 
                                        <div class="product-grid__prices">
                                            <div rel-script="product-price" class="product-prices">
                                                @if($product->price && $product->old_price > 0)
                                                    <span style="color: red; margin-left: 5px;">-{{ceil(100 -($product->price)*100/($product->old_price))}}%</span>
                                                    <del id="old-price">{{ number_format($product->old_price) }}{{ $unit }}</del> 
                                                @endif
                                                    <ins id="new-price">{{ $product->price?number_format($product->price)." ".$unit:"Liên hệ" }}</ins>
                                            </div>
                                        </div>
                                        @if(isset($product->coupons) && $product->coupons()->count() > 0)
                                            @php
                                                $coupon = $product->coupons->first();
                                            @endphp
                                                <span class="product-grid__hint">
                                                    <div><span class="product-pricing-hint text--primary">{{$coupon->name ?? ''}}</span></div>
                                                </span>
                                            @endif
                                    </div>
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
            {{$data->appends(request()->all())->links()}}
        @endif
    </div>
@endisset
