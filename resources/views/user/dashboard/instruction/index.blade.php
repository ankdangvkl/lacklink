@extends('dashboard.index')

@section('user-instruction')
    <div class="main_container">
        {{-- sidebar menu --}}
        @include('user/dashboard/side-bar')
        {{-- /sidebar menu --}}
        {{-- top navigation --}}
        {{-- @include('common.topnav') --}}
        @include('user/dashboard/top-nav')
        {{-- /top navigation --}}
        {{-- page content --}}
        <div class="right_col" role="main">
        @include('user/dashboard/instruction/content')
        </div>
        {{-- /page content --}}
    </div>
@endsection
