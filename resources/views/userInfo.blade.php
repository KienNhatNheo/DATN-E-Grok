@Include('header')
<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Thông tin người dùng</h2>
<div class="container ml-2 mr-2">
    <div class="image col-6">

    </div>
    @foreach($info as $item)
    <div class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
        <div>
            <table class="table table-hover table-borderless rounded">
                <tbody>
                  <tr class="rounded-top">
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">
                      Họ tên
                    </td>
                    <td class="uIinput" style="background: none;width:500px;">
                      {{ $item->username }}
                    </td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">
                      Số điện thoại
                    </td>
                    <td class="uIinput" style="background: none;width:500px;">
                      {{ $item->phone }}
                    </td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">
                      Thư điện tử
                    </td>
                    <td class="uIinput" style="background: none;width:500px;">
                      {{ $item->email}}
                    </td>
                  </tr>
                  <tr>
                      <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">
                        Địa chỉ
                      </td>
                      <td class="uIinput" style="background: none;width:500px;">
                        {{ $item->address }}
                      </td>
                    </tr>
                </tbody>
              </table>
              
              <a href="/updateInfo" style="text-decoration:none:text-align:center">
                <button class="bg-primary rounded p-3" style="color:white;border:none;width:25%;margin-left:20%;margin-right:10%">Cập nhật</button>
              </a>
              <a href="/changePassword" style="text-decoration:none">
                <button class="bg-primary rounded p-3" style="color:white;border:none;width:25%;">Đổi mật khẩu</button>
              </a>
        </div>
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