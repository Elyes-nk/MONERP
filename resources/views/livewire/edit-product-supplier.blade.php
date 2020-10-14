<div>
                        <table class="table table-dark table-sm " name="lignes">
                            <thead>
                                <tr class="text-center roboto-medium">
                                    <th>Fournisseur</th>
                                    <th>Délai de livraison</th>
                                    <th>Prix d'acquisition</th>
                                    <th>Quantité minimale autorisé</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                                @foreach ($lignes as $line)
                                <tr class="text-center">
                                <td><input type="text" class="form-control "    value="{{ $line->tier->name }}" readonly></td>
                                <td><input type="text" class="form-control "   value="{{ $line->delai }}" readonly></td>
                                <td><input type="text" class="form-control "    value="{{ $line->price }}" readonly></td>
                                <td><input type="text" class="form-control "
                                    value=" {{ $line->qtt_min }}" readonly></td>
                                    <td>
                                        <a href="#" wire:click="modifyline({{ $line->id }})" class="btn btn-success">
                                            <i class="fas fa-sync-alt" ></i>
                                        </a>
                                        <a href="#" wire:click="deleteline({{ $line->id }})" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="text-center">
                                    <td>
                                    <select wire:model.lazy="tier_id"
                                      class="form-control"
                                            @error('tier_id')
                                            style="border:solid 1px red"
                                            @enderror >
                                            <option value="" >Selectionner un fournisseur </option>
                                                @forelse($tiers as $tier)
                                                    <option value="{{ $tier->id }}" >{{ $tier->name }}</option>
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
                                        <a class="btn btn-primary"   wire:click="addsupllier({{$index}})" >
                                            <div class="spinner-border" wire:loading role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                              <div wire:loading.remove>
                                                <i class="fas fa-plus fa-fw" ></i> &nbsp;
                                              </div>


                                        </a>
                                    </td>
                                </tr>
                                    </tbody>
                                </table>


</div>
