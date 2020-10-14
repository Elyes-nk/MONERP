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
                @include('replenishmentRules.breadcumb')
            </div>
            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon"  autocomplete="off">
                <div class="container-fluid">
                    <fieldset>
                    <div class="container-fluid">
                        <div class="form-row">
                           <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Article :</span>
                                <span>{{ $replenishmentRule->product->name }}</span>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Entrepot :</span>
                                <span>{{ $replenishmentRule->warehouse->name }}</span>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-dark table-sm ">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>Date planifié</th>
                                        <th>Quantité</th>
                                        <th>Etat</th>
                                        <th>Erreur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($replenishmentRule->lines as $line)
                                    <tr class="text-center" >
                                        <td>
                                    <input class="form-control"  value="{{ $line->date}}" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control"  value="{{ $line->product_qty}}" readonly>

                                        </td>
                                        <td>
                                        <input class="form-control"  value="{{ $line->state}}" readonly>

                                        </td>
                                        <td>
                                        <input class="form-control"  value="{{ $line->message}}" readonly>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                  </fieldset>
             </form>
           	</div>
        </section>
</main>
@endsection
@section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($replenishmentRule->id); ?>;
            var lien=<?php  echo json_encode($replenishmentRule->name); ?>;
            var url="/replenishmentRules/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
@endsection
