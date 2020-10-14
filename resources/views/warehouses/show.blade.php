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
                    <i class="fas fa-warehouse fa-fw"></i> &nbsp; INFORMATIONS SUR L'ENTREPÔT
                </h3>
                @include('warehouses.breadcumb')
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}                               
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('warehouses.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ENTREPÔT</a>
                    </li>
                    <a href="{{ route('warehouses.show',["warehouse"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{ route('warehouses.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES ENTREPÔTS</a>
                    </li>
                    <a href="{{ route('warehouses.show',["warehouse"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>
            <!--CONTENT-->
            <div class="container-fluid">
                <form class="form-neon" autocomplete="off" >
                    @csrf
					<fieldset>
						<legend><i class="fas fa-warehouse fa-fw"></i> &nbsp; Informations sur l'entrpôt</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form col-md-6 mt-4">
                                    <label for="inputName"><strong>Nom : </strong></label>
                                    <label for="inputName"> {{$warehouse->name}}</label>
                                </div>
                                <div class="md-form col-md-6 mt-4">
                                    <label for="inputAdresse"><strong>Adresse : </strong></label>
                                    <label for="inputAdresse">  {{$warehouse->adresse}}</label>
                                </div>
                            </div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/warehouses/{{$warehouse->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
                </form>
            </div>
        </section>
</main>
@endsection
@section('jsnagh')
<script>$(document).ready(function() {
        var id=<?php  echo json_encode($warehouse->id); ?>;
        var lien=<?php  echo json_encode($warehouse->name); ?>;
        var url="/warehouses/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });</script>
@endsection
