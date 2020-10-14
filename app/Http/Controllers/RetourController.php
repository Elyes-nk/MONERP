<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;
use App\ListPrice;
use App\ProductUnity;
use App\Taxe;
use App\CategoryProduct;
class RetourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sequences');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receptions=Reception::where('type','out')->get();

        return view('retour.index',compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reception=Reception::find($id);
        if(! $reception)
        {
            return redirect()->route('retour.index');
        }
        $id_next=Reception::where('id','<',$id)->where('type',"out")->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Reception::where('type',"out")->first();
        }
        $id_previous= Reception::where('id','>',$id)->where('type',"out")->first();
        if(!$id_previous){
            $id_previous = Reception::where('type',"out")->first();
        }
        $Taxes = Taxe::All();
        $Product_unities = ProductUnity::All();
        $Category_products = CategoryProduct::All();
        $list_prices = ListPrice::All();
        return view('retour.show',compact('reception','id_next','id_previous','Taxes','Product_unities','Category_products','list_prices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reception=Reception::find($id);
        $reception->update([
            "state"=>"Livré"
        ]);
        foreach($reception->reception_lines as $line){
            $line->update([
                "state"=>"Livré"
            ]);
        }
        return redirect()->route("retour.show",['retour'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reception=Reception::find($id);
        foreach($reception->reception_lines as $line){


            $line->delete();

        }

        $reception->delete();
        session()->flash('message','La Livraison a était supprimée avec succès !');
        return redirect()->route('retour.index');
    }

    public function pdf(Reception $reception, $id)
    {
        $reception=Reception::find($id);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('retour.pdf', compact('reception')));
        return $pdf->stream();
    }
}
