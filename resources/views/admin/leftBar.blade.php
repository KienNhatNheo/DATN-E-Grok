@foreach(session('adminInfo') as $item)
      <div id="menubar" class="d-flex" style="width:18%;background-color:rgb(229, 236, 245);position: fixed;">
        <div style="width:3%;background-color:blue;height:715px"></div>
        <div class="admin_header" >
          <div class="d-flex" style="margin:1rem">
            <div style="width:4rem;height:4rem;border-radius:2rem;overflow:hidden;">
              <img style="width:4rem;height:4rem" src="https://us.123rf.com/450wm/anatolir/anatolir2011/anatolir201105528/159470802-jurist-avatar-icon-flat-style.jpg?ver\u003d6" alt="">
            </div>
            <div style="padding:1rem">
              {{ $item->username }}
            </div>
          </div>
          <div class="pt-4 pl-4 pb-1 d-flex" style="align-items:center">
            <div class="fa fa-phone"></div>
            <div class="" style="margin-left:1rem">{{ $item->phone }}</div>
          </div>
          <div class="pt-1 pl-4 pb-1 d-flex" style="align-items:center">
            <div class="fa fa-envelope"></div>
            <div class="" style="margin-left:1rem">{{ $item->email }}</div>
          </div>
          <div class="pt-1 pl-4 pb-1 d-flex" style="align-items:center">
            <div class="fa fa-map-marker"></div>
            <div class="" style="margin-left:1rem">{{ $item->address }}</div>
          </div>

          <h3 style="text-align:center;margin-top:1.5rem">Tác vụ</h3>
          <div class="mt-1 pl-4 pt-2 pb-2 d-flex bg-info" style="align-items:center;color:white;cursor:pointer">
            <div class="fa fa-user"></div>
            <a style="text-decoration:none;color:white" href="/admin/userManage"><div class="" style="margin-left:1rem;">Quản lí người dùng</div></a>
          </div>
          <div class="pt-2 pl-4 pt-2 pb-2 d-flex " style="align-items:center;background-color:rgb(120, 139, 98);color:white;cursor:pointer">
            <div class="fa fa-car"></div>
            <a style="text-decoration:none;color:white" href="/admin/productManage"><div class="" style="margin-left:1rem;">Quản lí sản phẩm</div></a>
          </div>
          <div class="pt-2 pl-4 pt-2 pb-2 d-flex" style="align-items:center;background-color:rgb(81, 107, 133);color:white;cursor:pointer">
            <div class="fa fa-shopping-cart"></div>
            <a style="text-decoration:none;color:white" href="/admin/orderManage"><div class="" style="margin-left:1rem;">Các đơn hàng chờ</div></a>
          </div>
          <div class="pt-2 pl-4 pt-2 pb-2 d-flex" style="align-items:center;background-color:rgb(173, 126, 182);color:white;cursor:pointer">
            <div class="fa fa-calendar-alt"></div>
            <a style="text-decoration:none;color:white" href="/admin/historyManage"><div class="" style="margin-left:1rem;">Lịch sử bán hàng</div></a>
          </div>
          <div class="pl-4 pt-2 pb-2 d-flex" style="align-items:center;margin-top:14rem;cursor:pointer">
            <div class="fa fa-sign-out"></div>
            <a style="text-decoration:none;color:black" href="/admin/logout"><div class="" style="margin-left:1rem">Đăng xuất</div></a>
          </div>
        </div>
      @endforeach
      <hr>
      </div>