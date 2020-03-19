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
      <span class="count_top"><i class="fa fa-user"></i>Traffic bán hàng</span>
      <div class="count green">2,500</div>
      {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> --}}
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Traffic BOT</span>
      <div class="count">4,567</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>
    {{-- <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i>Block rate</span>
      <div class="count">2,315</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div> --}}
  </div>
