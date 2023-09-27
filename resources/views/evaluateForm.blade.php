@Include('header')

<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Đánh giá sản phẩm</h2>
<div class="container ml-2 mr-2">
    <div class="image col-6">

    </div>
    @foreach($product_info as $item)
    <table class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
      <tr>
        <td rowspan="2"><img src="{{ $item->product_image }}" style="width:5rem;height:5rem" alt=""></td>
        <td>
          <div>Tên sản phẩm: {{ $item->product_name }}</div>
          <span>Giá gốc sản phẩm: {{ $item->product_price }}</span>
          <span class="badge badge-primary">{{ $item->product_discount }}</span>
          <div>Chi tiết sản phẩm: {{ $item->product_detail }}</div>
          <div>Đánh giá sản phẩm : {{ $item->product_rating }}</div>
        </td>
      </tr>
    </table>
    <div class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
        <form action="/evaluate_handle" method="POST">
            <table class="table table-hover table-borderless rounded">
                <tbody>
                  <tr class="rounded-top">
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Số điểm đánh giá</td>
                    <td>
                      <input 
                      autofocus 
                      class="uIinput" 
                      style="background: none;width:500px;" 
                      type="text" 
                      name="point" >
                    </td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Đánh giá</td>
                    <td>
                      <input class="uIinput" 
                      style="background: none;width:500px;" 
                      type="text" 
                      name="comment">
                    </td>
                  </tr>                   
                    <td></td>
                </tbody>
              </table>
              <input type="hidden" value="{{ $item->product_id }}" name="eval_id">
              <input style="width:100%" type="submit" value="Cập nhật" class="button bt-primary uIinput">
              @csrf
        </form>
    </div>
    @endforeach
</div>

@Include('footer')
</body>
<style>
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
