@if( isset($dataStatus) && $dataStatus->count()>0 )
    <table>
        <thead>
            <tr class="cart-table-header">
                <td>STT</td>
                <td>Tên sản phẩm</td>
                <td>Số lượng</td>
                <td>Tổng tiền</td>
                <td>Trạng thái</td>
            </tr>
        </thead>
        <tbody>
            @foreach($dataStatus as $key => $value)
                @foreach($value->orders as $item)
                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            <a class="cart-top-thumb-img thumb-cover" href="{{$item->product->slug_full}}">
                                <img src="{{asset($item->product->avatar_path)}}" alt="{{$item->name}}" />
                            </a>

                            <a class="cart-title-pro" href="{{$item->product->slug_full}}">{{$item->product->name}} </a>
                            @if(isset($value->color_name) || isset($value->size_name))
                            <span class="cart-title-pro">Phân loại hàng: {{$value->color_name ?? '' }},{{$value->size_name ?? ''}}</span>
                            @endif
                        </td>
                        <td class="cart-title-pro">
                            {{$item->quantity}}
                        </td>
                        <td class="cart-title-pro">
                            @php
                                $total = $item->new_price * $item->quantity;
                            @endphp
                            {{number_format($item->new_price, 0, ',', '.')}} * {{$item->quantity}} = {{number_format($total, 0, ',', '.')}} VNĐ
                        </td>
                        <td class="cart-title-pro">
                            @include('admin.components.status',[
                                'dataStatus'=>$value,
                                'listStatus'=>$listStatus,
                            ])
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <div class="cboth"></div>
@else
    Không có đơn nào...
@endif