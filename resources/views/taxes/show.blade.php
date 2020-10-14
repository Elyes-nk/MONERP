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
                    <i class="fas fa-hand-holding-usd fa-fw"></i> &nbsp; INFORMATIONS SUR LA TAXE
                </h3>
                @include('taxes.breadcumb')
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
                        <a href="{{route('taxes.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE TAXE</a>
                    </li>
                    <a href="{{ route('taxes.show',["tax"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>

                    <li>
                        <a href="{{route('taxes.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES TAXES</a>
                    </li>
                    <a href="{{ route('taxes.show',["tax"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    

                </ul>
            </div>
      <div class="container-fluid">
				<form class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far"></i> &nbsp; Information sur la taxe</legend>
						<div class="container-fluid">
                                <div class="form-row">
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom :</label>
                                    <label for="inputName"> <strong> {{$taxe->name}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputTaux">Taux : </label>
                                    <label for="inputName"> <strong> {{$taxe->taux}}</strong></label>
                                    </div>
                                </div>
                         </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/taxes/{{$taxe->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
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
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
            
    @endsection

