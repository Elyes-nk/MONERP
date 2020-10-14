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
        @if($bill->company->logo)
            <img src="./storage/{{$bill->company->logo}}" style="width:128px;height:128px;" width="200">
        @endif
        </div>
        <h3>{{ $bill->company->name }}</h3>
        <div >
            <span >Adresse :</span>
            <span>{{ $bill->company->adresse }}</span>
        </div>
        <div >
            <span >Code postale :</span>
            <span>{{ $bill->company->code_postal }}</span>
        </div>
        <div >
            <span >Téléphone :</span>
            <span>{{ $bill->company->phone }}</span>
        </div>
        <div >
            <span >Site web :</span>
            <span>{{ $bill->company->web }}</span>
        </div>
        <hr><br>
        <h2>FACTURE</h2>
        <h4> 
            <span>{{ $bill->name }}</span>
        </h4>
        <br><hr>
        <div>
            <span >Date :</span>
            <span>{{ $bill->date }}</span>
        </div>
        <div>
            <span >Statut :</span>
            <span>
           {{ $bill->state}}
         
            </span>
        </div><hr>
        <div>    
            <main>
            <section>
            <div>
                <form>
                        <div>      
                            <div>              
                                <div>
                                    <span >Document d'origine :</span>
                                    <span>{{ $bill->purchase_order->name }}</span>
                                </div>
                                <div>
                                    <span >Fournisseur :</span>
                                    <span>
                                    @foreach($tiers as $tier)
                                    @if ($bill->tier_id == $tier->id)
                                        {{$tier->name}}
                                        @endif
                                    @endforeach
                                    </span>
                                </div>
                                <div >
                                    <span >Liste de prix :</span>
                                <span>{{ $bill->purchase_order->list_price->name }}</span>
                                </div>
                                <div >
                                    <span >Date d'écheance :</span>
                                <span>{{ $bill->date_due }}</span>
                                </div>
                            </div>
                            <br><br><br>
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Article</th>
                                            <th>Code</th>
                                            <th>Quantité</th>
                                            <th>Prix</th>
                                            <th>Taxe</th>
                                            <th>Remise</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bill->invoice_lines as $bill_line)
                                        <tr>
                                            <td>
                                            {{ $bill_line->product->name}}
                                            </td>
                                            <td>
                                            {{ $bill_line->product->ref}}
                                            </td>
                                            <td>
                                            {{ $bill_line->price_unit ?? '0'}}
                                            </td>
                                            <td>
                                                {{$bill_line->product_qty}}
                                            </td>
                                            <td>
                                                {{ $bill_line->taxe->name ?? "Aucune taxe"}}
                                            </td>
                                            <td>
                                                {{ $bill_line->remise->name ?? "Aucune remise"}}
                                            </td>
                                            <td>
                                                 {{ $bill_line->amount }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div >
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Total hors taxe :</td>
                                        <td>{{ $bill->ammount_ht }} {{ $bill->currency->symbole }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total taxes :</td>
                                            <td>{{ $bill->ammount_tax }} {{ $bill->currency->symbole }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total remises :</td>
                                            <td>{{ $bill->remise }} {{ $bill->currency->symbole }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total :</td>
                                            <td>{{ $bill->ammount_total }} {{ $bill->currency->symbole }}</td>
                                        </tr>
                                        @if ($bill->state!="brouillon")
                                        <tr>
                                            <td>Balance :</td>
                                            <td><?php $balance=$bill->ammount_total;
                                                        foreach($bill->vouchers as $line){
                                                            $balance -=$line->total;
                                                        } ?>
                                                        {{ $balance }} {{ $bill->currency->symbole }}</td>
                                        </tr>
                                        @endif
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