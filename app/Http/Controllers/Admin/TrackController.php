<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Track;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::orderBy('id', 'desc')->paginate(10);
        return view('admin.tracks.index', compact('tracks'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        // return all courses related to this class
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return view('admin.tracks.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect('/admin/tracks')->withStatus('Track successfully deleted');
    }
}
