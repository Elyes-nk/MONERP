	
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
                    <i class="fas fa-user"></i> &nbsp;VOTRE PROFILE
                </h3>
                @include('profile.breadcumb')
                            @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif                        
            </div>
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off">
                    <fieldset>
                    <legend><i class="far fa-address-card"></i> &nbsp; Informations sur votre profile</legend>
                    <div class="container-fluid">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputName">Nom :</label>
                            <label for="inputName"> <strong> {{$profile->name}}</strong></label>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                            <label for="inputEmail">Email :</label>
                            <label for="inputName"> <strong> {{$profile->email}}</strong></label>
                            </div>  
                        </div>
                     </div>
                  </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                 <button  onclick="document.location='/profile/{{$profile->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
                </p>
             </form>
           	</div>
            <!--Photo update-->
            <livewire:profile :myprof='$profile'/>
        </section>
</main>
@endsection
@section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($profile->id); ?>;
            var lien=<?php  echo json_encode($profile->name); ?>;
            var url="/profile/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });
    </script>

    
<script>
    window.livewire.on('fileChoosen', () => {
        
        let inputField = document.getElementById('image')
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })
</script>
@endsection


















