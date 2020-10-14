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
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES COMMANDES
                </h3>
                @include('commandes.breadcumb')
            </div>
            @livewire('orders-search')
        </section>
    </main>
@endsection
