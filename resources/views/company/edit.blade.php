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
                    <i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER LA SOCIETE
                </h3>
                @include('company.breadcumb')   
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{ route('company.update',["company"=>$company->id])}}" class="form-neon" autocomplete="off" method='post' enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')
					<fieldset>
						<legend><i class="far fa-building"></i> &nbsp; Informations sur la société</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="inputName">Name</label>
                                <input type="text" class="form-control" name="inputName"  value="{{ $company->name }}">
                                @error('inputName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="pdg">PDG</label>
                                <input type="text" class="form-control" name="pdg"  value="{{ $company->pdg }}">
                                @error('pdg')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="email">Email</label>
                                <input type="email" class="form-control" name="email"  value="{{ $company->email }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="web">Site web</label>
                                <input type="text" class="form-control" name="web"  value="{{ $company->web}}">
                                @error('web')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="bmd-label-floating" for="pays">Pays</label>
                                    <input type="text" class="form-control" name="pays"  value="{{ $company->pays }}">
                                    @error('pays')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>   
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="ville">Ville</label>
                                <input type="text" class="form-control" name="ville"  value="{{ $company->ville }}">
                                @error('ville')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="adresse">Adresse </label>
                                <input type="text" class="form-control" name="adresse"  value="{{ $company->adresse }}">
                                @error('adresse')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-3">
                                <label class="bmd-label-floating" for="code_postal">Code postal</label>
                                <input type="number" class="form-control" name="code_postal"  value="{{ $company->code_postal}}">
                                @error('code_postal')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                      </div>
                    </fieldset>
					<br>
					<fieldset>
                        <legend><i class="far fa-plus-square"></i> &nbsp; Informations supplémentaires</legend>
						<div class="container-fluid">
                           
                            <div class="form-row">
                             
                                <div class="form-group col-md-4">
                                <label class="bmd-label-floating" for="capital">Capital</label>
                                <input type="number" class="form-control" name="capital"  value="{{ $company->capital }}">
                                @error('capital')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                <label class="bmd-label-floating" for="rib">RIB</label>
                                <input type="number" class="form-control" name="rib"  value="{{ $company->rib }}">
                                @error('rib')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                <label class="bmd-label-floating" for="rc">RC</label>
                                <input type="number" class="form-control" name="rc"  value="{{ $company->rc}}">
                                @error('rc')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label class="bmd-label-floating" for="nif">NIF</label>
                                <input type="number" class="form-control" name="nif"  value="{{ $company->nif }}">
                                @error('nif')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-6">
                                <label class="bmd-label-floating" for="art">ART</label>
                                <input type="number" class="form-control" name="art"  value="{{ $company->art}}">
                                @error('art')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>         
                            </div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER</button>
					</p>
				</form>
			</div>
        </section>
</main>
@endsection
@section('jsnagh')
<script>$(document).ready(function() {
        var id=<?php  echo json_encode($company->id); ?>;
        var lien=<?php  echo json_encode($company->name); ?>;
        var url="/company/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');

        });</script>
@endsection
