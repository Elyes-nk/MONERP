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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER LA REGLE DE RÉAPPROVISIONNEMENT
                </h3>
                @include('replenishmentRules.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{route('replenishmentRules.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES REGLES DE RÉAPPROVISIONNEMENT</a>
                    </li>

                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off" action="{{ route('replenishmentRules.update',["replenishmentRule"=>$replenishmentRules->id]) }}" method='post'>
                    @csrf
                    @method('PUT')
                    <fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information sur la régle réaprovisionement</legend>
                    <div class="container-fluid">
                        <div class="form-row">

                            <div class="form-group col-md-6 mt-4">
                            <label for="inputArticle">Article </label>
                            <input type="text" class="form-control" name="inputArticle" placeholder="Article " value="{{ $replenishmentRules->name  }}" readonly>
                                @error('inputArticle')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-6 mt-4">
                            <label for="warehouse">Entrepot</label>
                            <select name="warehouse" class="form-control js-example-basic-multiple" required>
                            <option value="">{{"Sélectionner un entrepot"}}</option>
                            @forelse ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" @if ($warehouse->id==$replenishmentRules->warehouse_id)
                                    {{"selected"}}
                                @endif>{{$warehouse->name }}</option>
                            @empty
                                <option value="">{{"Aucun entrepot"}}</option>
                            @endforelse
                            </select>

                            </div>
                        </div>
                        <div class="table-responsive">
                            @livewire('planificate-procurement')
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
        $('.js-example-basic-multiple').select2();
        var id=<?php  echo json_encode($replenishmentRules->id); ?>;
        var lien=<?php  echo json_encode($replenishmentRules->name.'/edit'); ?>;
        var url="/replenishmentRules/"+id+"/edit";
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
        });</script>
@endsection
