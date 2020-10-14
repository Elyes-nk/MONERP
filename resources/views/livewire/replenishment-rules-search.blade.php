<div>

    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <form   >
                    <div class="input-group">
                        <input type="text" wire:model="name" class="form-control"  placeholder="Recherche">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </li>
            <li>
            <div class="row">
              <div class="col-md-6">
                Afficher
            </div>
            <div class="col-md-6">
            <select id="sk" class="form-control" wire:model.lazy="pages">
                <?php
                $i=10;
                  while($i<=50){
                    ?>
                    <option value="{{$i }}">{{ $i}}</option>
               <?php
            $i=$i+10;
            }  ?>
            </select>
        </div>
        </div>
    </li>
        </ul>
    </div>
    <!--CONTENT-->
   <div class="container-fluid">
        <div class="table-responsive">
            <div class="d-flex justify-content-center" >
                <div class="spinner-border" wire:loading >
                  <span class="sr-only" >Chargement...</span>
                </div>
              </div>
            <table class="table table-dark table-sm" wire:loading.remove>
                <thead>
                    <tr class="text-center roboto-medium">
                        <th>Numéro</th>
                        <th>Article</th>
                        <th>Prochaine date programmée</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($replenishmentRules)==0)
                    <tr>
                        <td colspan="4">Pas de liste disponnible</td>
                        </tr>
                    @else
                        @foreach ($replenishmentRules as $replenishmentRule)
                            <?php
                            $next=$replenishmentRule->lines->where("date",">=",date('Y-m-d'))->first();
                            ?>
                            <tr class="text-center"
                            @if (!$next)
                                style="color:red"
                            @endif>

                            <td onclick="document.location='/replenishmentRules/{{$replenishmentRule->id}}'"> {{ $replenishmentRule->name }}</td>
                            <td onclick="document.location='/replenishmentRules/{{$replenishmentRule->id}}'">{{ $replenishmentRule->warehouse->name }}</td>
                            <td onclick="document.location='/replenishmentRules/{{$replenishmentRule->id}}'">
                                @if ($next)
                                    {{ $next->date }}
                                @else
                                    {{ "Pas de planification pour l'instant " }}
                                @endif
                            </td>
                            <td>
                                            <a href="{{ route('replenishmentRules.edit',["replenishmentRule"=>$replenishmentRule['id'] ]) }}" class="btn btn-success">
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
    <div class="col-md-6 center mx-auto">
        {{ $replenishmentRules->links() }}
    </div>
</div>

@section('jsnagh')
@foreach($replenishmentRules as $replenishmentRule)
<script>
$("#exampleModal{{$replenishmentRule['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$replenishmentRule['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
