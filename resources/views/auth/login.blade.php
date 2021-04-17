@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center top-margin">
    <div class="col-md-4">
    <div class="authLogo">
        <img  src="{{ asset('imgs/payfriend_alt.png') }}" height="100" />
    </div>
    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card ">
  <div class="card-body">
    <form action="{{ route('login') }}" method="post"  >
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" >
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
    </form>
    <hr class="my-4">
    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg btn-block">Register</a>
    </div>
</div>
</div>
</div>
@endsection