@Include('header')

<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem"></h2>
@foreach($info as $item)
<div class="container mr-6 d-flex" >
    <div class="">
      <img class="img-fluid" style="width:500px;height:500px" src='{{ $item->product_image }}'/>
    </div>
  
    <div class="col-6 background-primary">
        <h2 class="">{{ $item->product_name }}</h2>
        <div>
            <span>Đánh giá: {{ $item->product_rating }}/5 </span>|
            <span>Số lượt đánh giá: {{ count($comment) }} </span>|
            <span>Số hàng đã bán: {{ $item->product_sold }} </span>
        </div>
        @if($item->product_discount != 0)
        <div class="mt-3" style="font-size:2.4rem;font-weight:bold">
          <span><del>{{ number_format($item->product_price, 0, '.', '.') }}</del></span>
          <span> - </span>
          <span>{{number_format(round($item->product_price*(100-$item->product_discount)/100,0), 0, '.', '.')  }}</span>
          <span class="badge badge-primary rounded p-2">-{{ $item->product_discount }}%</span>
        </div>
        @else
          <div class="mt-3" style="font-size:2.4rem;font-weight:bold">{{ number_format($item->product_price, 0, '.', '.') }}</div>
        @endif
        <form action="/addToCart" method="POST" class="mt-3">
          <span onclick="down()" class="border rounded pl-3 pr-3 pt-1 pb-1" >-</span>
          <input 
            class="rounded pl-3 pr-3 pt-1 pb-1" 
            style="width:4rem;border:1px solid rgb(216,216,216)" 
            id="pro_quantity" 
            type="text" 
            name="pro_quantity" 
            value="0"
          >
          <span onclick="up()" class="border rounded pl-3 pr-3 pt-1 pb-1">+</span>
          <br>
          <input type="hidden" name="pro_id" value="{{ $item->product_id }}">
          <input class="btn btn-primary mt-2" type="submit" value="Thêm vào giỏ hàng">
          @csrf
        </form>
        <div>
          <script>
            const quantity = document.getElementById('pro_quantity');
            function down(){
              quantity.value--;
              if(quantity.value < 0) quantity.value = 0;
            }
            function up(){
              quantity.value++;
            }
          </script>
        </div>
    </div>
    
    
</div>
<div class="rounded" style="margin-left:7rem;margin-top:3rem;background-color:aliceblue;margin-right:7rem;padding:2rem">
  <h3>Chi tiết sản phẩm</h3>
  <pre>{{ $item->product_detail }}</pre>
</div>
@endforeach
<div class="rounded" style="margin-left:7rem;margin-top:3rem;background-color:rgb(237, 246, 216);margin-right:7rem;padding:2rem">
  <h3>Một số đánh giá về sản phẩm ({{ count($comment) }})</h3>
  <div>
    <table class="table-striped table-bordered table-hover">
      @foreach ($comment as $item)
        <tr>
          <td style="font-weight:bold;width:10rem">{{ $item->username }}</td>
          <td>{{ $item->comment }}</td>
        </tr>
        <tr>
          <td colspan="2" style="width:70rem"><i>{{ $item->commentTime }}</i> - Số điếm đánh giá : {{ $item->ratePoint }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
<div class="rounded" style="margin-left:7rem;margin-top:3rem;background-color:rgb(219, 248, 233);margin-right:7rem;padding:2rem;">
  <h3>Sản phẩm cùng loại</h3>
  <div class="d-flex">
    @foreach($sameTypeProduct as $item)
        <div class="card m-2" style="width: 18rem;">
          <img src="{{ $item->product_image }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $item->product_name }}</h5>
            @if($item->product_discount != 0)
            <span><del>{{ $item->product_price }} VNĐ</del></span>
            <span>-</span>
            <span>16.000 VNĐ</span>
            @else
            <div>{{ $item->product_price }} VNĐ</div>
            @endif
            <a href="/product_info/{{ $item->product_id }}" class="btn btn-primary">Xem chi tiết</a>
          </div>
        </div>
        @endforeach
  </div>
</div>
<div class="rounded" style="margin-left:7rem;margin-top:3rem;background-color:rgb(250, 210, 237);margin-right:7rem;padding:2rem">
  <h3>Sản phẩm mua kèm</h3>
  <div class="d-flex">
    @for($i = 0;$i < count($infoPop);$i++)
  <div class="card m-2" style="width: 18rem;">
    <img src="{{ $infoPop[$i][5] }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $infoPop[$i][1] }}</h5>
      @if($infoPop[$i][3] != 0)
      <span><del>{{ $infoPop[$i][2] }} VNĐ</del></span>
      <span>-</span>
      <span>16.000 VNĐ</span>
      @else
      <div>{{ $infoPop[$i][2] }} VNĐ</div>
      @endif
      <a href="/product_info/{{ $infoPop[$i][0] }}" class="btn btn-primary">Xem chi tiết</a>
    </div>
  </div>
  @endfor
  </div>
</div>
@Include('footer')
</body>
