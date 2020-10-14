<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Taxe;
use App\Company;
use Auth;
use PDF;

class TaxesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taxes = Taxe::All();
        //$taxes = taxes::where('notes',$request->query('notes','pas null'))->get();
        return view('taxes.index', compact('taxes'));
    }

    public function show(Taxe $taxe, $id)
    {
        //dd($taxe);
        $taxe=Taxe::find($id);
        if(! $taxe)
        {
            return redirect()->route('taxes.index');
        }
        $id_next=Taxe::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Taxe::first();
        }
        $id_previous=Taxe::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Taxe::first();
        }
        return view('taxes.show', compact('taxe','id_next','id_previous'));
    }

    public function create()
    {
        $taxe = new Taxe();
        return view('taxes.create', compact('taxe'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputTaux'=>'required|numeric|Min:0',
    ]);

        $taxe = $company->taxes()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'taux'=>$request->inputTaux,
        ]);
        session()->flash('message','Taxe crée avec succès !');
        return redirect()->route('taxes.show',["tax"=>$taxe->id]);
    }

    public function edit($id)
    {
        $taxe=Taxe::findOrFail($id);
        if(! $taxe)
        {
            return redirect()->route('taxes.index');
        }
        return view('taxes.edit', compact('taxe'));
    }

    public function update(Request $request,$id)
    {
        /*$taxe->update($this->ValidateData()); */
        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputTaux'=>'required|numeric|Min:0',
    ]);
        $taxe=Taxe::findOrFail($id) ;
        $taxe->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'taux'=>$request->inputTaux,
        ]);
        session()->flash('message','La taxe a était mise à jour avec succès !');
        return redirect()->route('taxes.show',["tax"=>$taxe->id]);
    }

    public function destroy(Taxe $taxe, $id)
    {
        $taxe=Taxe::find($id);
        $taxe->delete();
        return redirect()->route('taxes.index');
    }
}
