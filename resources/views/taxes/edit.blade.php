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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER LA TAXE
                </h3>
                @include('taxes.breadcumb')
            </div> 
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{route('taxes.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE TAXE</a>
                    </li>
                    <li>
                        <a href="{{route('taxes.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES TAXES</a>
                    </li>

                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{route('taxes.update',["tax"=>$taxe->id])}}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
                    @method('PATCH')
					<fieldset>
						<legend><i class="far fa-plus-square"></i> &nbsp; Informations sur la taxe</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form  col-md-6 mt-4">
                                <label for="inputName">Nom</label>
                                <input type="text" class="form-control" name="inputName" placeholder="Nom de la taxe" value="{{ $taxe->name }}">
                                @error('inputName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="md-form  col-md-6 mt-4">
                                <label for="inputTaux">Taux </label>
                                <input type="number" class="form-control" name="inputTaux" placeholder="Taux taxe" value="{{ $taxe->taux }}">
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
<script>$(document).ready(function() {
        var id=<?php  echo json_encode($taxe->id); ?>;
        var lien=<?php  echo json_encode($taxe->name); ?>;
        var url="/taxes/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });</script>
@endsection
