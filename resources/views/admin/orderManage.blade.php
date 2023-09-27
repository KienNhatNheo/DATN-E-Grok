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
        <h3 style="margin-top:3rem;margin-bottom:3rem;text-align:center">Quản lí đơn hàng</h3>
        <table class="rounded table-striped table-bordered table-hover" style="margin-left:5%;margin-right:5%;width:90%">
            <thead>
                <th>Mã đơn hàng</th>
                <th>Giá đơn hàng</th>
                <th>Địa chỉ nhận hàng</th>
                <th>Thời gian</th>
                <th>Phương thức thanh toán</th>
                <th>Chi tiết đơn hàng</th>
                <th>Gửi hàng</th>
            </thead>
            <tbody>
                @foreach($order as $item)
                    <tr>
                        <td>{{ $item->orderCode }}</td>
                        <td>{{ $item->orderPrice }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->time }}</td>
                        <td>{{ $item->payMethod }}</td>
                        <td><a href="/admin/orderDetail/{{ $item->orderCode}}"><button class="btn btn-success">Chi tiết</button></a></td>
                        <td><a href="/admin/acceptOrder/{{ $item->orderCode }}"><button class="btn btn-info">Xác nhận gửi hàng</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="display:flex;justify-content:center;margin-top:2rem">
            {{ $order->links() }}   
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
</style>