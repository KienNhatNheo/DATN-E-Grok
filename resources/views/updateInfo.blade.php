@Include('header')

<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Cập nhật thông tin người dùng</h2>
<div class="container ml-2 mr-2">
    <div class="image col-6">

    </div>
    @foreach($info as $item)
    <div class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
        <form action="/updateInfo" method="POST">
            <table class="table table-hover table-borderless rounded">
                <tbody>
                  <tr class="rounded-top">
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Họ tên</td>
                    <td><input autofocus class="uIinput" style="background: none;width:500px;" type="text" name="usernamec" value="{{ $item->username }}"></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Số điện thoại</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="phonec" value="{{ $item->phone }}"></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Thư điện tử</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="emailc" value="{{ $item->email }}"></td>
                  </tr>
                  <tr>
                      <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Địa chỉ</td>
                      <td><input class="uIinput" style="background: none;width:500px;" type="text" name="addressc" value="{{ $item->address }}"></td>
                    </tr>
                </tbody>
              </table>
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
