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
                    <i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER UNE UNITÉ
                </h3>
                @include('unityProducts.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('unityProducts.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE UNITÉ</a>
                    </li>
                    <li>
                        <a href="{{ route('unityProducts.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UNITÉS</a>
                    </li>
                </ul>
            </div>


            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{ route('unityProducts.update',["unityProduct"=>$unityProduct->id]) }}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
                    @method('PATCH')
					<fieldset>
						<legend><i class="fas fa-balance-scale-right fa-fw"></i> &nbsp; Informations sur l'unité</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-12 mt-4">
                                <label for="inputName">Nom</label>
                                <input type="text" class="form-control" name="inputName" placeholder="Nom de l'unité" value="{{ $unityProduct->name }}">
                                @error('inputName')
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
        var id=<?php  echo json_encode($unityProduct->id); ?>;
        var lien=<?php  echo json_encode($unityProduct->name); ?>;
        console.log()
        var url="/unityProducts/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });</script>
@endsection
