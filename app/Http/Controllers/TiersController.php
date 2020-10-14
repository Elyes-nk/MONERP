<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 //utilise les modeles suivant
use App\Tier;
use App\ListPrice;
use App\Company;
use Auth;

class TiersController extends Controller
{
    public function __construct()
    {
        $this->middleware('superuser');
        $this->middleware('auth');
        $this->middleware('sequences');
        $this->middleware('tiers');
    }

    public function index()
    {
        $tiers = Tier::All();
        return view('tiers.index', compact('tiers'));
    }

    public function show($id)
    {
        $tier=Tier::find($id);
        if(! $tier)
        {
            return redirect()->route('tiers.index');
        }
        $id_next=Tier::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Tier::first();
        }
        $id_previous=Tier::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Tier::first();
        }
        $list_prices = ListPrice::All();
        return view('tiers.show', compact('tier','list_prices','id_next','id_previous'));

    }
    public function create()
    {
        $tiers = new Tier();
        $list_prices = ListPrice::All();
        return view('tiers.create', compact('tiers', 'list_prices'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputCode'=>'required',
            'inputCodeP'=>'required|numeric|Min:0',
            'inputPhone'=>'required|numeric|Min:0',
            'inputEmail'=>'required|email',
            'delai'=>'required|numeric|Min:0',

    ]);
        $tier = $company->tiers()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'code'=>$request->inputCode,
            'adresse'=>$request->inputAdresse,
            'code_postal'=>$request->inputCodeP,
            'pays'=>$request->inputPays,
            'phone'=>$request->inputPhone,
            'Email'=>$request->inputEmail,
            'web'=>$request->inputWeb,
            'list_price_id'=>$request->inputList_prices_id,
            'delai'=>$request->delai,
        ]);
        session()->flash('message','Fournisseur ajouté avec succès !');
        return redirect()->route('tiers.show',["tier"=>$tier->id]);
    }

    public function edit($id)
    {
        $tier = Tier::find($id);
        if(! $tier)
        {
            return redirect()->route('tiers.index');
        }
        $list_prices = ListPrice::All();
        return view('tiers.edit', compact('tier', 'list_prices'));
    }

    public function update(Request $request,$id)
    {
        /*$Tier->update($this->ValidateData()); */

        $this->validate($request,[
            'inputName'=>'required',
            'inputCode'=>'required',
            'inputCodeP'=>'required|numeric|Min:0',
            'inputPhone'=>'required|numeric|Min:0',
            'inputEmail'=>'required|email',
            'delai'=>'required|numeric|Min:0',
    ]);
        $tier=Tier::findOrFail($id);
        $tier->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'code'=>$request->inputCode,
            'adresse'=>$request->inputAdresse,
            'code_postal'=>$request->inputCodeP,
            'pays'=>$request->inputPays,
            'phone'=>$request->inputPhone,
            'Email'=>$request->inputEmail,
            'web'=>$request->inputWeb,
            'list_price_id'=>$request->inputList_prices_id,
            'delai'=>$request->delai,
        ]);
        session()->flash('message','Le fournisseur a était mis à jour avec succès !');
        return redirect()->route('tiers.show',["tier"=>$tier->id]);
    }

    public function destroy(Tier $Tier)
    {
        $Tier->delete();
        return redirect()->route('tiers.index');
    }
}
