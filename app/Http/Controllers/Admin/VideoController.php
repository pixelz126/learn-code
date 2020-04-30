<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;

class VideoController extends Controller
{
    
    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

  
    public function create()
    {
        return view('admin.videos.create');

    }

   
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:10|max:100',
            'link' => 'required|url|',
            'course_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $video = Video::create($request->all());

        if ($video) 
        {
            return redirect('/admin/videos')->withStatus('Video suuccefully created');
        }
        else
        {
            return redirect('/admin/videos/create')->withStatus('Something went wrong, Try again');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }


    public function update(Request $request, Video $video)
    {
        
        $rules = [
            'title' => 'required|min:10|max:100',
            'link' => 'required|url|',
            'course_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        if ($video->update($request->all())) 
        {
            return redirect('/admin/videos')->withStatus('Video suuccefully updated');
        }
        else
        {
            return redirect('/admin/videos/'.$video->id.'/edit')->withStatus('Something went wrong...');
        }
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect('/admin/videos')->withStatus('Video suuccefully deleted');
    }
}
