@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection

@section('you')
<main class="full-box main-container">
  <section class="full-box page-content">
    @include('_partials._navbar')
            <!-- Page header -->
            <div class="full-box page-header ">
                <h3 class="text-left">
                    <i class="fas fa-sync-alt"></i> &nbsp; LA COMPAGNIE
                </h3>
                @include('company.breadcumb')   
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}                               
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form  class="form-neon" autocomplete="off" enctype="multipart/form-data" >
					<fieldset>
						<legend><i class="far fa-building"></i> &nbsp; Informations sur la société</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-3 mt-4">
                                <label class="bmd-label-floating" for="inputName"><strong>Nom de la société :</strong></label>
                                <label class="bmd-label-floating" for="inputName">{{ $company->name }}</label>
                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label class="bmd-label-floating" for="pdg"> <strong> PDG :</strong></label>
                                <label class="bmd-label-floating" for="pdg">{{ $company->pdg }}</label>
                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label class="bmd-label-floating" for="email"><strong>Email :</strong></label>
                                <label class="bmd-label-floating" for="email">{{ $company->email }}</label>
                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label class="bmd-label-floating" for="web"><strong>Site web :</strong></label>
                                <label class="bmd-label-floating" for="web">{{ $company->web}}</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="bmd-label-floating" for="pays"><strong>Pays :</strong></label>
                                    <label class="bmd-label-floating" for="pays">{{ $company->pays }}</label>
                                </div>   
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="ville"><strong>Ville :</strong></label>
                                <label class="bmd-label-floating" for="ville">{{ $company->ville }}</label>
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="adresse"><strong>Adresse  :</strong></label>
                                <label class="bmd-label-floating" for="adresse">{{ $company->adresse }}</label>
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="code_postal"><strong>Code postal :</strong></label>
                                <label class="bmd-label-floating" for="code_postal">{{ $company->code_postal}}</label>
                                </div>
                            </div>
                      </div>
                    </fieldset>
					<br>
					<fieldset>
                        <legend><i class="far fa-plus-square"></i> &nbsp; Informations supplémentaires</legend>
						<div class="container-fluid">
                            <div class="form-row">
                            
                                <div class="form-group col-md-4 mt-4">
                                <label class="bmd-label-floating" for="capital"> <strong>Capital :</strong></label>
                                <label class="bmd-label-floating" for="capital">{{ $company->capital }}</label>
                                </div>
                                <div class="form-group col-md-4 mt-4">
                                <label class="bmd-label-floating" for="rib"><strong>RIB :</strong></label>
                                <label class="bmd-label-floating" for="rib">{{ $company->rib }}</label>
                                </div>
                                <div class="form-group col-md-4 mt-4">
                                <label class="bmd-label-floating" for="rc"><strong>RC :</strong></label>
                                <label class="bmd-label-floating" for="rc">{{ $company->rc }}</label>
                                </div>
                            </div>
                            <div class="form-row">    
                                <div class="form-group col-md-6">
                                <label class="bmd-label-floating" for="nif"><strong>NIF :</strong></label>
                                <label class="bmd-label-floating" for="nif">{{ $company->nif }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                <label class="bmd-label-floating" for="art"><strong>ART :</strong></label>
                                <label class="bmd-label-floating" for="art">{{ $company->art }}</label>
                                </div>
                            </div>
						</div>
					</fieldset>
					<p class="text-center">
                         <button  onclick="document.location='/company/{{$company->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>

             <!--Photo update-->
             <livewire:company-logo :mycomp='$company'/>

    </section>
</main>
@endsection
@section('jsnagh')
<script>
$(document).ready(function() {
        var id=<?php  echo json_encode($company->id); ?>;
        var lien=<?php  echo json_encode($company->name); ?>;
        var url="/company/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });
</script>

<script>
    window.livewire.on('fileChoosen', () => {
        
        let inputField = document.getElementById('image')
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })
</script>
@endsection
