<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('User/Index', [
                'users' => User::all(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('User/Create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',  "No access");
        else{
            Request::validate([
                'name' => ['required', 'min:3'],
                'email' => ['required','email','unique:users,email'],
                'password' => ['required','string','min:6','confirmed'],
                'role' => ['required'],
            ]);

            User::create([
                'name' => Request::get('name'),
                'email' => Request::get('email'),
                'password' =>  Hash::make(Request::get('password')),
                'role' => Request::get('role'),
            ]);
            return Redirect::route('user.index')->with('success',"User added");
        }
    }

    public function edit(User $user)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('User/Edit', [
                'user' => $user,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',"No access");
        else{
            Request::validate([
                'name' => ['required', 'min:3'],
                'email' => ['required','email','unique:users,email,'.$user->id,],
                'role' => ['required'],
                'password' => ['confirmed'],
            ]);
            $user->update([
                'name' => Request::get('name'),
                'email' => Request::get('email'),
                'role' => Request::get('role'),
            ]);
            if(Request::get('password') !== null){
                $user->update([
                    'password' =>  Hash::make(Request::get('password')),
                ]);
            }
            return Redirect::route('user.index')->with('success', "User edited");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',"No access");
        else{
            $user->delete();
            return Redirect::route('user.index')->with('success', "User deleted");
        }
    }
}
