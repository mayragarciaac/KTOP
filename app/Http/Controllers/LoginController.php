<?php

namespace App\Http\Controllers;
use Session;

use Illuminate\Http\Request;
use App\User;
use App\category_list;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('user_id');
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where([['email', $request['user']]])->first();
        
        if (!Hash::check( $request['password'],$user['password'])) 
            return view('/')->with('errors',array("Error en el usuario o la contraseña"));
        Session::put('user_id', $user->id);
        
        return redirect('/category_list');
    }
   
}
