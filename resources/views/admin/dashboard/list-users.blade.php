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
            <th scope="col">Account user</th>
            <th scope="col">Số lượt click còn</th>
            <th scope="col">Trạng thái tài khoản</th>
            <th scope="col" style="width: 20%;"></th>
          </tr>
        </thead>
        <tbody>
                @if($listUser == null)
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td  style="width: 20%;"><a class="btn btn-secondary" href="#">Chi tiết</a><a class="btn btn-info" href="">Active</a><a class="btn btn-danger" href="">Deactive</a></td>
                </tr>
                @else
                @for ($i = 0; $i < count($listUser); $i++)
                <tr>
                    <th scope="row">{{ $listUser[$i]->id }}</th>
                    <td>{{ $listUser[$i]->name }}</td>
                    <td>Otto</td>
                    <td>
                    @if($listUser[$i]->status == 1)
                        Active
                    @else
                        Deactive
                    @endif
                    </td>
                    <td style="width: 20%;">
                        <a class="btn btn-secondary" href="{{ url('user-detail/' . $listUser[$i]->id) }}">Chi tiết</a>
                        @if($listUser[$i]->status == 0)
                            <a class="btn btn-info" href="{{ url('user-active/' . $listUser[$i]->id) }}">Active</a>
                        @endIf
                        @if($listUser[$i]->status == 1)
                            <a class="btn btn-danger" href="{{ url('user-deactive/' . $listUser[$i]->id) }}">Deactive</a>
                        @endIf
                    </td>
                </tr>
                @endfor
                @endIf
        </tbody>
      </table>
    </div>
</div>
