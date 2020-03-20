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
<br />
<div class="row dashboard_graph">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fake link</th>
            {{-- <th scope="col">Trạng thái</th> --}}
            {{-- <th scope="col">Actions</th> --}}
          </tr>
        </thead>
        <tbody>
            @if($data != null)
            @if($data['fakeLinks'] != null)
                @foreach ($data['fakeLinks'] as $key => $value)
                @foreach ($value as $key => $value)
                    <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                    </tr>
                @endforeach
                @endforeach
            @endIf
            @endIf
        </tbody>
      </table>
    </div>
