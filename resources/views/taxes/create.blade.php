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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE TAXE
                </h3>
                @include('taxes.breadcumb')
            </div>  
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE TAXE</a>
                    </li>
                    <li>
                        <a href="{{route('taxes.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES TAXES</a>
                    </li>

                </ul>
            </div>
      <div class="container-fluid">
				<form action="{{ route('taxes.store') }}" method='post' class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far fa-plus-square"></i> &nbsp; Information sur la taxe</legend>
						<div class="container-fluid">
                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control" name="inputName" placeholder="Nom de la taxe" value="{{ old('inputName') }}" autofocus>
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputTaux">Taux </label>
                                    <input type="number" class="form-control" name="inputTaux" placeholder="Taux taxe" value="{{ old('inputTaux') }}">
                                    @error('inputTaux')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                </div>
                         </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ENREGISTRER</button>
					</p>
				</form>
			</div>
        </section>
    </main>
    @endsection
    @section('jsnagh')

    <script>
    $(document).ready(function() {

        var lien=<?php  echo json_encode("Nouveau"); ?>;
        var url="/taxes/create";
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });
        </script>
    @endsection
