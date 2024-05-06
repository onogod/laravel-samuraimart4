<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function mypage() 
    {
        $user = Auth::user();

        return view('users.mypage',compact('user'));
    }
    /**
     * Display a listing of the resource.
     */
  /*  public function index()
    {
        //
    } */

    /**
     * Show the form for creating a new resource.
     */
   /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     */
/*    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
 /*   public function show(User $user)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
        $user->address = $request->input('address') ? $request->input('address') : $user->address;
        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->update();

        return to_route('mypage');
    }

    /**
     * Remove the specified resource from storage.
     */
 /*   public function destroy(User $user)
    {
        //
    }*/
    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();

        if ($request->input('password') == $request->input('password_confirmation')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else {
            return to_route('mypage.edit_password');
        }
        return to_route('mypage');
    }
    public function edit_password()
    {
        return view('users.edit_password');
    }
    public function favorite()
    {
        $user = Auth::user();

        $favorite_products = $user->favorite_products;

        return view('users.favorite',compact('favorite_products'));
    }
    public function destroy(Request $request)
    {
        Auth::user()->delete();
        return redirect('/');
    }
}
