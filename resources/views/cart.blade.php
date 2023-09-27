@Include('header')
<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Giỏ hàng</h2>
@if($cart == null)
<div style="margin-top:10rem;margin-bottom:10rem;text-align:center;color:rgb(184, 186, 188);font-size:20px">Không có sản phẩm nào</div>
@else

<table class="rounded table-striped table-bordered table-hover" style="margin-left:20%;margin-right:20%;width:60%">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Số lượng sản phẩm</th>
            <th>Giá sản phẩm(đ)</th>
            <th>Xóa sản phẩm</th>
        </tr>
    </thead>
    <tbody>
        @for($i = 0;$i < count($cart);$i++)
            @if(session()->has('curUser'))
                @if($cart[$i][1] == $cartItem[$i][0])
                    <tr>
                        <td>{{ $cartItem[$i][1] }}</td>
                        <td style="display:flex;justify-content:center"><img class="p-1" src="{{ $cartItem[$i][2] }}" alt="" style="width:5rem;height:5rem;"></td>
                        <td id="proQuantity">{{ $cart[$i][2] }}</td>
                        <td id="proPrice">{{ number_format($cartItem[$i][3], 0, '.', '.') }}</td>
                        <td><a href="/removeFromCart/{{ $cart[$i][0] }}"><button style="width:5.5rem" class="btn btn-danger">Xóa</button></a></td>
                    </tr>
                @endif
            @else
                @if($cart[$i][0] == $cartItem[$i][0])
                <tr>
                    <td>{{ $cartItem[$i][1] }}</td>
                    <td style="display:flex;justify-content:center"><img class="p-1" src="{{ $cartItem[$i][2] }}" alt="" style="width:5rem;height:5rem;"></td>
                    <td id="proQuantity">{{ $cart[$i][1] }}</td>
                    <td id="proPrice">{{ number_format($cartItem[$i][3], 0, '.', '.') }}</td>
                    <td><a href="/removeFromCart/{{ $i }}"><button style="width:5.5rem" class="btn btn-danger">Xóa</button></a></td>
                </tr>
                @endif
            @endif 
        @endfor
    </tbody>
    <tfoot style="background-color: aliceblue;padding:1rem">
        <tr style="padding: 2rem">
            <td style="padding: 2rem">Tổng tiền</td>
            <td></td>
            <td></td>
            <td id="cartSum">{{ number_format($sum, 0, '.', '.') }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>

<div class="d-flex" style="margin-left:20%;margin-right:20%;width:60%;margin-top:3rem">
    <div style="width:50%">
        <div style="text-align:center;font-size:1.6rem;margin-top:1.4rem;margin-bottom:1.4rem">Thông tin đơn hàng</div>
        <table>
            <tr>
                <td style="text-align:left">Giá sản phẩm </td>
                <td style="text-align:left">+{{ number_format($sum, 0, '.', '.') }}đ</td>
            </tr>
            <tr>
                <td style="text-align:left">Phí vận chuyển</td>
                @if($sum > 150000)
                <td style="text-align:left">+0đ</td>
                @else
                <td style="text-align:left">+{{ number_format(30000, 0, '.', '.') }}đ</td>
                @endif
            </tr>
            <tr style="font-size: 1.3rem;font-weight:bold">
                <td style="text-align:left">Tổng</td>
                @if($sum > 150000)
                <td style="text-align:left;margin-left:1rem">{{ number_format($sum, 0, '.', '.') }}đ</td>
                @else
                <td style="text-align:left;margin-left:1rem">{{ number_format($sum + 30000, 0, '.', '.') }}đ</td>
                @endif
            </tr>
        </table>
    </div>
    <div style="width:50%;padding-top:4rem">
        <form action="/purchase" method="POST">
            <select class="form-control" name="payBy" >
                <option value="Sau khi nhận hàng">Sau khi nhận hàng</option>
                <option value="">Thanh toán trực tuyến*</option>
                <option value="Thanh toán tại cửa hàng">Thanh toán tại cửa hàng</option>
            </select>
            @if(isset($address))
            @foreach($address as $item)
            <input style="width:100%;margin-top:1rem;padding:0.3rem;border:none" type="text" name="address" value="{{ $item->address }}">
            @endforeach
            @endif
            <input type="hidden" value="{{ $sum }}" name="priceSum">
            <button type="submit" style="width:100%;margin-top:1rem;" class="btn btn-primary">Mua hàng</button>
            @csrf
        </form>
        
    </div>
</div>
@endif
@Include('footer')
</body>
<style>
    td {
        padding: 0.5rem;
        text-align:center;
    }
    th {
        text-align:center;
        padding:1rem;
    }
</style>