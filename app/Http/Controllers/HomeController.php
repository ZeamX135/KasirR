<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $usertype = Auth()->user()->usertype;

            if($usertype == 'petugas')
            {
                return view('dashboard');
            }
            elseif($usertype == 'admin')
            {
                return redirect('/admin/dashboard');
            }
            else{
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
    }
}

