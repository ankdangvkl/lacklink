<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Common App Styles --}}
        {{-- {{ Html::style(mix('assets/app/css/app.css')) }} --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    </head>
    <body>
        <div class="login-dark">
            <form>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            @foreach ($user as $item => $value)
            <div class="form-group"><p class="form-control">{{ $value }}</p></div>
            @endforeach
            <div class="form-group"><a href="{{ url('/') }}" class="btn btn-primary btn-block">Back</a></div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
