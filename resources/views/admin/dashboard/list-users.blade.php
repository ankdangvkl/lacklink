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
            <th scope="col">#</th>
            <th scope="col">Tên tài khoản</th>
            <th scope="col">Tên người dùng</th>
            <th scope="col">Email</th>
            <th scope="col">Tổng click</th>
            <th scope="col">Số dư</th>
            <th scope="col">Ngày thanh toán</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Trạng thái</th>
            <th scope="col" style="width: 20%;">Action</th>
          </tr>
        </thead>
        <tbody>
                @if($listUser == null)
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @else
                @for ($i = 0; $i < count($listUser); $i++)
                <tr>
                    <th scope="row">{{ $listUser[$i]['id'] }}</th>
                    <td>{{ $listUser[$i]['name'] }}</td>
                    <td>{{ $listUser[$i]['clicks'] }}</td>
                    <td>{{ $listUser[$i]['payAmount'] }}</td>
                    <td>{{ $listUser[$i]['clicks'] }}</td>
                    <td>{{ $listUser[$i]['clicks'] }}</td>
                    <td>{{ $listUser[$i]['payAmount'] }}</td>
                    <td>{{ $listUser[$i]['clicks'] }}</td>
                    <td>
                    @if($listUser[$i]['status'] == 1)
                        <span class="btn btn-info">Active</span>
                    @else
                      <span class="btn btn-danger">Deactive</span>
                    @endif
                    </td>
                    <td style="width: 15%;">
                        @if($listUser[$i]['status'] == 0)
                            <a class="btn btn-info" href="{{ url('user-status-update/' . $listUser[$i]['id']) }}">Active</a>
                        @endIf
                        @if($listUser[$i]['status'] == 1)
                            <a class="btn btn-danger" href="{{ url('user-status-update/' . $listUser[$i]['id']) }}">Deactive</a>
                        @endIf
                    </td>
                </tr>
                @endfor
                @endIf
        </tbody>
      </table>
    </div>
</div>
