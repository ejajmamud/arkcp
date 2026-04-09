<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionseditController extends Controller
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
        $question = Question::findOrFail($id);
        // return $question;
        return view('questionsedit', ["question" => $question]);
    }
    public function store(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->personalitytype = request('personalitytype');
        $question->questionen = request('questionen');
        $question->questionmalay = request('questionmalay');
        $question->save();

        $questions = Question::all();
        view('questions', ["questions" => $questions]);
        return redirect("/admin/questions");
    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect("/admin/questions");
    }
}
