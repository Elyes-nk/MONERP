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
                    <i class="fas fa-truck fa-fw"></i> &nbsp; INFORMATIONS SUR LE FOURNISSEUR
                </h3>
                @include('tiers.breadcumb')
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
                        <a href="{{route('tiers.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN FOURNISSEUR</a>
                    </li>
                    <a href="{{ route('tiers.show',["tier"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('tiers.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES FOURNISSEURS</a>
                    </li>
                    <a href="{{ route('tiers.show',["tier"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>
      <div class="container-fluid">
				<form class="form-neon" autocomplete="off">
					<fieldset>
                        <legend><i class="fas fa-truck fa-fw"></i> &nbsp; Informations sur le fournisseur</legend>
						<div class="container-fluid">
                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom :</label>
                                    <label for="inputName"> <strong> {{$tier->name}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-6 mt-4">
                                    <label for="inputCode">Code :</label>
                                    <label for="inputName"> <strong> {{$tier->code}}</strong></label>
                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPays">Pays :</label>
                                    <label for="inputName"> <strong> {{$tier->pays}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputAdresse">Adresse :</label>
                                    <label for="inputName"> <strong> {{$tier->adresse}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputCodeP">Code postal :</label>
                                    <label for="inputName"> <strong> {{$tier->code_postal}}</strong></label>
                                    </div>

                                </div>
                             </div>
					</fieldset>
					<br><br><br>
					<fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information supplémentaires</legend>
						<div class="container-fluid">

                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPhone">Numéro :</label>
                                    <label for="inputName"> <strong> {{$tier->phone}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputEmail" data-error="wrong" data-success="right">Email  :</label>
                                    <label for="inputName"> <strong> {{$tier->Email}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputWeb">Site web :</label>
                                    <label for="inputName"> <strong> {{$tier->web}}</strong></label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 mt-4">
                                    <label for="inputList_prices_id">Liste de prix :</label>
                                    <label for="inputName"> <strong>
                                    @foreach($list_prices as $list_price)
                                        @if($tier->list_price_id == $list_price->id)
                                        {{ $list_price->name }}
                                        @endif
                                    @endforeach
                                    </strong></label>
                                </div>
                                <div class="md-form col-md-6 mt-4">
                                    <label for="delai">Délai de livraison : </label>
                                    <label for="delai"> <strong> {{$tier->delai ." Jours"}} </strong></label>
                                    </div>
                         </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/tiers/{{$tier->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>
        </section>
    </main>
    @endsection
    @section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($tier->id); ?>;
            var lien=<?php  echo json_encode($tier->name); ?>;
            var url="/tiers/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

            });</script>
    @endsection
