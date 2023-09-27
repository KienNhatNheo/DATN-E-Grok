<!-- Footer -->
<div class="mt-5" style="padding-left:10rem;padding-top:1rem;padding-bottom:1rem;background-color:rgb(216, 216, 216)">
  <h3>Từ khóa</h3>
  <div>
    @if(session()->has('searchHot'))
        @for($i = 0;$i<count(session('searchHot'));$i++)
      @if($i == 20) @break
      @endif
      <span><a style="text-decoration:none" href="/search/{{ session('searchHot')[$i] }}"><i>{{ session('searchHot')[$i] }}</i></a></span>
    @endfor
    @endif
    
  </div>
</div>
<footer class="text-center text-lg-start bg-white text-muted  pt-3" style="background: linear-gradient(to right, #a8e5ed, #b3f9bd">
    <!-- Section: Social media -->
    
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5" >
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3 text-secondary"></i>E-Grok
            </h6>
            <p>
              Website cửa hàng tạp hóa Trung Kiên. 
              Mục đích là công cụ giúp người dùng tiếp cận, khám phá cũng như mua sắm những sản phẩm phù hợp với nhu cầu hàng ngày.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Danh mục
            </h6>
            <p>
              <a href="#!" class="text-reset">Đồ gia dụng</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Đồ chơi</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Đồ dùng học tập</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Đồ ăn vặt</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Hữu ích
            </h6>
            <p>
              <a href="#!" class="text-reset">Diễn đàn mini</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Đóng góp</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Báo lỗi</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4" >
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Liên hệ</h6>
            <p><i class="fas fa-home me-3 text-secondary"></i> Xóm 6, thôn Lại Xá, Thanh Thủy, Thanh Hà, Hải Dương</p>
            <p>
              <i class="fas fa-envelope me-3 text-secondary"></i>
              Email: egrok@gmail.com
            </p>
            <p><i class="fas fa-phone me-3 text-secondary"></i>SĐT: + 03 788 640 01</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background:linear-gradient(to right, #98e998, #95e4a1">
      ©2023 Copyright:
      <a class="text-reset fw-bold" href="">KienAB</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->