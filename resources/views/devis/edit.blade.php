
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
                    <i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER VOTRE DEVIS
                </h3>
                @include('devis.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('devis.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
                    </li>
                    <li>
                        <a href="{{ route('devis.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES DEVIS</a>
                    </li>
                </ul>
            </div>


            @livewire('edit-devis')

        </section>
</main>
@endsection
@section('jsnagh')
<script>


        </script>
@endsection











