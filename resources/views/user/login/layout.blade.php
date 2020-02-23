@extends('common.login')

@section('user_title')
<h1>Login(User)</h1>
@endsection

@section('user_form_begin')
<form method="post" action="{{ url('/user/dashboard') }}">
@endsection
