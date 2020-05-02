<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Photo;

class CourseController extends Controller
{
   
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

   
    public function create()
    {
        return view('admin.courses.create');
    }

 
    public function store(Request $request)
    {
        $rules = [

            'title' => 'required|min:8|max:50',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer'
        ];

        $this->validate($request, $rules);

        $course = Course::create($request->all());
        if ($course) 
        {
            // Insert the image
            if ($file = $request->file('image')) 
            {
                $filename = $file->getClientOriginalName();
                $fileExe = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] .'_.'.$fileExe;

                if ($file->move('images', $file_to_store)) 
                {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course',
                    ]);
                }
            }
            return redirect('/admin/courses')->withStatus('Course succeffully inserted');
        }
    }

 
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }


    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }


    public function update(Request $request, Course $course)
    {
        $rules = [

            'title' => 'required|min:8|max:50',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer'
        ];

        $this->validate($request, $rules);

        $course->update($request->all());
    
            // Insert the image
            if ($file = $request->file('image')) 
            {
                $filename = $file->getClientOriginalName();
                $fileExe = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] .'_.'.$fileExe;

                if ($file->move('images', $file_to_store)) 
                {
                    if ($course->photo) 
                    {
                        $photo = $course->photo;

                        $filename = $photo->filename;
                        unlink('images/'.$filename); 

                        $photo->filename = $file_to_store;
                        $photo->save();
                    }
                    else
                    {
                         Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course',
                    ]);

                    }

                }
            }
            return redirect('/admin/courses')->withStatus('Course succeffully updated');
    }

    
    public function destroy(Course $course)
    {
        if ($course->photo) 
        {
            $filename = $course->photo->filename;
            unlink('images/'.$filename); 
        }
        $course->photo->delete();
        $course->delete();
        return redirect('/admin/courses')->withStatus('Course succeffully deleted');
    }
}
