<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Homepagebanner;
use Barryvdh\Debugbar\Facade as DebugBar;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner = Homepagebanner::all()->first();
        Debugbar::info($banner->file_path);

        return view('home', ["banner" => $banner->file_path]);
    }
}
