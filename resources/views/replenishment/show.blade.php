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
                    <i class="fas fa-download fa-fw"></i> &nbsp; INFORMATIONS SUR LA RÉAPPROVISIONNEMENT
                </h3>
                @include('replenishment.breadcumb')
            </div>
                <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <a href="{{ route('replenishment.show',["replenishment"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('replenishment.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES RÉAPPROVISIONNEMENT</a>
                    </li>
                    <a href="{{ route('replenishment.show',["replenishment"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    

                </ul>
            </div>
      <div class="container-fluid">
				<form class="form-neon" autocomplete="off">
					<fieldset>
						<div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-raised btn-info btn-sm" style="float:right;background:#4caf50">{{ $replenishment->state }}</button>
                                </div>
                              </div>

                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-6 mt-4">
                                        <label for="inputName">Numéro de réaprovisionement :</label>
                                        <label for="inputName"> <strong> {{$replenishment->name}}</strong></label>
                                        </div>
                                </div>

                                <div class="form-row">

                                    <div class="md-form  col-md-6 mt-4">
                                    <label for="inputCode">Date :</label>
                                    <label for="inputName"> <strong> {{$replenishment->date}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-6 mt-4">
                                        <label for="inputCode">Erreur :</label>
                                        <label for="inputName"> <strong> @if($replenishment->message==""){{"Aucune erreur"}} @else {{$replenishment->message}} @endif</strong></label>
                                        </div>
                                </div>
                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPays">Article :</label>
                                    <label for="inputName"> <strong> {{$replenishment->product->name}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputAdresse">Quantité  :</label>
                                    <label for="inputName"> <strong> {{$replenishment->product_qty}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputCodeP">Entrepôt   :</label>
                                    <label for="inputName"> <strong> {{$replenishment->warehouse->name}}</strong></label>
                                    </div>
                                </div>
                             </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/replenishment/{{$replenishment->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>
        </section>
    </main>
    @endsection
    @section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($replenishment->id); ?>;
            var lien=<?php  echo json_encode($replenishment->name); ?>;
            var url="/replenishment/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

            });</script>
    @endsection
