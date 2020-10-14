	
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
                    <i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER VOTRE BON DE RECEPTION
                </h3>
                @include('receptions.breadcumb')
            </div>
      
            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off" action="{{ route('receptions.update',["reception"=>$reception->id]) }}" method='post'>
                    @csrf
                    @method('PUT')
                    <fieldset>
                    <div class="container-fluid">
                        <div class="form-row">  
                           <div class="form-group col-md-6">
                                <span class="roboto-medium">Nom :</span> 
                                <input type="text" class="form-control" name="inputName" placeholder="Date" value="{{ $reception->name}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <span class="roboto-medium">Date :</span> 
                                <input type="date" class="form-control" name="inputDate" placeholder="Date" value="{{ $reception->date  }}">
                                @error('inputDate')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">  
                           <div class="form-group col-md-6">
                                <span class="roboto-medium">Fournisseur :</span> 
                                <select name="inputTier" class="form-control">
                                    @forelse($tiers as $tier)
                                        <option value="{{ $tier->id }}"  {{ $reception->tier_id == '$tier->id' ? 'selected' : '' }}>{{ $tier->name }}</option>
                                    @empty
                                        <option value=''>Aucune fournisseur </option>
                                    @endforelse
                                </select>
                                @error('inputTier')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-dark table-sm ">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>Article</th>
                                        <th>Code</th>
                                        <th>Unité</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                        <th>Taxe</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" >
                                        <td> 
                                       
                                        </td>
                                        <td>
                                      
                                        </td>
                                        <td>
                                       
                                        </td>
                                        <td>
                                        
                                        </td>
                                        <td>
                                       
                                        </td>
                                        <td>
                                        
                                        </td>
                                        <td> prix
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
<script>
$(document).ready(function() {
        var id=<?php  echo json_encode($reception->id); ?>;
        var lien=<?php  echo json_encode($reception->name); ?>;
        var url="/receptions/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });
</script>
@endsection











