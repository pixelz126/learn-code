@extends('layout.app', ['title' => __('Course Management')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Course list')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Course Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                @if($course->photo)
                               <img src="/images/{{ $course->photo->filename }}" class="card-img-top" alt="Course image">
                                @else
                                <img src="/images/1.jpg" class="card-img-top" alt="Course image">
                                @endif
                            </div>
                            <div class="col-6">
                                <h3>{{ $course->title }}</h3>
                                <h5> <a href="/admin/tracks/{{ $course->track->id}}">{{ $course->track->name }}</a></h5>
                                <span class="{{ $course->status == 0 ? 'text-info' : 'text-danger' }}"> {{ $course->status == 0 ? 'FREE' : 'PAID' }}</span>
                            </div>
                        </div>                     
                    </div>

                </div>

                <div class="table-responsive">


                    <div class="card-header bg-white border-0 mt-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h2 class="mb-0">{{ __('Videos list') }}</h2>
                            </div>
                            <div class="col-4 text-right pull-right">
                                <a href="/admin/courses/{{ $course->id }}/videos/create" class="btn btn-sm btn-primary">{{ __('Add video') }}</a>
                                <a href="/admin/courses/{{ $course->id }}/quizzes/create" class="btn btn-sm btn-success">{{ __('Add Quiz') }}</a>
                            </div>
                          
                        </div>
                    </div>


                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Videos list') }}</th>
                                    <th scope="col">{{ __('Creation date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->videos as $video)
                                    <tr>
                                        <td>
                                            <a href="/admin/videos/{{$video->id}}">
                                                {{ $video->title }}
                                            </a>
                                        </td>
                                        <td>{{ $video->created_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                   
                                                        <form action="{{ route('videos.destroy', $video) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('videos.edit', $video) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                   
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


            </div>
        </div>
        
        @include('layout.footers.auth')
    </div>
@endsection