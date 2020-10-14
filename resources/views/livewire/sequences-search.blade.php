<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a class="active" href="/sequences/index"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES SEQUENCES</a>
            </li>
            <li>
                <form  wire:submit.prevent="searchByName" >
                    <div class="input-group">
                        <input type="text" wire:model.lazy="name" class="form-control"  placeholder="Recherche">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>

    <!--CONTENT-->
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="d-flex justify-content-center" >
                <div class="spinner-border" wire:loading >
                  <span class="sr-only" >Loading...</span>
                </div>
              </div>
            <table class="table table-dark table-sm" wire:loading.remove>
                <thead>
                    <tr class="text-center roboto-medium">

                        <th>Origine</th>
                        <th>Code séquence</th>
                        <th>Remplissage</th>
                        <th>Numéro suivant</th>
                        <th>Incrémentation Numéro</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sequences)==0)
                        <tr>
                        <td colspan="6">Pas de séquences.</td>
                        </tr>
                    @else
                    @foreach($sequences as $sequence)
                    <tr class="text-center">

                    <td  onclick="document.location='/sequences/{{$sequence['id']}}'">{{ $sequence['origin'] }}</td>
                    <td  onclick="document.location='/sequences/{{$sequence['id']}}'">{{ $sequence['name'] }}</td>
                    <td  onclick="document.location='/sequences/{{$sequence['id']}}'">{{ $sequence['remplissage'] }}</td>
                    <td  onclick="document.location='/sequences/{{$sequence['id']}}'">{{ $sequence['next_number'] }}</td>
                    <td  onclick="document.location='/sequences/{{$sequence['id']}}'">{{ $sequence['increment'] }}</td>
                    <td>
                                    <a href="/sequences/{{$sequence['id']}}/edit" class="btn btn-success">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('jsnagh')
@foreach($sequences as $sequence)
<script>
$("#exampleModal{{$sequence['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$sequence['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
