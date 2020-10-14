@extends('layouts.app')

@section('content')
<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('password.confirm') }}" method="POST">
                    @csrf
					<span class="login100-form-title p-b-34">
						Confirmer votre mot de passe avant de continuer
					</span>
                   
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
						<span class="focus-input100"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                			<small class="text-danger">{{ $message }}</small>
                        </span>
                         @enderror
					</div>

					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Confirmer
						</button>
					</div>

                    @if (Route::has('password.request'))
					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
						</span>
						<a href="{{ route('password.request') }}" class="txt2">
                        Mot de passe oublié?
						</a>
					</div>
                    @endif

					<div class="w-full text-center">
						<a href="{{ route('register') }}" class="txt3">
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url({{ asset('assets/img/nav-font2.jpg')}});"></div>
			</div>
		</div>
 @endsection
