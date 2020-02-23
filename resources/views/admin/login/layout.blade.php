@extends('common.login')

@section('admin_title')
<h1>Login(Admin)</h1>
@endsection

@section('admin_form_begin')
<form method="post" action="{{ url('/admin/dashboard') }}">
@endsection
