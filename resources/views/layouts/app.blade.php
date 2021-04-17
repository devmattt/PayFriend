
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <title>PayFriend</title>
    </head>
    <body>
    @if (auth()->user())
  
    <div class="logo">
        <a class="navbar-brand mx-auto" href="#"><img  src="{{ asset('imgs/payfriend.png') }}" /></a>
    </div>
   
    <div class="logout">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-dark">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        </button>
    </form>
    </div>
              
 @endif


        <div class="container">
            @yield('content')
        </div>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
    @if (auth()->user())
    <footer>
        &copy; 2021 PretendPayments Co.
    </footer>
    @endif
</html>