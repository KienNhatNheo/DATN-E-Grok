@Include('header')
<!--Banner-->
<div class="banner container-fluid mt-5 pt-5 mb-4">
   <div class="text-center bg-image rounded-3" style="
    background-image: url('https://vinatech.net.vn/images/images/cua-hang-tap-hoa-co-cac-mau-ke-gan-tuong-an-tuong-compressed.jpg');
    height: 400px;
  ">
  <div class="mask" style="background-color: rgba(211, 207, 207, 0.6);">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="text-dark">
        <h1 class="mb-3">Cửa hàng tạp hóa E-Grok</h1>
        <h4 class="mb-3">Mọi thứ đều có thể đáp ứng ở đây</h4>
        <a class="btn btn-outline-info btn-lg rounded-4 mt-5 text-dark" href="#product">Mua hàng ngay!</a>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid" style="background:linear-gradient(to right, #b3f9bd, #a8e5ed">
   <div class="p-5" style="position:absoluted;text-align:center;font-size:30;font-weight:bold;color:orange">
      Miễn phí giao hàng với đơn hàng từ 150.000 VNĐ
   </div>
</div>
<!--End Banner-->
<!--Product-->
<div id="product" class="product">
   <!--Countdown Product-->
   <div class="cd-product">
      <div class="mt-4 ml-5 mb-5" style="font-style:italic;font-family: Arial;font-weight:bold;font-size:40;color:linear-gradient(to right,#a8e5ed,#b3f9b">
         Sản phẩm giảm giá
         <img src="https://png.pngtree.com/png-vector/20220622/ourmid/pngtree-fire-flame-logo-template-vector-icon-png-image_5271237.png" style="width:4rem;height:3rem" alt="">
      </div>
      <div class="d-flex justify-content-center flex-wrap" >
        @foreach($product_discount as $item)
        @if ($item->product_display == 1)
        <div class="card m-2" style="width: 18rem;">
          <img src="{{ $item->product_image }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $item->product_name }}</h5>
            @if($item->product_discount != 0)
            <span><del>{{ $item->product_price }} VNĐ</del></span>
            <span>-</span>
            <span>16.000 VNĐ</span>
            @else
            <div>{{ $item->product_price }} VNĐ</></div>
            @endif
            <a href="/product_info/{{ $item->product_id }}" class="btn btn-primary">Xem chi tiết</a>
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="mt-4  mr-4 ml-4" style="text-align:center;font-family:Arial;font-size:1rem;">
        <a href="" class="bg-primary p-2 rounded" style="text-decoration:none;width:2rem;color:white">Xem tất cả</a>
      </div>  
    </div>


    <div class="cd-product">
      <div class="mt-4 ml-5 mb-5" style="font-style:italic;font-family: Arial;font-weight:bold;font-size:40;color:linear-gradient(to right,#a8e5ed,#b3f9b">
         Sản phẩm hot
         <img src="https://png.pngtree.com/png-vector/20220622/ourmid/pngtree-fire-flame-logo-template-vector-icon-png-image_5271237.png" style="width:4rem;height:3rem" alt="">
         
      </div>
      <div class="d-flex justify-content-center flex-wrap" >
        @foreach($product_hot as $item)
        @if ($item->product_display == 1)
        <div class="card m-2" style="width: 18rem;">
          <img src="{{ $item->product_image }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{ $item->product_name }}</h5>
            @if($item->product_discount != 0)
            <span><del>{{ $item->product_price }} VNĐ</del></span>
            <span>-</span>
            <span>16.000 VNĐ</span>
            @else
            <div>{{ $item->product_price }} VNĐ</></div>
            @endif
            <a href="/product_info/{{ $item->product_id }}" class="btn btn-primary">Xem chi tiết</a>
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="mt-4  mr-4 ml-4" style="text-align:center;font-family:Arial;font-size:1rem;">
        <a href="" class="bg-primary p-2 rounded" style="text-decoration:none;width:2rem;color:white">Xem tất cả</a>
      </div>
    </div>

    <div class="cd-product">
      <div class="mt-4 ml-5 mb-5" style="font-style:italic;font-family: Arial;font-weight:bold;font-size:40;color:linear-gradient(to right,#a8e5ed,#b3f9b">
         Sản phẩm mới
         <img src="https://png.pngtree.com/png-vector/20220622/ourmid/pngtree-fire-flame-logo-template-vector-icon-png-image_5271237.png" style="width:4rem;height:3rem" alt="">
         
      </div>
      <div class="d-flex justify-content-center flex-wrap" >
        @foreach($product_new as $item)
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
      <div class="mt-4  mr-4 ml-4" style="text-align:center;font-family:Arial;font-size:1rem;">
        <a href="" class="bg-primary p-2 rounded" style="text-decoration:none;width:2rem;color:white">Xem tất cả</a>
      </div>
    </div>
   
</div>
<!--End Product-->
@Include('footer')
</body>





