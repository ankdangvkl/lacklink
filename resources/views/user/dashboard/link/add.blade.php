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
            <form action="{{ url('/link-add') }}" method="post"> {{-- TO-DO add url /link-add/{name}/{id} --}}
              @csrf
              <div class="form-group">
                </span><input class="form-control" type="text" name="linkId" placeholder="Fake link id" value="{{ $idNewLink }}">
            </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="linkName" placeholder="Fakelink">
                </div>
                <input type="hidden" name="userAccount" value="{{ $userAccount }}">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-block" type="submit">Back</a><button class="btn btn-primary btn-block" type="submit">Thêm</button>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
