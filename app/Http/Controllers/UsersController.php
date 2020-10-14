<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = user::All();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user=User::find($id);
        $id_next=User::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = User::first();
        }
        $id_previous=User::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = User::first();
        }
        if(! $users)
        {
            return redirect()->route('users.index');
        }
        return view('users.show', compact('user','id_next','id_previous'));

    }

    public function create()
    {
        $user = new user();
        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'Email', 'max:255', 'unique:users'],
            'inputRole'=>'required',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8'
    ]);

        $user = User::create([
            'company_id'=>$company->id,
            'name'=>$request->inputName,
            'email'=>$request->email,
            'role'=>$request->inputRole,
            'password' => Hash::make($request->password)
        ]);
        session()->flash('message','Utilisateur crée avec succès !');

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user=user::find($id);
        if(! $user)
        {
            return redirect()->route('users.index');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
        /*$user->update($this->ValidateData()); */

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>['required', 'string', 'max:255'],

            'inputRole'=>'required',
    ]);

        $user=user::findOrFail($id) ;
        $user->update([
            'name'=>$request->inputName,

            'role'=>$request->inputRole,
        ]);
        session()->flash('message','l\'utilisateur à était mis à jour avec succès !');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        //dd($user);
        $user->delete();
        return redirect()->route('users.index');
    }
}
