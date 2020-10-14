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
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; INFORMATIONS SUR LA SEQUENCE
                </h3>
                @include('sequences.breadcumb')
            </div>  
                <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <a href="{{ route('sequences.show',["sequence"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('sequences.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES SEQUENCES</a>
                    </li>
                    <a href="{{ route('sequences.show',["sequence"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>
      <div class="container-fluid">
				<form class="form-neon" autocomplete="off">
					<fieldset>
                        <legend><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Information sur la sequence</legend>
						<div class="container-fluid">
                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom :</label>
                                    <label for="inputName"> <strong> {{$sequence->name}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-6 mt-4">
                                    <label for="inputCode">Origine :</label>
                                    <label for="inputName"> <strong> {{$sequence->origin}}</strong></label>
                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPays">Numéro suivant :</label>
                                    <label for="inputName"> <strong> {{$sequence->next_number}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputAdresse">Incrémentation numéro  :</label>
                                    <label for="inputName"> <strong> {{$sequence->increment}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputCodeP">Remplissage   :</label>
                                    <label for="inputName"> <strong> {{$sequence->remplissage}}</strong></label>
                                    </div>

                                </div>
                             </div>
					</fieldset>
					<br><br><br>
					<fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information supplémentaires</legend>
						<div class="container-fluid">

                                <div class="form-row">
                                    <div class="form-group col-md-12 mt-4">
                                    <label for="inputList_prices_id">Mesure du temps :</label>
                                    <label for="inputName"> <strong>
                                        @if($sequence->year == '1')
                                            Années /
                                        @endif
                                        @if($sequence->day == '1')
                                            Jours /
                                        @endif
                                        @if($sequence->month == '1')
                                            Mois /
                                        @endif
                                        @if($sequence->time == '1')
                                             Heurs /
                                        @endif
                                    </strong></label>
                                </div>
                         </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/sequences/{{$sequence->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>
        </section>
    </main>
    @endsection
    @section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($sequence->id); ?>;
            var lien=<?php  echo json_encode($sequence->name); ?>;
            var url="/sequences/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
    @endsection
