<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Company;
use \App\Currency;
use Auth;


class CurrenciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currencies = Currency::All();
        //$currencies = currencies::where('notes',$request->query('notes','pas null'))->get();
        return view('currencies.index', compact('currencies'));
    }

    public function show($id)
    {
        $currency=Currency::find($id);
        if(! $currency)
        {
            return redirect()->route('currencies.index');
        }
        $id_next=Currency::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Currency::first();
        }
        $id_previous=Currency::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Currency::first();
        }
        return view('currencies.show', compact('currency','id_next','id_previous'));

    }

    public function create()
    {
        $currency = new Currency();
        return view('currencies.create', compact('currency'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputSymbole'=>'required',

    ]);
        $currency = $company->currencies()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'symbole'=>$request->inputSymbole,
            'taux'=>$request->inputTaux,
        ]);
        session()->flash('message','Devise crée avec succès !');
        return redirect()->route('currencies.show',["currency"=>$currency->id]);
    }

    public function edit($id)
    {
        $currency=Currency::find($id);
        if(! $currency)
        {
            return redirect()->route('currencies.index');
        }
        return view('currencies.edit', compact('currency'));
    }

    public function update(Request $request,$id)
    {
        /*$currency->update($this->ValidateData()); */

        $this->validate($request,[
            'inputName'=>'required',
            'inputSymbole'=>'required',

    ]);
    $currency=Currency::findOrFail($id);
        $currency ->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'symbole'=>$request->inputSymbole,
            'taux'=>$request->inputTaux,
        ]);
        session()->flash('message','La devise a était mise à jour avec succès !');
        return redirect()->route('currencies.show',["currency"=>$currency->id]);
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currencies.index');
    }
}
