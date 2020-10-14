<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sequence;
use Auth;


class SequenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('superuser');
        $this->middleware('auth');
        $this->middleware('sequences');
    }
    public function index()
    {
        $sequences=Sequence::all();
        return  view('sequences.index',compact('sequences'));
    }

    public function show($id)
    {
        $sequence=Sequence::find($id);
        if(! $sequence)
        {
            return redirect()->route('sequences.index');
        }
        $id_next=Sequence::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Sequence::first();
        }
        $id_previous=Sequence::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Sequence::first();
        }
        return view('sequences.show', compact('sequence','id_next','id_previous'));
    }

    public function edit($id)
    {
        $sequence=Sequence::find($id);
        if(! $sequence)
        {
            return redirect()->route('sequences.index');
        }
        return view('sequences.edit', compact('sequence'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'inputName'=>'required',
            'inputNum'=>'required',
            'inputIncrementation'=>'required',
            'inputRemplissage'=>'required'
    ]);
        $sequence=Sequence::findOrFail($id);
        $sequence->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'next_number'=>$request->inputNum,
            'increment'=>$request->inputIncrementation,
            'remplissage'=>$request->inputRemplissage,
            'year'=>!!$request->inputYear,
            'month'=>!!$request->inputMonth,
            'day'=>!!$request->inputDay,
            'time'=>!!$request->inputTime,
        ]);
        return redirect()->route('sequences.show',["sequence"=>$sequence->id]);
    }


}
