@extends('layouts.app')

@section('content')

<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
					<span class="login100-form-title p-b-34">
						Connectez-vous
					</span>
					@error('email')
                            <span class="txt2" role="alert">
                    			<small class="text-danger">{{ $message }}</small>
                            </span>
                    @enderror
					@error('password')
                        <span class="invalid-feedback" role="alert">
                			<small class="text-danger">{{ $message }}</small>
                        </span>
                    @enderror
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email">
						<input id="first-email" class="input100" type="email" name="email" placeholder="Adresse mail" value="{{ old('email') }}" autofocus>
						<span class="focus-input100"></span>
                        
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
						<span class="focus-input100"></span>

					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Connexion
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Un oublie?
						</span>

						<a href="{{ route('password.request') }}" class="txt2">
							Adresse mail / mot de passe?
						</a>
					</div>

					<div class="w-full text-center">
						
					</div>
				</form>

				<div class="login100-more" style="background-image: url({{ asset('assets/img/nav-font2.jpg')}});"></div>
			</div>
		</div>
 @endsection
