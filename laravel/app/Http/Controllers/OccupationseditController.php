<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Occupations;

class OccupationseditController extends Controller
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
    public function index($id)
    {
        $occupation = Occupations::findOrFail($id);
        // return $occupation;
        return view('occupationsedit', ["occupation" => $occupation]);
    }
    public function store(Request $request, $id)
    {
        $occupation = Occupations::findOrFail($id);
        $occupation->personalitytype = request('personalitytype');
        $occupation->occupationen = request('occupationen');
        $occupation->occupationmalay = request('occupationmalay');
        $occupation->save();

        $occupations = Occupations::all();
        view('occupations', ["occupations" => $occupations]);
        return redirect("/admin/occupations");
    }
    public function destroy($id)
    {
        $occupation = Occupations::findOrFail($id);
        $occupation->delete();
        return redirect("/admin/occupations");
    }
}