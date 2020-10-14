<div>
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
    @foreach ($lignes as $line)
    <tr class="text-center">
    <td>{{ $line['tier_name'] }}</td>
    <td>{{ $line['delai'] }}</td>
    <td>{{ $line['prix'] }}</td>
    <td>{{ $line['qtt_min'] }}</td>
    </tr>
    @endforeach
</div>
