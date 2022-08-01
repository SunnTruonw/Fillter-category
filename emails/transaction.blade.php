<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin liên hệ</title>
</head>

<body>
    <div class="wrap-email">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Thông tin mua hàng từ Kena</h1>
                    <ul>
                        <li>Họ tên: {{ $transaction->name }}</li>
                        <li>Số điên thoại: {{ $transaction->phone }}</li>
                        <li>Số điện thoại nhận hàng: {{ $transaction->phone_order }}</li>
                        <li>Địa chỉ: <br> {{ $transaction->address_detail }}, {{ $transaction->commune->name }}, {{ $transaction->district->name }}, {{ $transaction->city->name }} (nhân viên sẽ gọi xác nhận trước khi giao).</li>
                        <li>Hình thức thanh toán: 
                            @if($transaction->httt === 145)
                                Thanh toán khi nhận HÀNG
                            @elseif($transaction->httt === 146)
                                Thanh toán tiền mặt tại cửa hàng
                            @else
                                Thanh toán bằng thẻ ATM
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>