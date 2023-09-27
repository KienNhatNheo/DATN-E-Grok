@Include('header')

<h2 class="product_info_title" style="margin-top:6rem;text-align:center;margin-bottom:2rem">Đổi mật khẩu</h2>
<div class="container ml-2 mr-2">
    <div class="image col-6">

    </div>
    <div class="table-responsive ml-3 mr-3 container table" style="display:flex;justify-content:center;align-items:center;">
        <form action="/changePassword" method="POST">
            <table class="table table-hover table-borderless rounded">
                <tbody>
                  <tr class="rounded-top">
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Mật khẩu hiện tại</td>
                    <td><input autofocus class="uIinput" style="background: none;width:500px;" type="text" name="curPass"></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(221, 220, 218);padding:0.5rem 1.2rem">Số điện thoại</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="newPass"></td>
                  </tr>
                  <tr>
                    <td style="background-color: rgb(195, 185, 185);padding:0.5rem 1.2rem">Thư điện tử</td>
                    <td><input class="uIinput" style="background: none;width:500px;" type="text" name="confirm_newPass"></td>
                  </tr>
                </tbody>
              </table>
              <input style="width:100%" type="submit" value="Cập nhật" class="button bt-primary uIinput">
              
              @csrf
        </form>
      </div>
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
