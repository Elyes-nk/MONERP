<div>
    <form  wire:submit.prevent="add_voucher" >

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">
              Ajouter un réglement
           </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="container-fluid">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                <input type="date" class="form-control" name="date" wire:model="date" value="{{$date}}" @error('date')
                    style='border: 1px solid red'
                @endif>
                </div>
                <div class="form-group col-md-6">
                    <label for="montant">Montant</label>

                <input type="string" class="form-control" name="montant" wire:model="balances" value="{{$balances}}"
                @error('balances')
                style='border: 1px solid red'
            @enderror
            @if($warning)
                style='border: 1px solid red'
            @endif
            >

                </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

          <a class="btn btn-primary" wire:click="add_voucher">Ajouter un réglement</a>


        </div>
        </form>
</div>
