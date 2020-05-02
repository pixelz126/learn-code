<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Track;

class TrackCourseContraller extends Controller
{
       public function create(Track $track)
    {
        return view('admin.tracks.createCourse', compact('track'));
    }
}
