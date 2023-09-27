@Include('header')
<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Lịch sử mua hàng</h2>
@if($history == null)
<div style="margin-top:10rem;margin-bottom:10rem;text-align:center;color:rgb(184, 186, 188);font-size:20px">Không có đơn hàng nào</div>

@else
@foreach ($history as $item)
<div class="d-flex mb-5" style="margin-left:5%;margin-right:5%;">
    <div style="margin-left:5%">
        <table>
            <tr>
                <td style="text-align:left">Mã đơn hàng</td>
                <td style="text-align:left">{{ $item->orderCode }}</td>
            </tr>
            <tr>
                <td style="text-align:left">Số tiền thanh toán</td>
                <td style="text-align:left">{{ $item->orderPrice }}</td>
            </tr>
            <tr>
                <td style="text-align:left">Ngày đặt hàng</td>
                <td style="text-align:left">{{ $item->time }}</td>
            </tr>
        </table>
        @if($item->isReceive == 0)
        <a href="/received/{{ $item->orderCode }}"><button class="btn btn-success" style="width:100%;margin-top:2rem">Đã nhận được hàng</button></a>
        @endif
    </div>
    <table class="rounded table-striped table-bordered table-hover" style="margin-left:5%;width:60%;background-color:aliceblue">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh sản phẩm</th>
                <th>Số lượng sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Đánh giá</th>
            </tr>
        </thead>
        <tbody>
        @foreach($productInOrder as $item1)
            @if ($item1->purchaseCode == $item->orderCode)
            <tr>
                <td>{{ $item1->product_name }}</td>
                <td style="display:flex;justify-content:center"><img class="p-1" src="{{ $item1->product_image }}" alt="" style="width:5rem;height:5rem;"></td>
                <td>{{ $item1->purchaseQuantity }}</td>
                <td>{{ $item1->product_price }}</td>
                @if ($item->isReceive == 0)
                    <td></td>
                @else
                    @if($item1->isEval == 0)
                        <td><a href="/evaluate/{{ $item1->product_id }}"><button class="btn btn-success">Đánh giá</button></a></td>
                    @else
                        <td><a href=""><button class="btn btn-danger" disabled>Đã đánh giá</button></a></td>
                    @endif
                @endif
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    
</div>
@endforeach
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