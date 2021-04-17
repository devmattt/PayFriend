<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
   public function index()
   {
       return view('auth.register');
   }

   public function store(Request $request)
   {
       $this->validate($request, [
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required|confirmed'
       ]);

       try {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       } catch (\Illuminate\Database\QueryException $exception) {
        return back()->withError('That user already exists.' . $request->input('user_id'))->withInput();
       }



       auth()->attempt($request->only('email','password'));

       return redirect()->route('dashboard');
   }
}
