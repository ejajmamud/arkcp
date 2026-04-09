<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionsController extends Controller
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
        $questions = Question::all();
        return view('questions', ["questions" => $questions]);
    }
    public function store(Request $request)
    {
        $question = new Question();
        $question->personalitytype = request('personalitytype');
        $question->questionen = request('questionen');
        $question->questionmalay = request('questionmalay');
        $question->save();

        $questions = Question::all();
        view('questions', ["questions" => $questions]);
        return redirect("/admin/questions");
    }
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('/admin/questionedit', ["question" => $question]);
    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect("/admin/questions");
    }
}
