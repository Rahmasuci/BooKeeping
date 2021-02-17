<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        // dd($user);
        $name = Auth::user()->name;
        $data = ['name' => $name];
        
        return Inertia::render('User/Index', $data);
    }
}
