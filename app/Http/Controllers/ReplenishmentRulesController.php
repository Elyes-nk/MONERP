<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReplishippementRule;
use App\Warehouse;

class ReplenishmentRulesController extends Controller
{
   public function index()
    {
        $replenishmentRules=ReplishippementRule::all();
        return view('replenishmentRules.index',compact('replenishmentRules'));
    }
    public function show($id)
    {
        $replenishmentRule=ReplishippementRule::find($id);
        if(! $replenishmentRule)
        {
            return redirect()->route('replenishmentRules.index');
        }
        return view('replenishmentRules.show', compact('replenishmentRule'));
    }
    public function edit($id)
    {
        $replenishmentRules=ReplishippementRule::find($id);
        if(! $replenishmentRules)
        {
            return redirect()->route('replenishmentRules.index');
        }
        $warehouses=Warehouse::all();
        return view('replenishmentRules.edit', compact('replenishmentRules','warehouses'));
    }
    public function update(Request $request, $id)
    {
        $replenishmentRule=ReplishippementRule::find($id);
        $this->validate($request,[
            'warehouse'=>'required',

    ]);
        $replenishmentRule->update([
            'warehouse_id'=>$request->warehouse,
        ]);
        return view('replenishmentRules.show', compact('replenishmentRule'));
    }
    public function destroy($id)
    {
       $replenishmentRules=ReplishippementRule::find($id);
       $replenishmentRules->delete();
        return redirect()->route('replenishmentRules.index');
    }
}
