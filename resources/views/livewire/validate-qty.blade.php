<div>
    <form  wire:submit.prevent="luanch_receipt" >

    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">@if ($reception->state=="Reçu")
          Retourner les articles
      @else
          Réception d'articles
      @endif </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

            <div class="container-fluid">

                <div class="table-responsive">
                    <table class="table table-dark table-sm ">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>Article</th>
                                <th>Code</th>
                                <th>Unité</th>
                                @if ($reception->state != "Reçu")
                                <th>Quantité à recevoir</th>


                                @else
                                <th>Quantité à retourner</th>
                                @endif

                                <th>Entrepôt de stockage</th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                         <tbody>

                            @foreach($lignes as $line)

                            <tr class="text-center" >
                                <td>
                                    {{ $line['product_name'] }}
                                </td>
                                <td>
                                    {{ $line['product_code'] }}
                                </td>
                                <td>
                                    {{ $line['unit_name'] }}
                                </td>
                                @if ($reception->state != "Reçu")

                                @endif
                                <td>
                                    {{ $line['product_qty'] }}

                                </td>
                                <td>
                                    {{ $line['warehouse_name']}}
                                </td>
                                <td>
                                    <a href="#" wire:click="modifyline({{$line['index']}})" class="btn btn-success">
                                        <i class="fas fa-sync-alt" ></i>
                                    </a>
                                    <a href="#" wire:click="deleteline({{$line['index']}})" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                            @if (count($put_lignes)!=0)


                            @foreach($put_lignes as $line)

                            <tr class="text-center" >
                                <td>
                                    {{ $line['product_name'] }}
                                </td>
                                <td>
                                    {{ $line['product_code'] }}
                                </td>
                                <td>
                                    {{ $line['unit_name'] }}
                                </td>
                                @if ($reception->state != "Reçu")



                                @endif
                                <td>
                                 <input type="text" wire:model='product_qty'  value=" {{ $line['product_qty'] }}" @error('product_qty')

                                     style="border:solid 1px red"

                                 @enderror @if ($this->warning_qty)
                                    style="border:solid 1px red"
                                 @endif>

                                </td>
                                <td>
                                    {{ $line['warehouse_name']}}
                                </td>
                                <td>
                                    <a class="btn btn-primary"   wire:click="addproduct" >

                                          <div wire:loading.remove>
                                            <i class="fas fa-plus fa-fw" ></i> &nbsp;
                                          </div>
                                    </a>
                                    <div class="spinner-border" wire:loading role="status">
                                            <span class="sr-only">Loading...</span>
                                          </div>
                                </td>
                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                </table>
            </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      @if ($reception->state=="Reçu")
      <a class="btn btn-primary" wire:click="createretour">Créer le bon de retour</a>
      @else
      <button type="submit" class="btn btn-primary">Lancer la reception</button>
      @endif

    </div>
    </form>
</div>
