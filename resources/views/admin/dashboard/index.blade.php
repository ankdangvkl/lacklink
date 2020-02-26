@extends('dashboard.index')

@section('admin')
    <div class="main_container">
        {{-- sidebar menu --}}
        @include('admin/dashboard/side-bar')
        {{-- /sidebar menu --}}
        {{-- top navigation --}}
        {{-- @include('common.topnav') --}}
        @include('admin/dashboard/top-nav')
        {{-- /top navigation --}}
        {{-- page content --}}
        @include('admin.dashboard.list-users')
        {{-- /page content --}}
    </div>
@endsection
