@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection

@section('you')
    <main class="full-box main-container">
        <section class="full-box page-content">
            @include('_partials._navbar')
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES REGLES DE RÉAPPROVISIONNEMENT
                </h3>
                @include('replenishmentRules.breadcumb')
            </div>
            @livewire('replenishment-rules-search')
        </section>
    </main>
@endsection
