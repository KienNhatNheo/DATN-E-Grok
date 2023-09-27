<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <section class="login-block">
        <div class="container">
        <div class="row">
            <div class="col-md-5 login-sec">
                <h2 class="text-center">Đăng ký</h2>
                <form class="login-form" action="/register" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Tên đầy đủ người dùng" name="fullname" required autofocus>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder=" Xác nhận mật khẩu" name="confirmPassword" required>
      </div>
      
        <div class="form-check">
        <button type="submit" class="btn btn-login float-right">Đăng ký</button>
        @csrf
      </div>
      
    </form>
    <div class="copy-text">Quay lại <a href="/login" class="text-primary">Đăng nhập</a></div>
    </div>
            <div class="col-md-7 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
        </div>
                </div>	   
                
            </div>
        </div>
    </div>
    </section> 
      
</body>
<style>
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
    .login-block{
        background: linear-gradient(to bottom, #3ed653, #1caec2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        height: 721px;
        padding : 90px 0;
    }
    .banner-sec{background:url(https://vtv1.mediacdn.vn/thumb_w/650/2020/7/2/thuongmaidientu-1582167219338-15936574070891981558646.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
    .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
    .carousel-inner{border-radius:0 10px 10px 0;}
    .carousel-caption{text-align:left; left:5%;}
    .login-sec{padding: 50px 30px; position:relative;}
    .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
    .login-sec .copy-text i{color:#FEB58A;}
    .login-sec .copy-text a{color:#E36262;}
    .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #0f1010;}
    .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
    .btn-login{background: #DE6262; color:#fff; font-weight:600;}
    .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
    .banner-text h2{color:#fff; font-weight:600;}
    .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
    .banner-text p{color:#fff;}
</style>