<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sequence;
use App\Company;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function generate_sequences(){
        $company=Company::first();
        $company->sequences()->createMany([
        [
            "user_id"=>Auth::user()->id,
            "name"=>"Achat",
            "origin"=>"orders",
            "next_number"=>1,
            "increment"=>1,
            "remplissage"=>3
        ],
        [
            "user_id"=>Auth::user()->id,
            "name"=>"Facture",
            "origin"=>"invoice",
            "next_number"=>1,
            "increment"=>1,
            "remplissage"=>3
        ],
        [
            "user_id"=>Auth::user()->id,
            "name"=>"Reception",
            "origin"=>"reception",
            "next_number"=>1,
            "increment"=>1,
            "remplissage"=>3
        ],
        [
            "user_id"=>Auth::user()->id,
            "name"=>"Paiement",
            "origin"=>"voucher",
            "next_number"=>1,
            "increment"=>1,
            "remplissage"=>3

        ],
        [
            "user_id"=>Auth::user()->id,
            "name"=>"Réapprovisionnement",
            "origin"=>"replishippement",
            "next_number"=>1,
            "increment"=>1,
            "remplissage"=>3

        ]
            ]
    );
    return redirect()->route('sequences.index');

    }
}
