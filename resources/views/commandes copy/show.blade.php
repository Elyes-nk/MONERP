
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

                @include('devis.breadcumb')
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon"  autocomplete="off">
                <!-- Horizontal Steppers -->
<div class="row">
    <div class="col-md-12">

      <!-- Stepers Wrapper -->
      <ul class="stepper stepper-horizontal">

        <!-- First Step -->
        <li class="completed">
          <a href="#!">
            <span class="circle">1</span>
            <span class="label">First step</span>
          </a>
        </li>

        <!-- Second Step -->
        <li class="active">
          <a href="#!">
            <span class="circle">2</span>
            <span class="label">Second step</span>
          </a>
        </li>

        <!-- Third Step -->
        <li class="warning">
          <a href="#!">
            <span class="circle"><i class="fas fa-exclamation"></i></span>
            <span class="label">Third step</span>
          </a>
        </li>

      </ul>
      <!-- /.Stepers Wrapper -->

    </div>
  </div>
  <!-- /.Horizontal Steppers -->
                    <fieldset>
                    <div class="container-fluid">
                        <div class="form-row">
                           <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Nom :</span>
                                <span>{{ $purchase_order->name }}</span>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Date :</span>
                                <span>{{ $purchase_order->date }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">Fournisseur :</span>
                                <span>
                                @foreach($tiers as $tier)
                                  @if ($purchase_order->tier_id == $tier->id)
                                     {{$tier->name}}
                                    @endif
                                @endforeach
                                </span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">Liste de prix :</span>
                            <span>{{ $purchase_order->list_price->name }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">date prévue de livraison :</span>
                            <span>{{ $purchase_order->date_shippement }}</span>
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
                                        <th>Entrepot de destination</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($purchase_order->order_lines as $purchase_order_line)
                                    <tr class="text-center" >
                                        <td>
                                        {{ $purchase_order_line->product->name}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->product->ref}}

                                        </td>
                                        <td>
                                        {{ $purchase_order_line->unity->name}}

                                        </td>
                                        <td>

                                            {{$purchase_order_line->product_qty}}

                                        </td>
                                        <td>
                                        {{ $purchase_order_line->price_unit}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->taxe->name ?? "Aucune taxe"}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->warehouse->name }}
                                        </td>
                                        <td>
                                            {{ $purchase_order_line->amount }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-sm mt-500">
                                <tbody>
                                    <tr class="text-center" >
                                        <td>Total hors taxe :</td>
                                    <td>{{ $purchase_order->ammount_ht }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total taxes :</td>
                                        <td>{{ $purchase_order->ammount_tax }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total :</td>
                                        <td>{{ $purchase_order->ammount_total }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                  </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                 <button  onclick="document.location='/devis/{{$purchase_order->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
                </p>
             </form>
           	</div>
        </section>
</main>
@endsection
@section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($purchase_order->id); ?>;
            var lien=<?php  echo json_encode($purchase_order->name); ?>;
            var url="/devis/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
@endsection

















