
<div class="list-product-card">
    <div class="row">
        @php
                $unit = 'đ';
        @endphp
        @if (isset($data)&& count($data) > 0)
            @foreach ($data as $product)
                @php
                    $tran=$product->translationsLanguage()->first();
                    $link=$product->slug_full;
                @endphp
                <div class="col-min-1500 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="grid__column three-twelfths mobile--one-half slick-slide slick-active">
                        <div class="product-grid product not-sale-tag">
                            <div class="product-grid__thumbnail">
                                <div  class="product-grid__image ">
                                    <a href="{{ $link }}">
                                        @if($product->options)
                                        @php
                                            $optionIsStock = $product->options()->where('stock',1)->orderBy('order')->first();
                                        @endphp
                                                <img class="big-image" src="{{ asset($optionIsStock->avatar_type)}}" alt="{{ $product->name }}">
                                            <img class="has-hover" src="{{asset($optionIsStock->hover_path)}}" alt="{{ $optionIsStock->name }}" >
                                        @endif
                                    </a>    
                                </div> 
                                
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
                                                        <i class="star-bold fas fa-star"></i>
                                                    @else
                                                            <i class="star-bold far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <div class="reviews-rating__number">({{$product->stars()->count()}} đánh giá)</div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="product-grid__reviews">
                                            <div class="reviews-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="star-bold far fa-star"></i>
                                                @endfor
                                                <div class="reviews-rating__number">(chưa có đánh giá)</div>
                                            </div>
                                        </div>
                                    @endif
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
        @else
            <h4 class="text-center empty__cate-title">Bạn chưa xem sản phẩm nào...</h4>
        @endif
    </div>
</div>