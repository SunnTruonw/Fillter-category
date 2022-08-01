@isset($data)
    @if (isset($data)&&$data->count() > 0)
            @foreach ($data as $product)
                @php
                    $unit = 'đ';
                    $tran=$product->translationsLanguage()->first();
                    $link=$product->slug_full;
                @endphp
                <div class="box-search-item fleft">
                    <a class="box-search-img thumb-cover" href="{{$link}}">
                        <img src="{{asset($product->avatar_path)}}" alt="{{$product->name}}" />
                    </a>
                    <div class="box-search-info">
                        <h3 class="box-search-name">
                            <a href="{{$link}}">{{$product->name}}</a>
                        </h3>
                        <div class="box-search-price">
                            @if($product->old_price > 0 )
                            <span class="pro-item-price-ins">{{number_format($product->old_price, 0, ',', '.') }}đ</span>
                            <span class="pro-item-price-del">{{number_format($product->price, 0, ',', '.') }}đ</span>
                            @else
                            <span class="pro-item-price-ins">{{number_format($product->price, 0, ',', '.') }}đ</span>
                            @endif
                        </div>
                    </div>
                    <div class="cboth"></div>
                </div>
            @endforeach
            @else
                <div id="search-loader" class="search-loader" style="width: 48px; height: 48px; display : none"></div>
                <h4 class="text-center empty__cate-title">Không tìm thấy sản phẩm phù hợp</h4>
        @endif
@endisset
    
