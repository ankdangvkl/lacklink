<div class="row">
    <div class="col-md-12 col-sm-12  dashboard_graph">
        <p style="font-size:20px;" class="red">Click con: {{ $userData['clicks'] }}</p>
        <a href="{{ url('/link-add/' . $userData['userAccount']) }}" aria-haspopup="true" aria-expanded="false">
            <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;margin-top:10px;">Thêm fakelink</span>
        </a>
        <div class="clearfix"></div>
    </div>
</div>
<br />
<div class="row dashboard_graph">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Key</th>
            <th scope="col">Fake link</th>
            <th scope="col">So luot truy cap</th>
            <th scope="col" style="width: 10%;"></th>
          </tr>
        </thead>
        <tbody>
            @if($userData != null)
            @if($userData['fakeLinks'] != null)
                @foreach ($userData['fakeLinks'] as $key => $value)
                    <tr>
                    <td scope="col">{{ $key }}</td>
                    <td scope="col">{{ $value }}</td>
                    <td scope="col">{{ $userData[$key] }}</td>
                    <td scope="col" style="width: 10%;">
                        <a href="{{ url('/link-edit/' . $userData['userAccount'] . '/' . $key)}}">
                            <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Chỉnh sửa</span>
                        </a>
                        <a href="{{ url('/link-remove/' . $userData['userAccount'] . '/' . $key)}}">
                            <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Xoá</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            @endIf
            @endIf
        </tbody>
      </table>
    </div>
