<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Company;
use \App\CategoryProduct;
use Auth;

class categoryProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categoryProducts = CategoryProduct::orderBy('id','desc')->get();
        return view('categoryProducts.index', compact('categoryProducts'));
    }

    public function show( $id)
    {
        $categoryProduct=CategoryProduct::find($id);
        if(! $categoryProduct)
        {
            return redirect()->route('categoryProducts.index');
        }
        $id_next=CategoryProduct::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = CategoryProduct::first();
        }
        $id_previous=CategoryProduct::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = CategoryProduct::first();
        }
        return view('categoryProducts.show', compact('categoryProduct','id_next','id_previous'));
    }

    public function create()
    {
        $categoryProduct = new CategoryProduct();
        return view('categoryProducts.create', compact('categoryProduct'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',

    ]);
        $categoryProduct = $company->categories()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
        ]);
        session()->flash('message','Catégorie ajouté avec succès !');
        return redirect()->route('categoryProducts.show',["categoryProduct"=>$categoryProduct->id]);    }

    public function edit($id)
    {
        $categoryProduct=CategoryProduct::find($id);
        if(! $categoryProduct)
        {
            return redirect()->route('categoryProducts.index');
        }
        return view('categoryProducts.edit', compact('categoryProduct'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'inputName'=>'required',
    ]);
    $categoryProduct=CategoryProduct::findOrFail($id);
        $categoryProduct ->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
        ]);
        session()->flash('message','La catégorie a était mise à jour avec succès !');
        return redirect()->route('categoryProducts.show',["categoryProduct"=>$categoryProduct->id]);    }

    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        return redirect()->route('categoryProducts.index');
    }
}
