@extends('layouts.app')

@section('content')

<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
					<span class="login100-form-title p-b-34">
						Changer le mot de passe
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email">
						<input id="first-email" class="input100" type="email" name="email" placeholder="Adresse mail" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                    			<small class="text-danger">{{ $message }}</small>
                            </span>
                        @enderror
					</div>
                



					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
						<span class="focus-input100"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                			<small class="text-danger">{{ $message }}</small>
                        </span>
                         @enderror
					</div>


					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirmer" required autocomplete="new-password">
						<span class="focus-input100"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                			<small class="text-danger">{{ $message }}</small>
                        </span>
                         @enderror
					</div>

                   
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Envoyer mail de validation
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
						</span>

						<a href="{{ route('password.request') }}" class="txt2">
						</a>
					</div>

					<div class="w-full text-center">
						<a href="{{ route('register') }}" class="txt3">
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url({{ asset('assets/img/nav-font2.jpg')}});"></div>
			</div>
		</div>
 @endsection
