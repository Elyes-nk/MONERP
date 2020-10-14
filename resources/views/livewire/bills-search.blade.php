<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
        <li>
                <div class="input-group">
                    <input type="text" wire:model="name" class="form-control"  placeholder="Recherche">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                </div>
                </div>
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
<div class="container-fluid" >
            <div class="table-responsive">
                <div class="d-flex justify-content-center" >
                    <div class="spinner-border" wire:loading >
                      <span class="sr-only" >Chargement...</span>
                    </div>
                  </div>
                <table class="table table-dark table-sm" wire:loading.remove>
                    <thead>
                        <tr class="text-center roboto-medium" >
                            <th>Facture</th>
                            <th>Fournisseur</th>
                            <th>Date facture</th>
                            <th>Date d'échéance</th>
                            <th>Total HT</th>
                            <th>Total Taxes</th>
                            <th>Total</th>
                            <th>État</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($bills)==0)
                            <tr>
                            <td colspan="9">Pas de facture.</td>
                            </tr>
                        @else
                        @foreach($bills as $bill)
                        <tr class="text-center"
                            @if ($bill->state=="Ouverte")
                            style="color:green"
                        @endif
                            @if ($bill->state=="Payé")
                            style="color:blue"
                        @endif
                        @if ($bill->state=="Annulé")
                            style="color:Red"
                        @endif
                        @if ($bill->state=="En échéance")
                            style="color:orange"
                        @endif
                        >
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->name }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">@foreach ($tiers as $tier)
                                @if ($tier->id==$bill->tier_id)
                                    {{ $tier->name}}
                                @endif
                        @endforeach</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->date }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->date_due }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->ammount_ht }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->ammount_tax }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->ammount_total }}</td>
                        <td onclick="document.location='bills/{{$bill->id}}'">{{ $bill->state }}</td>
                        <td>
                               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$bill['id']}}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="exampleModal{{$bill['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$bill['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Facture : {{$bill['name'] ?? ''}}</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($bill->state=="Annulé")
                                            Voulez-vous vraiment supprimer cette facture?
                                        @endif
                                        @if ($bill->state=="En échéance")
                                            Attention!! Si vous supprimez cette facture cela va provoquer la suppression automatique de son bon de commande ainsi que de ses réceptions. Voulez vous vraiment supprimer cette facture ?
                                        @endif
                                        @if ($bill->state =="Ouverte" OR $bill->state=="Payé" OR $bill->state=="brouillon")
                                            Vous ne pouvez pas supprimer cette facture. Pour pouvoir supprimer cette facture vous devez d'abord l'annuler.
                                        @endif
                                    </div>
                                    <div class="modal-footer" style="coloer:red">
                                        @if ($bill->state=="Annulé")
                                        <form action="/bills/{{ $bill['id'] ?? ''}}" method='post'>
                                            @method('delete')
                                            @csrf

                                            <button class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                            type="submit" class="btn btn-warning">
                                                    Supprimer
                                            </button>
                                        </form>
                                        <form>
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                        </form>
                                        @endif
                                        @if ($bill->state=="En échéance")
                                        <form action="/bills/{{ $bill['id'] ?? ''}}" method='post'>
                                            @method('delete')
                                            @csrf

                                            <button class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                            type="submit" class="btn btn-warning">
                                                    Supprimer
                                            </button>
                                        </form>
                                        <form>
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                        </form>
                                        @endif
                                        @if ($bill->state =="Ouverte" OR $bill->state=="Payé" OR $bill->state=="brouillon")
                                        <form>
                                            <button class="swal2-confirm swal2-styled"
                                            style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                            type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                            </form>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                </div>
                        </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 center mx-auto">
            {{ $bills->links() }}
        </div>
</div>
@section('jsnagh')
@foreach($bills as $bill)
<script>
$("#exampleModal{{$bill['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$bill['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
