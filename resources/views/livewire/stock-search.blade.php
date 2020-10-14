<div>
    <div class="container-fluid">
        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
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
                      <span class="sr-only" >Loading...</span>
                    </div>
                  </div>
                <table class="table table-dark table-sm" wire:loading.remove>
                    <thead>
                        <tr class="text-center roboto-medium">

                            <th>Produit</th>
                            <th>Stock virtuel</th>
                            <th>Stock physique</th>
                            <th>Stock alerte</th>
                            <th>Stock optimal</th>
                            <th>Cump</th>
                            <th>Valorisation de stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products)==0)
                            <tr>
                            <td colspan="7">Pas de produit disponible dans le stock</td>
                            </tr>
                        @else
                            @foreach($products as $product)
                            <tr class="text-center" @if ($product['physical_stock']<$product['alerte_stock'])
                                style="color:red"
                            @endif onclick="document.location='/products/{{$product['id']}}'">

                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['virtual_stock'] }}</td>
                            <td>{{ $product['physical_stock'] }}</td>
                            <td>{{ $product['alerte_stock'] }}</td>
                            <td>{{ $product['optimal_stock'] }}</td>
                            <td>{{ $product['cump'] }}</td>
                            <td>{{ ($product['virtual_stock']+$product['physical_stock'])*$product['cump'] }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 center mx-auto">
            {{ $products->links() }}
        </div>
</div>
