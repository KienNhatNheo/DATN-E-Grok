@Include('header')
<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">{{ $key }}</h2>


<div class="d-flex justify-content-center flex-wrap" >
@foreach($product as $item)
@if($item->product_display == 1)
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
@endif
@endforeach
</div>
<div style="display:flex;justify-content:center;margin-top:3rem">
    {{ $product->links() }}
</div>

<!--End Product-->
@Include('footer')
</body>
