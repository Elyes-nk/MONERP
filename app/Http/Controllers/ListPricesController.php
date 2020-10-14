<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\ListPrice;
use \App\Company;
use \App\Currency;



class ListPricesController extends Controller
{
    public function __construct()
    {
        $this->middleware('superuser');
        $this->middleware('auth');
        $this->middleware('sequences');
    }

    public function index()
    {
        $listPrices = ListPrice::All();
        $currencies = Currency::All();

        //$ListPrices = ListPrices::where('notes',$request->query('notes','pas null'))->get();
        return view('ListPrices.index', compact('listPrices','currencies'));
    }

    public function show($id)
    {
        $listPrice=ListPrice::find($id);
        if(! $listPrice)
        {
            return redirect()->route('listPrices.index');
        }
        $id_next=ListPrice::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = ListPrice::first();
        }
        $id_previous=ListPrice::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = ListPrice::first();
        }
        $currencies = Currency::All();
        return view('listPrices.show', compact('listPrice','currencies','id_next','id_previous'));

    }

    public function create()
    {
        $listPrices = new ListPrice();
        $currencies = Currency::All();
        return view('listPrices.create', compact('listPrices', 'currencies'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputRemise'=>'required|numeric|Min:0|Max:100|',
            "inputCurrencyID"=>'required'
    ]);
        $listPrice = $company->list_prices()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'remise'=>$request->inputRemise,
            'currency_id'=>$request->inputCurrencyID,
        ]);
        session()->flash('message','Liste de prix crée avec succès !');
        return redirect()->route('listPrices.show',["listPrice"=>$listPrice->id]);
    }

    public function edit($id)
    {
        $listPrice = ListPrice::findOrFail($id);
        if(! $listPrice)
        {
            return redirect()->route('listPrices.index');
        }
        $currencies = Currency::All();
        return view('listPrices.edit', compact('listPrice', 'currencies'));
    }

    public function update(Request $request,$id)
    {
        /*$ListPrice->update($this->ValidateData()); */
        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputRemise'=>'required|numeric|Min:0|Max:100|',
            "inputCurrencyID"=>'required'
    ]);
        $listPrice=ListPrice::findOrFail($id);
         $listPrice->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'remise'=>$request->inputRemise,
            'currency_id'=>$request->inputCurrencyID,
        ]);
        session()->flash('message','La liste a était mise à jour avec succès !');
        return redirect()->route('listPrices.show',["listPrice"=>$listPrice->id]);
    }

    public function destroy(ListPrice $listPrice)
    {
        $listPrice->delete();
        return redirect()->route('listPrice.show');
    }
}
