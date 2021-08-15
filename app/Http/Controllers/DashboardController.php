<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function users()
    {
        return view('users');
    }

    public function books()
    {
        return view('books');
    }


}
