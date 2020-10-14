<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Company;
use \App\ProductUnity;
use Auth;


class UnityProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $unityProducts = ProductUnity::All();
        return view('unityProducts.index', compact('unityProducts'));
        //dd($unityProducts);
    }

    public function show($id)
    {
        $unityProduct=ProductUnity::find($id);
        $id_next=ProductUnity::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = ProductUnity::first();
        }
        $id_previous=ProductUnity::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = ProductUnity::first();
        }
        if(! $unityProduct)
        {
            return redirect()->route('unityProducts.index');
        }
        return view('unityProducts.show', compact('unityProduct','id_next','id_previous'));

    }

    public function create()
    {
        $unityProduct = new ProductUnity();
        return view('unityProducts.create', compact('unityProduct'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',

    ]);
        $unityProduct = $company->unities()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
        ]);
        session()->flash('message','Unité ajouté avec succès !');
        return redirect()->route('unityProducts.show',["unityProduct"=>$unityProduct->id]);
    }

    public function edit ($id)
    {
        $unityProduct = ProductUnity::find($id);
        if(! $unityProduct)
        {
            return redirect()->route('unityProducts.index');
        }
        return view('unityProducts.edit', compact('unityProduct'));
    }

    public function update(Request $request,$id)
    {
        /*$unityProduct->update($this->ValidateData()); */

        $this->validate($request,[
            'inputName'=>'required',
    ]);
    $unityProduct=ProductUnity::findOrFail($id);
        $unityProduct ->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
        ]);
        session()->flash('message','L\'unité a était mis à jour avec succès !');
        return redirect()->route('unityProducts.show',["unityProduct"=>$unityProduct->id]);
    }

    public function destroy(ProductUnity $unityProduct)
    {
        $unityProduct->delete();
        return redirect()->route('unityProducts.index');
    }
}
