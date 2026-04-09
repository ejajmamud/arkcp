<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Occupations;

class OccupationsController extends Controller
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
        $occupations = Occupations::all();
        return view('occupations', ["occupations" => $occupations]);
    }
    public function store(Request $request)
    {
        $occupation = new Occupations();
        $occupation->personalitytype = request('personalitytype');
        $occupation->occupationen = request('occupationen');
        $occupation->occupationmalay = request('occupationmalay');
        $occupation->save();

        $occupations = Occupations::all();
        view('occupations', ["occupations" => $occupations]);
        return redirect("/admin/occupations");
    }
    public function edit($id)
    {
        $occupation = Occupations::findOrFail($id);
        return view('/admin/occupationedit', ["occupation" => $occupation]);
    }
    public function destroy($id)
    {
        $occupation = Occupations::findOrFail($id);
        $occupation->delete();
        return redirect("/admin/occupations");
    }
}