@isset($data)
    @if (isset($data)&&$data->count() > 0)
            @foreach ($data as $product)
                <div class="feedback-item">
                    <div class="product-review p-y-24">
                        <div class="d-flex justify-between">
                            <div class="product-review-info">
                                <div class="product-review-info-header">
                                    <div class="review-info-header-nameandlocal">
                                        <div class="review-info-name">{{$product->name}}</div>
                                        <div class="review-info-location">
                                            <span>{{$product->address}}</span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="product-review-info-tooltip">
                                    <span>
                                        <button class="product-review-info-btn">Người mua đã xác minh</button>
                                    </span>
                                </h5>
                                @if($product->images && count($product->images) > 0)
                                    <div class="load-multiple-image">
                                        @foreach($product->images as $value)
                                            <img src="{{asset($value->image_path)}}" alt="{{$value->name}}">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="product-review-detail">
                                <div class="d-flex flex-wrap product-review-detail-top m-b-12 justify-between">
                                    <div class="d-flex justify-content-start rating-cout-review">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $product->star)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="fs-p-13">{{$product->created_at->format('d/m/Y')}}</div>
                                </div>
                                <div class="product-review-detail-cmt">
                                    <div class="product-user-comments">
                                        <span>{{$product->content}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-review-btn">
                                <div class="product-review-btn-box js-like" data-id="{{$product->id}}">
                                    <div class="product-review-content">
                                        <svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable" aria-hidden="true" data-hb-id="pl-icon"><path d="M21.81 11.44a2.73 2.73 0 00-1.87-.94h-2.52a4.63 4.63 0 000-3c-.67-1.85-1.63-2-2.5-2-1.05 0-1.21.76-1.31 1.27 0 .12 0 .25-.09.39a.5.5 0 000 .12 17.92 17.92 0 01-1.06 3.88s-.29.47-1.37.47a.5.5 0 00-.5-.5H6a.5.5 0 00-.5.5v9a.5.5 0 00.5.5h4.57a.5.5 0 00.49-.44c2.78 1.84 2.86 1.85 3 1.85h4.28a.57.57 0 00.18 0A5.13 5.13 0 0021 19.78c.33-.89 1.36-5.8 1.44-6.28a2.55 2.55 0 00-.63-2.06zm-11.74 8.65H6.5v-8h3.57zm11.41-6.77c-.1.61-1.11 5.35-1.41 6.12a4.31 4.31 0 01-1.78 2.06h-4.07c-.38-.22-1.87-1.19-2.88-1.87a.52.52 0 00-.27-.07v-6.93c1.71 0 2.21-.91 2.25-1a17.73 17.73 0 001.17-4.23c0-.15.07-.3.1-.43.1-.47.1-.47.35-.47.54 0 1.05 0 1.54 1.37a4.14 4.14 0 01-.11 2.68l-.09.33a.51.51 0 00.09.43.5.5 0 00.4.19h3.17a1.81 1.81 0 011.14.62 1.54 1.54 0 01.4 1.2z"></path></svg>
                                        <span class="product-review-content-txt">Thích</span>
                                        <span class="product-review-cout total-like-{{$product->id}}" data-like="{{$product->likes}}">{{$product->likes}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr data-hb-id="Divider" class="Divider__StyledDivider-sc-1dcsric-0 hsJGuc pl-Divider">
            @endforeach
            @else
                <h4 class="text-center empty__cate-title">Không có bình luận nào.</h4>
        @endif
@endisset
    
