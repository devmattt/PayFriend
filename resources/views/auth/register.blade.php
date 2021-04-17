@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center top-margin">
    <div class="col-md-4">
    <div class="authLogo">
        <img  src="{{ asset('imgs/payfriend_alt.png') }}" height="100" />
    </div>
    @if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <div class="card ">
  <div class="card-body">
    <form action="{{ route('register') }}" method="post"  >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name"  value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Your Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
    </form>
    <hr class="my-4">
    <a href="{{ route('login') }}" class="btn btn-secondary btn-lg btn-block">Login</a>
    </div>
</div>
</div>
</div>
@endsection