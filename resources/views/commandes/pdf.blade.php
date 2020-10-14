<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        table, th, td {
        border: 1px solid #DCDCDC;
        border-collapse: collapse;
        padding: 10px;
        }
        th, td, tr {
        text-align: center;
        }
        table {
        border-spacing: 5px;
        }
        h2, h4{
            text-align: center;
        }
        table{
            width:100%;
        }
    </style>
</head>
<body>
        <div style="position:absolute;right:0px;">
        @if($purchase_order->company->logo)
            <img src="./storage/{{$purchase_order->company->logo}}" style="width:128px;height:128px;" width="200">
        @endif
        </div>
        <h3>{{ $purchase_order->company->name }}</h3>
        <div >
            <span >Adresse :</span>
            <span>{{ $purchase_order->company->adresse }}</span>
        </div>
        <div >
            <span >Code postale :</span>
            <span>{{ $purchase_order->company->code_postal }}</span>
        </div>
        <div >
            <span >Téléphone :</span>
            <span>{{ $purchase_order->company->phone }}</span>
        </div>
        <div >
            <span >Site web :</span>
            <span>{{ $purchase_order->company->web }}</span>
        </div>
        <hr><br>
        <h2>BON DE COMMANDE</h2>
        <h4> 
            <span>{{ $purchase_order->name }}</span>
        </h4>
        <br><hr>
        <div>
            <span >Date :</span>
            <span>{{ $purchase_order->date }}</span>
        </div>
        <div>
              <span>Statut :</span>
              <span>{{$purchase_order->state}}  </span>
        </div><hr>
        <div>    
            <main>
            <section>
            <div>
                <form>
                        <div>      
                            <div>
                            <div>
                                    <span >Fournisseur :</span>
                                    <span>
                                    @foreach($tiers as $tier)
                                    @if ($purchase_order->tier_id == $tier->id)
                                        {{$tier->name}}
                                        @endif
                                    @endforeach
                                    </span>
                                </div>
                                <div >
                                    <span >Liste de prix :</span>
                                <span>{{ $purchase_order->list_price->name }}</span>
                                </div>
                                            
                                <div>
                                    <span >Condition de réglement :</span>
                                    <span>{{ $purchase_order->condition_reglement ." Jours"}}</span>
                                </div>
                                <div >
                                    <span >Date prévue de livraison :</span>
                                <span>{{ $purchase_order->date_shippement }}</span>
                                </div>
                            </div>
                            <br><br><br>
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Article</th>
                                            <th>Code</th>
                                            <th>Unité</th>
                                            <th>Quantité</th>
                                            <th>Prix</th>
                                            <th>Taxe</th>
                                            <th>Entrepôt de destination</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchase_order->order_lines as $purchase_order_line)
                                        <tr >
                                            <td>
                                            {{ $purchase_order_line->product->name}}

                                            </td>
                                            <td>
                                                {{ $purchase_order_line->product->ref}}

                                            </td>
                                            <td>
                                            {{ $purchase_order_line->unity->name}}

                                            </td>
                                            <td>

                                                {{$purchase_order_line->product_qty}}

                                            </td>
                                            <td>
                                            {{ $purchase_order_line->price_unit}}

                                            </td>
                                            <td>
                                                {{ $purchase_order_line->taxe->name ?? "Aucune taxe"}}

                                            </td>
                                            <td>
                                                {{ $purchase_order_line->warehouse->name }}
                                            </td>
                                            <td>
                                                {{ $purchase_order_line->amount }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div >
                                <table>
                                    <tbody>
                                        <tr >
                                            <td>Total hors taxe :</td>
                                        <td>{{ $purchase_order->ammount_ht }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                        </tr>
                                        <tr >
                                            <td>Total taxes :</td>
                                            <td>{{ $purchase_order->ammount_tax }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                        </tr>  
                                        <tr>
                                            <td>Total remises :</td>
                                            <td>{{ $purchase_order->remise }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                        </tr>
                                        <tr >
                                            <td>Total :</td>
                                            <td>{{ $purchase_order->ammount_total }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <br><br><br>
            </main>
        </div>
</body>
</html>