	
	@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection

@section('you')
<main class="full-box main-container">
  <section class="full-box page-content">
    @include('_partials._navbar')
            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER VOTRE COMPTE
                </h3>
                @include('profile.breadcumb')
            </div>
      
            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off" action="{{ route('profile.update',["profile"=>$profile->id]) }}" method='post'>
                    @csrf
                    @method('PUT')
                    <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; Informations de votre profile</legend>
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputName">Nom</label>
                            <input type="text" class="form-control" name="inputName" placeholder="Nom" value="{{ $profile->name  }}">
                              @error('inputName')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control" name="inputEmail" placeholder="Email" value="{{ $profile->email  }}">
                              @error('inputName')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                        </div>
                     </div>
                  </fieldset>
                  <br>
                  <fieldset>
                                <legend><i class="fas fa-lock"></i> &nbsp; Actualiser votre mot de passe </legend>
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-4">
                            <label for="password">Mot de passe </label>
                            <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe" >
                              @error('password')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-6 mt-4">
                            <label for="password_confirmation">Confirmation mot de passe </label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation">
                              @error('password')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                        </div>
                       
                  	</div>
                </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                  <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER</button>

                </p>
             </form>
           	</div>
        </section>
</main>
@endsection
@section('jsnagh')
<script>$(document).ready(function() {
        var id=<?php  echo json_encode($profile->id); ?>;
        var lien=<?php  echo json_encode($profile->name); ?>;
        var url="/profile/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });</script>
@endsection











