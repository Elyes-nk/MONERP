<div>

    <table class="table table-dark table-sm ">
        <thead>
            <tr class="text-center roboto-medium">
                <th>Fournisseur</th>
                <th>Délai de livraison</th>
                <th>Prix d'acquisition</th>
                <th>Quatité minimale autorisé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <tr class="text-center">
        <td>
        <select wire:model.lazy="name"
          class="form-control"
                @error('name')
                style="border:solid 1px red"
                @enderror >
                <option value="" >Selectionner un fournisseur </option>
                    @forelse($tiers as $tier)
                        <option value="{{ $tier->id }}">{{ $tier->name }}</option>
                    @empty
                        <option value=''>Aucun fournisseur </option>
                @endforelse
        </select>

        </td>
        <td>
            <input type="number" class="form-control "   placeholder="Délai de livraison" @error('delai')
                style="border:solid 1px red"
                @enderror
                value="{{ $delai ?? "" }}" >

        </td>
        <td>
            <input type="text" class="form-control "  wire:model="price" placeholder="Prix d'acquisition" @error('price')
                style="border:solid 1px red"
                @enderror
                value="{{ $price ?? "" }}" >
        </td>
        <td>
            <input type="text" class="form-control "  wire:model="qtt_min" placeholder="Quantité minimale autorisée" @error('qtt_min')
                style="border:solid 1px red"
                @enderror
                value="{{ $qtt_min ?? "" }}" >
        </td>
        <td>
            <a class="btn btn-primary"   wire:click="addsupllier" >
                <div class="spinner-border" wire:loading role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <div wire:loading.remove>
                    <i class="fas fa-plus fa-fw" ></i> &nbsp;
                  </div>


            </a>
        </td>
    </tr>
    <input type="hidden" name="cmpt" wire:model="cmpt" value="{{ $cmpt }}">
    @foreach ($lignes as $line)
    <tr class="text-center">
    <td>{{ $line['tier_name'] }}</td>
    <td>{{ $line['delai'] }}</td>
    <td>{{ $line['prix'] }}</td>
    <td>{{ $line['qtt_min'] }}</td>
    <td>
    <input type="hidden" name="id_tier_{{$i_id}}" value="{{ $line['tier_id'] }}">
        <input type="text" class="form-control "  name="tier_name_{{$i_id}}"  value="{{ $line['tier_name'] }}" readonly></td>
    <td><input type="text" class="form-control "  name="delai_{{$i_id}}"  value="{{ $line['delai'] }}" readonly></td>
    <td><input type="text" class="form-control "  name="price_{{$i_id}}"  value="{{ $line['prix'] }}" readonly></td>
    <td><input type="text" class="form-control "  name="qttmin_{{$i_id}}"
        value=" {{ $line['qtt_min'] }}" readonly></td>
    <td>
        <a href="#" wire:click="modifyline({{ $line['index']}})" class="btn btn-success">
            <i class="fas fa-sync-alt" ></i>
        </a>
        <a href="#" wire:click="deleteline({{ $line['index']}})" class="btn btn-danger">
            <i class="far fa-trash-alt"></i>
        </a>
    </td>
    </tr>
    <?php $i_id+=1; ?>
    @endforeach
        </tbody>
    </table>
</div>
