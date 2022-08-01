
@php
$unit="đ";
$i = 0;
@endphp
<div class="cart-wrapper">
<table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th class="stt_css">STT</th>
        <th class="hinhanh_img">Hình ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>

        @foreach($data as $cartItem)
            @php
                $i++;
            @endphp
        <tr class="cart-item">
            <td class="cart-stt" style="text-align: center;" data-title="STT">
                <span>{{ $i }}</span>
            </td>
            <td class="cart-image" data-title="Hình ảnh:">
               <div class="image">
                <img src="{{ $cartItem['avatar_path'] }}" alt="{{ $cartItem['name'] }}" >
                @if ($cartItem['sale'])
                <span class="badge badge-pill badge-danger position-absolute sale-cart">{{ $cartItem['sale']}}%</span>
                @endif
               </div>
            </td>
            <td class="cart-name" data-title="Tên sản phẩm:">
                <span>
                    {{ $cartItem['name'] }} 
                    {{ isset($cartItem['color_name'])?'('.$cartItem['color_name'].')':'' }}
                    {{ isset($cartItem['size_name'])?'('.$cartItem['size_name'].')':'' }}
                </span>
            </td>
            <td class="cart-quantity" data-title="Số lượng:">
                <div class="quantity-cart">
                    <div class="box-quantity text-center">
                        <span class="prev-cart">-</span>
                        <input class="number-cart" data-url="{{ route('cart.update',[
                            'id'=> $cartItem['id'],
                            'color_id'=>$cartItem['color_id'],
                            'size_id'=>$cartItem['size_id'],
                            ]) }}" value="{{ $cartItem['quantity']}}" type="number" id="" name="quantity" disabled="disabled">
                        <span class="next-cart">+</span>
                    </div>
                </div>
            </td>
            <td class="cart-price" data-title="Đơn giá:">
                <div class="box-price">
                    <span class="new-price-cart">{{ number_format($cartItem['price']) }} {{ $unit }}</span>
                    @if ($cartItem['sale'])
                    <span class="old-price-cart">{{ number_format($cartItem['price']) }}  {{ $unit }}</span>
                    @endif
                </div>
            </td>
            <td class="cart-price" data-title="Thành tiền:">
                <div class="box-price">
                    <span class="new-price-cart">{{ number_format($cartItem['totalPriceOneItem']) }} {{ $unit }}</span>
                    @if ($cartItem['sale'])
                    <span class="old-price-cart">{{ number_format($cartItem['totalOldPriceOneItem']) }}  {{ $unit }}</span>
                    @endif
                </div>
            </td>
            <td class="cart-action" data-title="Xóa:">
                <a data-url="{{ route('cart.remove',[
                    'id'=> $cartItem['id'],
                    'color_id'=>$cartItem['color_id'],
                    'size_id'=>$cartItem['size_id'],
                    ]) }}" class="remove-cart"><i class="fas fa-times-circle delete-option" data-tab="{{$cartItem['id']}}"></i></a>
            </td>
        </tr>
        @endforeach
        <tr>
          <td colspan="7">
            <div class="d-flex justify-content-end align-item-center pt-1 pb-1">
                <a data-url="{{ route('cart.clear') }}" class="clear-cart btn btn-danger destroy-option">Xóa tất cả</a>
            </div>
          </td>
        </tr>
    </tbody>
    <tfoot>
        <tr style="border: unset;">
            <td colspan="7" style="border: unset;">
                <div class="wrap-area">
                    <a href="{{ route('home.index') }}" class="buy-more btn btn-light">Tiếp tục mua hàng</a>
                    <div class="area-total">
                        <div class="total d-flex align-items-center justify-content-between">
                            <span class="name">Tổng giá trị đơn hàng:</span>
                            <span class="total-price">{{ number_format($totalPrice) }} {{ $unit }}</span>
                        </div>
                        @isset($totalOldPrice)
                        @if ($totalPrice!=$totalOldPrice)
                        <div class="total-provisional d-flex align-item-center justify-content-end">
                            <span class="total-provisional-price">{{ number_format($totalOldPrice )}} {{ $unit }}</span>
                        </div>
                        @endif
                        @endisset
                        <div class="total-provisional d-flex align-item-center justify-content-end">
                            <span class="name">Tổng <strong>{{ $totalQuantity }}</strong> sản phẩm</span>
                        </div>
                        
                        {{-- @if (isset($data) && $data)
                            <div class="voucher-input active">
                                <div class="voucher-input_wrap u-flex wapperInputVourcher">
                                    <form id="formSendVourcher" action="" method="get">
                                        @csrf
                                        <div class="form-group m-r-8">
                                            <input type="text" class="form-input form-input-lg inputVourcher desk" placeholder="Nhập mã giảm giá" name="coupon" maxlength="30" value="">
                                        </div>
                                        <div class="voucher-btn">
                                            <button type="submit" class="btn btn-primary sendVourcher">
                                                <span>Áp dụng</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="appendMessageVourcher"></div>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>


</div>

{{-- <script>
    $(function(){
        $("#formSendVourcher").submit(function(e) {
            e.preventDefault();
            let urlRequest = '{{route('cart.checkCoupon')}}';
            let data=$("#formSendVourcher").serialize();

            console.log(urlRequest, data);
            $.ajax({
                url : urlRequest,
                data : data,
                method : 'get',
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        console.log('html', html);
                        // contentWrap.html(html);
                    }
                }
            })
        })
    })
</script> --}}
