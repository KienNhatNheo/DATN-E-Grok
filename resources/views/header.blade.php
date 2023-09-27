<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>E-Grok</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/d69fb28507.js" crossorigin="anonymous"></script>
  </head>
  
  <body>
    //Cảnh báo đăng nhập
    @if(session('isLog') == null)
    <div class="alert alert-primary alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <a href="/login" class="alert-link">Đăng nhập</a> để có thể sử dụng nhiều chức năng hơn.
    </div>
    {{ session()->forget('isLog') }}
    @endif
    //Cảnh báo thay đổi mật khẩu
    @if(session('isChange') == 1)
    <div class="alert alert-success alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Thay đổi mật khẩu thành công!
    </div> 
    {{ session()->forget('isChange') }}
    @elseif(session('isChange') == 2)
    <div class="alert alert-danger alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Thay đổi mật khẩu thất bại do nhập sai mật khẩu hiện tại!
    </div>
    {{ session()->forget('isChange') }}
    @elseif(session('isChange') == 3)
    <div class="alert alert-danger alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Thay đổi mật khẩu thất bại do mật khẩu mới không khớp!
    </div>
    {{ session()->forget('isChange') }}
    @else
    @endif
    //Cảnh báo cập nhật thông tin
    @if(session('isUpdate') == 2)
    <div class="alert alert-success alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Cập nhật thành công!
    </div>
    {{ session()->forget('isUpdate') }}
    @elseif(session('isUpdate') == 1)
    <div class="alert alert-danger alert-dismissible fixed-bottom">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Cập nhật thất bại!
    </div>
    {{ session()->forget('isUpdate') }}
    @endif
    
  <!--header-->
  <header id="header" class="fixed-top">
    
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo me-auto"><a href="/
        ">E-Grok</a></h1>
      
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="#">Trang chủ</a></li>
          <li class="dropdown"><a href="#"><span>Sản phẩm</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Đồ chơi</a></li>
              <li class="dropdown"><a href="#"><span>Đồ gia dụng</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Sản phẩm vệ sinh</a></li>
                  <li><a href="#">Dụng cụ nhà bếp</a></li>
                  <li><a href="#">Đồ trang trí</a></li>
                  <li><a href="#">Khác</a></li>
                </ul>
              </li>
              <li><a href="/productType/Đồ ăn vặt">Đồ ăn vặt</a></li>
              <li><a href="#">Nước giải khát</a></li>
              <li><a href="#">Đồ dùng học tập</a></li>
              <li><a href="#">Khác</a></li>

            </ul>
          </li>
          @if(session()->has('curUser'))
          <li><a href="/history">Lịch sử mua hàng</a></li>
          @else
          <li><a href="/login">Lịch sử mua hàng</a></li>
          @endif
          <li><a href="/contribute">Đóng góp</a></li>
          <li style="padding-top:12px;padding-left:30px;padding-bottom:2px">
            <form action="/search_result" method="POST" class="d-flex">
              <input type="search" name="searchKey" placeholder="Tìm kiếm" class="form-control" style="min-width:100px">
              <button type="submit" style="background:none;border:none"><i class="fa fa-search"></i></button>
              @csrf
            </form>
          </li>
        </ul>
      </nav>

      <nav class="navbar order-last order-lg-0">
         <ul>
            <li><a href="/viewCart"><i class="fa fa-shopping-cart" style="font-size: 20px;"></i></a></li>
            @if( session('curAccess') == null)
            <li><a href="/login">Đăng nhập</a></li>
            @else
            <li><a href="/userInfo">{{ session('curAccess') }}</a></li>
            <li><a href="/logout"><i class="fa fa-sign-out" style="font-size: 20px;"></i></a></li>
            @endif  
         </ul>
       </nav>
   </div>
  
  </header>
  <!-- End Header -->
  <style>
    #header {
   background: linear-gradient(to right, #b3f9bd, #a8e5ed);
   transition: all 0.5s;
   z-index: 997;
   padding: 15px 0; 
   box-shadow: 0px 0 18px rgba(55, 66, 59, 0.08);
 }
 #header .logo {
   font-size: 30px;
   margin: 0;
   padding: 0;
   line-height: 1;
   font-weight: 600;
   letter-spacing: 1px;
   text-transform: uppercase;
   font-family: "Poppins", sans-serif;
 }
 
 #header .logo a {
   color: #f13ff1;
   text-decoration: none;
 }
 
 #header .logo img {
   max-height: 40px;
 }
 .navbar {
   padding: 0;
 }
 .active {
    color:blue;
 }
 .navbar ul {
   margin: 0;
   padding: 0;
   display: flex;
   list-style: none;
   align-items: center;
 }
 
 .navbar li {
   position: relative;
 }
 
 .navbar a,
 .navbar a:focus {
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 10px 0 10px 30px;
   font-family: "Poppins", sans-serif;
   font-size: 15px;
   font-weight: 500;
   color: #37423b;
   white-space: nowrap;
   transition: 0.3s;
   text-decoration: none;
 }
 
 .navbar a i,
 .navbar a:focus i {
   font-size: 12px;
   line-height: 0;
   margin-left: 5px;
 }
 
 .navbar a:hover,
 .navbar .active,
 .navbar .active:focus,
 .navbar li:hover>a {
   color: #711fec;
 }
 
 .navbar .dropdown ul {
   display: block;
   position: absolute;
   left: 30px;
   top: calc(100% + 30px);
   margin: 0;
   padding: 10px 0;
   z-index: 99;
   opacity: 0;
   visibility: hidden;
   background: #ecf9e3;
   box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
   transition: 0.3s;
   border-radius: 4px;
 }
 
 .navbar .dropdown ul li {
   min-width: 200px;
 }
 
 .navbar .dropdown ul a {
   padding: 10px 20px;
   font-size: 14px;
   text-transform: none;
   font-weight: 500;
 }
 
 .navbar .dropdown ul a i {
   font-size: 12px;
 }
 
 .navbar .dropdown ul a:hover,
 .navbar .dropdown ul .active:hover,
 .navbar .dropdown ul li:hover>a {
   color: #5fcf80;
 }
 
 .navbar .dropdown:hover>ul {
   opacity: 1;
   top: 100%;
   visibility: visible;
 }
 
 .navbar .dropdown .dropdown ul {
   top: 0;
   left: calc(100% - 30px);
   visibility: hidden;
 }
 
 .navbar .dropdown .dropdown:hover>ul {
   opacity: 1;
   top: 0;
   left: 100%;
   visibility: visible;
 }
 
 @media (max-width: 1366px) {
   .navbar .dropdown .dropdown ul {
     left: -90%;
   }
 
   .navbar .dropdown .dropdown:hover>ul {
     left: -100%;
   }
 }
   </style>