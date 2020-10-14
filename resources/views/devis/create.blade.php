@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection



@section('you')
<style>
 .btn-light.custom-file-control:before, .btn.btn-light {
    color: black;
    background-color: transparent;
    border-color: #ccc;
}
.btn-light.active.custom-file-control:before, .btn-light.custom-file-control:active:before, .btn-light.custom-file-control:focus:before, .btn-light.custom-file-control:hover:before, .btn-light.focus.custom-file-control:before, .btn.btn-light.active, .btn.btn-light.focus, .btn.btn-light:active, .btn.btn-light:focus, .btn.btn-light:hover, .open>.btn-light.dropdown-toggle.custom-file-control:before, .open>.btn.btn-light.dropdown-toggle {
    color: black;
    background-color: hsla(0,0%,60%,.2);
    border-color: hsla(0,0%,60%,.2);
}
</style>
<main class="full-box main-container">
    <section class="full-box page-content">
      @include('_partials._navbar')
              <!-- Page header -->
              <div class="full-box page-header">
                  <h3 class="text-left">
                      <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; AJOUTER UNE DEMANDE D'ACHAT
                  </h3>
                  @include('devis.breadcumb')
              </div>
              <div class="container-fluid">
                  <ul class="full-box list-unstyled page-nav-tabs">
                      <li>
                          <a class="active" href="{{route('devis.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
                      </li>
                      <li>
                          <a href="{{route('devis.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES DEVIS</a>
                      </li>
                  </ul>
              </div>

@livewire('setcurrency')

</section>
</main>
@endsection
@section('jsnagh')
<script>

    $(document).ready(function(){
        $('.selectpickers').selectpicker('refresh');;
      $('#tier_search').selectpicker();
    });
      </script>

<script>
$(document).ready(function() {

    var lien= <?php  echo json_encode("Nouveau"); ?>;
    var url="/products/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

    });
    </script>
@endsection
