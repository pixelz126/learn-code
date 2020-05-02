<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Track;

class TrackController extends Controller
{
    
    public function index()
    {
        $tracks = Track::orderBy('id', 'desc')->paginate(10);
        return view('admin.tracks.index', compact('tracks'));
    }


    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | min:3 | max:50'
        ];
        $this->validate($request, $rules);
        
        if (Track::create($request->all())) 
        {
            return redirect('/admin/tracks')->withStatus('Track successfully created');
        }
        else
        {
            return redirect('/admin/tracks')->withStatus('Something went wrong, Try again');
        }
    }

    
    public function show(Track $track)
    {
        // return all courses related to this class
        return view('admin.tracks.show', compact('track'));
    }

    
    public function edit(Track $track)
    {
        return view('admin.tracks.edit', compact('track'));
    }


    public function update(Request $request, Track $track)
    {
        $rules = [
            'name' => 'required | min:3 | max:50'
        ];
        $this->validate($request, $rules);
        if ($request->has('name')) 
        {
            $track->name = $request->name;
        }

        if ( $track->isDirty()) 
        {
           $track->save();
           return redirect('/admin/tracks')->withStatus('Track successfully updated');
        }
        else
        {
            return redirect('/admin/tracks/'.$track->id.'/edit')->withStatus('Nothing changed');
        }
    }


    public function destroy(Track $track)
    {
        $track->delete();
        return redirect('/admin/tracks')->withStatus('Track successfully deleted');
    }
}
