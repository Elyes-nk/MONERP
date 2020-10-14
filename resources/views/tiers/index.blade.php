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
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES FOURNISSEURS
                </h3>
                @include('tiers.breadcumb')
            </div>
            @livewire('tiers-search')
        </section>
    </main>
@endsection
