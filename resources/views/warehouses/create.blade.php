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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ENTREPÔT
                </h3>
                @include('warehouses.breadcumb')
            </div>          
              <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ENTREPÔT</a>
                    </li>
                    <li>
                        <a  href="{{ route('warehouses.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES ENTREPÔTS</a>
                    </li>
                </ul>
            </div>


            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{ route('warehouses.store')}}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
					<fieldset>
						<legend><i class="fas fa-store-alt fa-fw"></i> &nbsp; Informations sur l'entrpôt</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control" name="inputName"  placeholder="Nom de l'entrepôt" value="{{ old('inputName') }}" autofocus>
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6 mt-4">
                                    <label for="inputAdresse">Adresse</label>
                                    <input type="text" class="form-control" name="inputAdresse"  placeholder="Adresse de l'entrepôt" value="{{ old('inputAdresse') }}" autofocus>
                                    @error('inputAdresse')
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
    var id=<?php  echo json_encode($warehouse->id); ?>;
    var lien=<?php  echo json_encode("Nouveau"); ?>;
    var url="/warehouses/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

    });</script>
@endsection
