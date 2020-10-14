<div>
    <table class="table table-dark table-sm ">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>Date planifié</th>
                                        <th>Quantité</th>
                                        <th>Etat</th>
                                        <th>Erreur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                    <td>
                                        <input type="date" class="form-control "  wire:model="date" placeholder="Date Planifié" @error('date')
                                            style="border:solid 1px red"
                                            @enderror
                                            @if ($this->warning)
                                                style="border:solid 1px red"
                                            @endif
                                            value="{{ $date ?? "" }}" >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control "  wire:model="product_qty" placeholder="Quantité" @error('product_qty')
                                            style="border:solid 1px red"
                                            @enderror
                                            value="{{ $product_qty ?? "" }}" >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control "  wire:model="state" placeholder="Etat" value="{{$state ?? "en attente"}}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control "   placeholder=""  readonly>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"   wire:click="addplane({{$index}})" >
                                            <div class="spinner-border" wire:loading role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                              <div wire:loading.remove>
                                                <i class="fas fa-plus fa-fw" ></i> &nbsp;
                                              </div>


                                        </a>
                                    </td>

                                    </tr>
                                    @foreach($lignes as $line)
                                    <tr class="text-center" >
                                        <td>
                                        <input class="form-control" value="{{ $line->date}}" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" value="{{$line->product_qty}}" readonly>

                                        </td>
                                        <td>
                                        <input class="form-control" value="{{$line->state}}" readonly>

                                        </td>
                                        <td>
                                        <input class="form-control" value="{{$line->message}}" readonly>

                                        </td>

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
                                </tbody>
                            </table>
</div>
