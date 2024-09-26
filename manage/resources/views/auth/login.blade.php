@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center mr-3" style="margin-left: 20%; margin-top: 8% ">
        <div class="col-md-8">
		@if(Session::has('error'))
		<p class="alert
		{{ Session::get('alert-class', 'alert-danger' ) }}">{{Session::get('error') }}
		<!--<button type="button" class="close" data-dismiss="alert">×</button>-->
		</p>
		@endif
			@if(Session::has('success'))
		<p class="alert
		{{ Session::get('alert-class', 'alert-success' ) }}">{{Session::get('success') }}
		<button type="button" class="close" data-dismiss="alert">×</button>
		</p>
		@endif
            <div class="card d-flex justify-content-center" style="width: 70%">
                <div class="card-header d-flex justify-content-center">{{ __('Login') }}</div>

                <div class="card-body   ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating form-group mb-3">
                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating  form-gourp mb-2">
                            <input type="password" name="password" class="form-control  @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="floatingInput">Password</label>

                        </div>

                        <div class="d-flex jsutify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Password') }}
                                </label>
                            </div>
                            <div class="d-flex justify-content-end">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
