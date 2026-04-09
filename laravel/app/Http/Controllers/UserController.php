<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $questions = Question::all();

        // $grouped = $questions->groupBy('personalitytype');

        // $questions = Question::select('personalitytype', \DB::raw('count(*) as total'))->groupBy('personalitytype')->pluck('total', 'personalitytype')->all();

        // $questions = Question::groupBy('personalitytype')
        //     ->selectRaw('count(*) as total, personalitytype')
        //     ->get();
        // dd($grouped);
        return view('userdashboard');
    }
}
