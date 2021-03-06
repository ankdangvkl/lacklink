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
            <form action="{{ url('/link-edit') }}" method="post">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="linkName" value="{{ $linkName }}"/>
                </div>
                <div class="form-group"><input class="form-control" type="hidden" name="userAccount" value="{{ $userAccount }}"/></div>
                <div class="form-group"><input type="hidden" name="linkId" value="{{ $linkId }}"/></div>
                <div class="form-group"><a href="{{ url('/') }}" class="btn btn-primary btn-block" type="submit">Back</a></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Cập nhật</button></div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
