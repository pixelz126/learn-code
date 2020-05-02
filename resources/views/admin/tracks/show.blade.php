@extends('layout.app', ['title' => __('Courses Management')])

@section('content')
    @include('layout.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                     <div class="card-header border-0">
                            <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $track->name }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/admin/tracks/{{ $track->id}}/courses/create" class="btn btn-sm btn-primary">{{ __('Add course') }}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                   @include('includes.errors')
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
    
                    @if(count($track->courses))

                    <div class="row p-1">
                        @foreach($track->courses as $course)
                        <div class="col-sm-4 mt-2">
                            <div class="card" style="width: 18rem;">
                            @if($course->photo)
                             <img src="/images/{{ $course->photo->filename }}" class="card-img-top" alt="Course image"> 
                              @else
                              <img src="/images/1.jpg" class="card-img-top" alt="Course image">
                               @endif
                              <div class="card-body">

                                <form method="POST" action="{{ route('courses.destroy', $course) }}">
                                    @csrf
                                    @method('DELETE')
                                        <h5 class="card-title">{{ $course->title }}</h5>
                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">Show course</a>
                                    <input type="submit" value="Delete" name="Deletecourse" class="btn btn-sm btn-danger">
                                </form>

                                
                              </div>
                            </div>
                        </div>
                        @endforeach    
                    </div>

                    
                    @else
                    <p class="lead text-center">No Courses Fonud</p>s
                    @endif
               
                </div>
            </div>
        </div>
            
        @include('layout.footers.auth')
    </div>
@endsection