<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id)
    {
        $profile = User::findOrFail($id);
        if(! $profile)
        {
            return redirect()->route('profile.index');
        }
        return view('profile.show', compact('profile'));
    }

    public function edit($id)
    {
        $profile = User::findOrFail($id);
        if(! $profile)
        {
            return redirect()->route('profile.index');
        }
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request,$id)
    {
        $company=Company::first();
        $this->validate($request,[
            'inputName'=>['required', 'string', 'max:255'],
            'inputEmail'=>['required', 'string', 'email', 'max:255'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8'
        ]);
        $profile=User::findOrFail($id);
        $profile->update([
            'name'=>$request->inputName,
            'email'=>$request->inputEmail,
            'password' => Hash::make($request->password)
        ]);
        session()->flash('message','Votre profile a était mis à jour avec succès !');
        return redirect()->route('profile.show',["profile"=>$profile->id]);
    }

    public function destroy(User $profile)
    {
        $profile->delete();
        return redirect()->route('profile.show');
    }
}
