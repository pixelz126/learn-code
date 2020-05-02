<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
class QuestionController extends Controller
{
    
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    
    public function create()
    {
        return view('admin.questions.create');
    }

   
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:10|max:300',
            'answers' => 'required|min:10|max:300',
            'right_answer' => 'required|min:3|max:30',
            'score' => 'required|integer|min:5|max:30',
            'quiz_id' => 'required|integer|'
        ];

        $this->validate($request, $rules);

        if(Question::create($request->all()))
        {
            return redirect('/admin/questions')->withStatus('Question succeefully ctraeted');
        }
        else
        {
            return redirect('/admin/questions/create')->withStatus('Something went worng, try again');

        }

    }



    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    
    public function update(Request $request, Question $question)
    {
        $rules = [
            'title' => 'required|min:10|max:300',
            'answers' => 'required|min:10|max:300',
            'right_answer' => 'required|min:3|max:30',
            'score' => 'required|integer|min:5|max:30',
            'quiz_id' => 'required|integer|'
        ];

        $this->validate($request, $rules);

        if($question->update($request->all()))
        {
            return redirect('/admin/questions')->withStatus('Question succeefully updated');
        }
        else
        {
            return redirect('/admin/questions/'. $question->id .'/edit')->withStatus('Something went worng, try again');

        }
    }

    
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/admin/questions')->withStatus('Question succeefully deletd');
    }
}
