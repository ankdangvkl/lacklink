<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 dashboard_graph x_title">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Danh sách người dùng</h3>
                    </div>
                </div>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row dashboard_graph">
    <table class="table">
        <thead>
          <tr>
            <th scope="col"  style="width:2%">#</th>
            {{-- <th scope="col">Tên tài khoản</th> --}}
            <th scope="col">Tên người dùng</th>
            <th scope="col">Tai khoan nguoi dung</th>
            {{-- <th scope="col" width="400px;">Liên kết đến Facebook</th> --}}
            <th scope="col">Số click còn</th>
            <th scope="col">Trạng thái hiện tại</th>
            {{-- <th scope="col" style="width: 7%;">Action</th> --}}
            <th scope="col" style="width:110px;"></th>
            <th scope="col" style="width:100px;"></th>
          </tr>
        </thead>
        <tbody>
                @if($listUser == null)
                <tr>
                    <th scope="row"></th>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                </tr>
                @else
                @foreach ($listUser as $user)
                <tr>
                    <th scope="row" style="width:2%">{{ $user['id'] }}</th>
                    {{-- <td scope="row">{{ $user['name'] }}</td> --}}
                    <td scope="row">{{ $user['username'] }}</td>
                    <td scope="row">{{ $user['userAccount'] }}</td>
                    {{-- <td scope="row" width="400px;">{{ $user['address'] }}</td> --}}
                    <td scope="row">{{ $user['clicks'] }}</td>
                    <td scope="row">
                    @if($user['status'] == 1)
                        <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Kích hoạt</span>
                    @else
                      <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Vô hiệu hoá</span>
                    @endif
                    </td>
                    <td scope="row" style="width:110px;">
                        @if($user['status'] == 0)
                            <a href="{{ url('user-status-update/' . $user['id']) }}">
                                <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Kích hoạt</span>
                            </a>
                        @endIf
                        @if($user['status'] == 1)
                            <a href="{{ url('user-status-update/' . $user['id']) }}">
                                <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Vô hiệu hoá</span>
                            </a>
                        @endIf

                    </td>
                    <td scope="row" style="width:100px;">
                        <a href="{{ url('show-add-click/' . $user['id']) }}">
                            <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Nap click</span>
                        </a>
                    </td>
                </tr>
                @endforeach
                @endIf
        </tbody>
      </table>
    </div>
</div>
