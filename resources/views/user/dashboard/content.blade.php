<div class="row">
    <div class="col-md-12 col-sm-12 x_title dashboard_graph">
        @include('user.dashboard.traffic')
        <div class="clearfix"></div>
    </div>
    <div class="col-md-12 col-sm-12 x_title dashboard_graph">
        <div class="row ">
            <div class="col-md-6">
                <h3>Tên miền</h3>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@if (isset($msg))
<div class="alert alert-success">
{{ $msg }}
</div>
@endif
<br />
<div class="row dashboard_graph">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fake link</th>
            {{-- <th scope="col" style="width: 7%;">Trạng thái</th> --}}
            {{-- <th scope="col" style="width: 10%;">Actions</th> --}}
            <th scope="col" style="width: 10%;"></th>
          </tr>
        </thead>
        <tbody>
            @if($data != null)
            @if($data['fakeLinks'] != null)
                @php $i = 1 @endphp
                @foreach ($data['fakeLinks'] as $key => $value)
                @foreach ($value as $key => $value)
                    <tr>
                    <td scope="col">{{ $i++ }}</td>
                    <td scope="col">{{ $value }}</td>
                    {{-- <td scope="col" style="width: 7%;">
                        <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Kích hoạt</span>
                    </td> --}}
                    <td scope="col" style="width: 10%;">
                        <a href="{{ url('/link-edit/' . $data['name'] . '/' . $key)}}">
                            <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Chỉnh sửa</span>
                        </a>
                        <a href="{{ url('/link-remove/' . $data['name'] . '/' . $key)}}">
                            <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Xoá</span>
                        </a>
                    </td>
                    </tr>
                @endforeach
                @endforeach
            @endIf
            @endIf
        </tbody>
      </table>
    </div>
