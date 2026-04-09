<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Barryvdh\Debugbar\Facade as DebugBar;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Student::orderBy('created_at', 'desc')->get();

        Debugbar::info($users);
        return view('users', ["users" => $users]);
        //return view('users')->with($users);
    }
}
