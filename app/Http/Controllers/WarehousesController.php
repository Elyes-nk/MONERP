<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Company;
use \App\Warehouse;
use Auth;

class WarehousesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $warehouses = Warehouse::All();
        //$warehouses = warehouses::where('notes',$request->query('notes','pas null'))->get();
        return view('warehouses.index', compact('warehouses'));
    }

    public function show($id)
    {
        $warehouse=Warehouse::find($id);
        $id_next=Warehouse::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Warehouse::first();
        }
        $id_previous=Warehouse::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Warehouse::first();
        }
        if(! $warehouse)
        {
            return redirect()->route('warehouses.index');
        }
        return view('warehouses.show', compact('warehouse','id_next','id_previous'));

    }

    public function create()
    {
        $warehouse = new Warehouse();
        return view('warehouses.create', compact('warehouse'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputAdresse'=>'required',
    ]);
        $warehouse = $company->warehouses()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'adresse'=>$request->inputAdresse,
        ]);
        session()->flash('message','Entrpôt ajouté avec succès !');
        return redirect()->route('warehouses.show',["warehouse"=>$warehouse->id]);
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        if(! $warehouse)
        {
            return redirect()->route('warehouses.index');
        }
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request,$id)
    {
        /*$warehouse->update($this->ValidateData()); */

        $this->validate($request,[
            'inputName'=>'required',
            'inputAdresse'=>'required',
    ]);
    $warehouse=Warehouse::findOrFail($id);
        $warehouse ->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'adresse'=>$request->inputAdresse,
        ]);
        session()->flash('message','L\'entrpôt a était mis à jour avec succès !');
        return redirect()->route('warehouses.show',["warehouse"=>$warehouse->id]);
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouses.index');
    }
}
