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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER LA SEQUENCE
                </h3>
                @include('sequences.breadcumb')
            </div>  
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{route('sequences.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE SEQUENCE</a>
                    </li>
                    <li>
                        <a href="{{route('sequences.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES SEQUENCES</a>
                    </li>

                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off" action="{{ route('sequences.update',["sequence"=>$sequence->id]) }}" method='post'>
                    @csrf
                    @method('PUT')
                    <fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information sur la séquence</legend>
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputName">Nom</label>
                            <input type="text" class="form-control" name="inputName" placeholder="Nom de la séquence" value="{{ $sequence->name  }}">
                              @error('inputName')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputOrigin">Origine </label>
                            <input type="text" class="form-control" name="inputOrigin" placeholder="Origine" value="{{ $sequence->origin  }}" readonly>
                                @error('inputOrigin')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputNum">Numéro suivant</label>
                            <input type="number" class="form-control" name="inputNum" placeholder="Numéro" value="{{$sequence->next_number  }}">
                              @error('inputNum')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputIncrementation">Incrémentation </label>
                            <input type="number" class="form-control" name="inputIncrementation" placeholder="Incrémentation" value="{{ $sequence->increment  }}">
                              @error('inputIncrementation')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group col-md-4 ">
                            <label for="inputRemplissage">Remplissage  </label>
                            <input type="number" class="form-control" name="inputRemplissage" placeholder="Remplissage" value="{{$sequence->remplissage  }}">
                              @error('inputRemplissage')
                              <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>

                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information supplémentaires</legend>
                    <div class="container-fluid">
                    
                    <label for="temps">Mesure du temps :  </label>
                                    <div class="form-check">
                                            <input type="checkbox" id="contactChoice1"
                                            name="inputYear" value="1" class="css-checkbox dark-plus"
                                            @if ($sequence->year== '1')
                                                    {{   'checked'  }}
                                                @endif >
                                            <label for="contactChoice1" class="css-label">Année</label>
                                    </div>
                                    <div class="form-check">
                                            <input type="checkbox" id="contactChoice2"
                                            name="inputMonth" value="1" class="css-checkbox dark-plus"
                                            @if ($sequence->month== '1')
                                                    {{   'checked'  }}
                                                @endif >
                                            <label for="contactChoice2" class="css-label">Mois</label>
                                    </div>
                                    <div class="form-check">
                                            <input type="checkbox" id="contactChoice3"
                                            name="inputDay" value="1" class="css-checkbox dark-plus"
                                            @if ($sequence->day== '1')
                                                    {{   'checked'  }}
                                                @endif >
                                            <label for="contactChoice3" class="css-label">Jours</label>
                                    </div>
                                    <div class="form-check">
                                            <input type="checkbox" id="contactChoice4"
                                            name="inputTime" value="1" class="css-checkbox dark-plus"
                                            @if ($sequence->time== '1')
                                                    {{   'checked'  }}
                                                @endif >
                                            <label for="contactChoice4"class="css-label">Heurs</label>
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
<script>
 $(document).ready(function() {
        var id=<?php  echo json_encode($sequence->id); ?>;
        var lien=<?php  echo json_encode($sequence->name); ?>;
        var url="/sequences/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });

$('inputYear').on('change', function() {
    $('inputYear').not(this).prop('checked', false);  
});
$('inputMonth').on('change', function() {
    $('inputMonth').not(this).prop('checked', false);  
});
$('inputDay').on('change', function() {
    $('inputDay').not(this).prop('checked', false);  
});
$('inputTime').on('change', function() {
    $('inputTime').not(this).prop('checked', false);  
});
</script>
@endsection


