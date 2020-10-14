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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER LE RÉAPPROVISIONNEMENT
                </h3>
                @include('replenishment.breadcumb')
            </div>  
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{route('replenishment.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES RÉAPPROVISIONNEMENT</a>
                    </li>

                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off" action="{{ route('replenishment.update',["replenishment"=>$replenishment->id]) }}" method='post'>
                    @csrf
                    @method('PUT')
                    <fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information sur le réaprovisionement</legend>
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputNum">Numéro de réaprovisionement</label>
                            <input type="text" class="form-control" name="inputNum" placeholder="Numéro" value="{{ $replenishment->num  }}" readonly>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputDate">Date </label>
                            <input type="text" class="form-control" name="inputDate" placeholder="Date " value="{{ $replenishment->date  }}">
                                @error('inputDate')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4 mt-4">
                            <label for="inputArticle">Article</label>
                            <input type="text" class="form-control" name="inputArticle" placeholder="Prix" value="{{$replenishment->Article  }}">
                              @error('inputArticle')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-4 mt-4">
                            <label for="inputQte">Quantité </label>
                            <input type="text" class="form-control" name="inputQte" placeholder="Quantité" value="{{ $replenishment->Qte  }}">
                              @error('inputQte')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Entrepôt de destination :</span>
                                <select name="inputCurrency" class="form-control js-example-basic-multiple">
                                    <option value='' disabled>Sélectionnez un entrepôt </option>
                                    @forelse($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                          @if ($replenishment->currency_id==$currency->id)
                                                {{ 'selected' }}
                                          @endif >
                                          {{ $currency->name }}
                                        </option>
                                    @empty
                                        <option value=''>Aucun entrepôt. </option>
                                    @endforelse
                                </select>
                                @error('inputCurrency')
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
        $('.js-example-basic-multiple').select2();
        var id=<?php  echo json_enDate($replenishment->id); ?>;
        var lien=<?php  echo json_enDate($replenishment->name); ?>;
        var url="/replenishment/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');

        });</script>
@endsection


