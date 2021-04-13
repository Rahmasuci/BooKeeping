<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $name = Auth::user()->name;
        $category = DB::table('categories')->count();
        $user = DB::table('users')->where('role', 'User')->count();
        $data = [
            'name' => $name,
            'category' => $category,
            'user' => $user,
        ];

        // dd($user);
        
        return Inertia::render('Admin/Index', $data);
    }

    public function user()
    {
        $users = DB::table('users')->where('role', 'User')->get();

        // dd($user);
        
        return Inertia::render('Admin/User', [
            'users' => $users
        ]);
    }
}
