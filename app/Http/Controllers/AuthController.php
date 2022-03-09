<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function makeHash(){
        return Hash::make('plain-text');
    }
}
