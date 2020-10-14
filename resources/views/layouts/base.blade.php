<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Normalize V8.0.1 -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
    <link rel="stylesheet" href=" {{ asset('css/normalize.css')}}">
    <!-- Bootstrap V4.3 -->
    <link rel="stylesheet" href=" {{ asset('css/bootstrap.min.css')}}">
    <!-- Bootstrap Material Design V4.0 -->
    <link rel="stylesheet" href=" {{ asset('css/bootsrap-material-design.min.css')}}">
    <!-- Font Awesome V5.9.0 -->
    <link rel="stylesheet" href=" {{ asset('css/all.css')}}">
    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet" href=" {{ asset('css/sweetalert2.min.css')}}">
    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="{{ asset('js/sweetalert2.min.js') }}" ></script>
    <!-- jQuery Custom Content Scroller V3.1.5 -->
    <link rel="stylesheet" href=" {{ asset('css/jquery.mCustomScrollbar.css')}}">
    <!-- General Styles -->
    <link rel="stylesheet" href=" {{ asset('css/style.css')}}">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
    @livewireStyles
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @yield('custom_style')
</head>
<body onload="myFunction()">
    <div class="d-flex" id="wrapper" >
        @yield('sidebar')
        <div class="container-fluid" >
            <div id="preloader">@yield('sidebar')</div>
            @yield('you')
        </div>
     </div>
      <!-- popper -->
      <script src="{{ asset('js/popper.min.js') }}" ></script>
      <!-- Bootstrap V4.3 -->
      <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
      <!-- jQuery Custom Content Scroller V3.1.5 -->
      <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}" ></script>
      <!-- Bootstrap Material Design V4.0 -->
      <script src="{{ asset('js/bootstrap-material-design.min.js') }}" ></script>
      <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
      <script src="{{ asset('js/main.js') }}" ></script>
<!-- Latest compiled and minified JavaScript -->
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="exampleModalluanchrep" tabindex="-1" role="dialog" aria-labelledby="exampleModalluanchrep" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width:50%">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Lancement des réapprovisionnements</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Voulez-vous vraiment lancer les réapprovisionnements manuellement?
        </div>
        <div class="modal-footer">
        <a href="{{ route('luanch.replishippement')}}" class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                 class="btn btn-warning">
                        Confirmer le lancement
        </a>
            <button class="swal2-confirm swal2-styled"
            style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
            type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
        </div>
        </div>
    </div>
    </div>
      @livewireScripts
      @yield('jsnagh')
      <script>
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
      </script>
      <script>
        $('.dropdown-toggle').dropdown();
        jQuery(document).on('click', '.mega-dropdown', function(e) {
        e.stopPropagation()
        });
      </script>
      <script>
        var preloader = document.getElementById("preloader");
        function myFunction(){
          preloader.style.display = 'none';
        };
      </script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <!--<script src="{{asset('js/bootstrap-select.js')}}"></script> -->

</body>
</html>
