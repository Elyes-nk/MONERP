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
                    <i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp;INFORMATIONS SUR LA LISTE DE PRIX
                </h3>
                @include('listPrices.breadcumb')
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
                        <a href="{{route('listPrices.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE LISTE DE PRIX</a>
                    </li>
                    <a href="{{ route('listPrices.show',["listPrice"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('listPrices.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTES DE PRIX</a>
                    </li>
                    <a href="{{ route('listPrices.show',["listPrice"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form  class="form-neon" autocomplete="off" >
					<fieldset>
						<legend><i class="far fa-file-dollar"></i> &nbsp; Informations sur la liste</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form col-md-4 mt-4">
                                    <label for="inputName"><strong>Nom :</strong></label>
                                    <label for="inputName"> {{$listPrice->name}}</label>
                                </div>
                                <div class="md-form col-md-4 mt-4">
                                <label for="inputType"><strong>Remise :</strong></label>
                                <label for="inputName">{{$listPrice->remise ."%"}}</label>
                                </div>
                                <div class="form-group col-md-4 mt-4">
                                <label for="inputCurrencyID"><strong>Devise :</strong></label>
                                <label for="inputName">
                                    @foreach($currencies as $currency)
                                        @if($listPrice->currency_id == $currency->id)
                                        {{ $currency->name }}
                                        @endif
                                    @endforeach
                                    </label>
                                </div>
                            </div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/listPrices/{{$listPrice->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>
        </section>
</main>
@endsection
@section('jsnagh')
<script>$(document).ready(function() {
        var id=<?php  echo json_encode($listPrice->id); ?>;
        var lien=<?php  echo json_encode($listPrice->name); ?>;
        var url="/listPrices/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });</script>
@endsection
