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
        @if($reception->company->logo)
            <img src="./storage/{{$reception->company->logo}}" style="width:128px;height:128px;" width="200">
        @endif
        </div>
        <h3>{{ $reception->company->name }}</h3>
        <div >
            <span >Adresse :</span>
            <span>{{ $reception->company->adresse }}</span>
        </div>
        <div >
            <span >Code postale :</span>
            <span>{{ $reception->company->code_postal }}</span>
        </div>
        <div >
            <span >Téléphone :</span>
            <span>{{ $reception->company->phone }}</span>
        </div>
        <div >
            <span >Site web :</span>
            <span>{{ $reception->company->web }}</span>
        </div>
        <hr><br><br>
        <h2>BON DE RETOUR</h2>
        <h4> 
            <span>{{ $reception->name }}</span>
        </h4>
        <br><br><hr>
        <div>
            <span >Date :</span>
            <span>{{ $reception->date }}</span>
        </div>
        <div>
            <span >Statut :</span>
            <span>{{$reception->state}}</span>
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
                                    <span>{{$reception->tier->name}}</span>
                                </div>
                                <div >
                                    <span >Document d'origine :</span>
                                <span>{{ $reception->purchase_order->name }}</span>
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
                                        <th>Entrepôt de stockage</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reception->reception_lines as $line)
                                        <tr>
                                            <td>
                                                {{ $line->product->name }}
                                            </td>
                                            <td>
                                                {{ $line->product->ref }}
                                            </td>
                                            <td>
                                                {{ $line->product->unity->name }}
                                            </td>
                                            <td>
                                                {{ $line->product_qty }}
                                            </td>
                                            <td>
                                                {{ $line->warehouse->name}}
                                            </td>
                                        </tr>
                                        @endforeach
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