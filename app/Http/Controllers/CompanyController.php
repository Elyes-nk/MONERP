<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $company=Company::findOrFail($id);
        if(! $company)
        {
            return redirect()->route('company.index');
        }
        return view('company.show',compact('company'));
    }

    public function edit($id)
    {
        $company=Company::findOrFail($id);
        if(! $company)
        {
            return redirect()->route('company.index');
        }
        return view('company.edit',compact('company'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'inputName'=>'required',

       ]);
       $company=Company::findOrFail($id);
            $company->update([
                'name'=>$request->inputName,
                'adresse'=>$request->adresse,
                'code_postal'=>$request->code_postal,
                'ville'=>$request->ville,
                'pays'=>$request->pays,
                'email'=>$request->email,
                'web'=>$request->web,
                'pdg'=>$request->pdg,
                'capital'=>$request->capital,
                'rc'=>$request->rc,
                'nif'=>$request->nif,
                'nis'=>$request->nis,
                'art'=>$request->art,
                'rib'=>$request->rib,
            ]);
        session()->flash('message','La compagnie a était mise à jour avec succès !');
        return  redirect()->route('company.show',["company"=>$id]);
    }

}
