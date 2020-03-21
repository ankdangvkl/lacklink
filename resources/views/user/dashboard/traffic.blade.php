<div class="tile_count">
    <div class="col-md-2 col-sm-4 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i>Tổng click</span>
      <div class="count @if($data['clicks'] == 0) red @else green @endif">{{ $data['clicks'] }}</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Số dư</span>
      <div class="count @if($data['payAmount'] == 0) red @else green @endif">{{ $data['payAmount'] }}</div>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Tổng thanh toán</span>
      <div class="count green">{{ $data['totalPay'] }}</div>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Ngày thanh toán gần nhất</span>
      <div class="count">{{ $data['latestPayDay'] }}</div>
    </div>
    {{-- <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Block rate</span>
      <div class="count">2,315</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div> --}}
  </div>
