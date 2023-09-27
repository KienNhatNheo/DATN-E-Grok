<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>E-Grok Admin</title>
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
    <div class="d-flex">
      @include('admin.leftBar');
      <div style="width:82%;margin-left:18%">
        <h3 style="margin-top:3rem;margin-bottom:3rem;text-align:center">Thêm sản phẩm</h3>
    <div class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
        <form action="/admin/addProduct" method="POST">
            <table class="table table-hover table-borderless rounded">
                <tbody>
                  <tr class="rounded-top">
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Tên sản phẩm</td>
                    <td><input autofocus class="uIinput" style="background: none;width:500px;" type="text" name="aproductName"></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Giá sản phẩm</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductPrice" ></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Hình ảnh</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductImage" ></td>
                  </tr>
                  <tr>
                      <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Giảm giá</td>
                      <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductDiscount"></td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Phân loại</td>
                        <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductType"></td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Sản phẩm có sẵn</td>
                        <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductAvailable"></td>
                      </tr>
                      <tr>
                        <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Mô tả</td>
                        <td><input class="uIinput" style="background: none;width:500px;" type="text" name="aproductDetail" ></td>
                      </tr>
                </tbody>
              </table>
              <input style="width:100%" type="submit" value="Thêm sản phẩm" class="button bt-primary uIinput">
              
              @csrf
        </form>
      </div>

                             
      </div>
    </div>
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
  .table {
  width: 100%;
  border-collapse: collapse;
}

.uIinput {
  border:none;
  outline:none;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}

.table-borderless td,
.table-borderless th {
  border: none;
}

.button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.bt-primary {
  background-color: #007bff;
}

.background-primary {
  background-color: #007bff;
  text-decoration: none;
}
</style>