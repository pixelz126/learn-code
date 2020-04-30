<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quiz;

class QuizController extends Controller
{
    
    public function index()
    {
        $quizzes = Quiz::orderBy('id', 'desc')->paginate(10);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

   
    public function store(Request $request)
    {
         $rules = [
            'name' => 'required | min:5 | max:50',
            'course_id' => 'required|integer'
        ];
        $this->validate($request, $rules);
        
        if (Quiz::create($request->all())) 
        {
            return redirect('/admin/quizzes')->withStatus('Quiz successfully created');
        }
        else
        {
            return redirect('/admin/quizzes/create')->withStatus('Something went wrong, Try again');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    
    public function update(Request $request, Quiz $quiz)
    {
        $rules = [
            'name' => 'required | min:5 | max:50',
            'course_id' => 'required|integer'
        ];
        $this->validate($request, $rules);
        
        if ($quiz->update($request->all())) 
        {
            return redirect('/admin/quizzes')->withStatus('Quiz successfully updated');
        }
        else
        {
            return redirect('/admin/quizzes/'.$quiz->id.'/edit')->withStatus('Something went wrong...');
        }
    }

  
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect('/admin/quizzes')->withStatus('Quiz successfully deleted');
    }
}
