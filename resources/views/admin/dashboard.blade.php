@extends('layout.app')

@section('content')
    @include('layout.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Latest 5 courses</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/courses" class="btn btn-sm btn-primary">All courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Course image</th>
                                    <th scope="col">details</th>
                                    <th scope="col">Creation date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <th scope="row">
                                         <div >
                                            @if($course->photo)
                                           <img src="/images/{{ $course->photo->filename }}" class="card-img-top" alt="Course image">
                                            @else
                                            <img src="/images/1.jpg" class="card-img-top" alt="Course image">
                                            @endif
                                        </div>
                                         
                                    </th>
                                 
                                    <td>
                                        <h6>{{$course->title}}</h6>
                                         <h6>{{$course->track->name }}</h6>

                                        <span class="{{ $course->status == 0 ? 'text-info' : 'text-danger' }}"> {{ $course->status == 0 ? 'FREE' : 'PAID' }}</span>
                                    </td>
                                    <td>
                                        {{$course->created_at->diffForhumans()}}
                                    </td>

                                </tr>
                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Latest 10 tracks</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/tracks" class="btn btn-sm btn-primary">All tracks</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Track name</th>
                                    <th scope="col">No.courses</th>
                                    <th scope="col">Creation date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tracks as $track)
                                <tr>
                                    <th scope="row">
                                        {{$track->name}}
                                    </th>
                                    <td>
                                        {{count($track->courses)}}
                                    </td>
                                     <td>
                                        {{$track->created_at->diffForhumans()}}
                                    </td>
                                   @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="row mt-5">
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Latest 5 users</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/users" class="btn btn-sm btn-primary">All users</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">User name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Score</th>
                                </tr>
                            </thead>

                            <tbody>
                                 @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        {{$user->name}}
                                    </th>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                     <td>
                                        {{$user->score}}
                                    </td>
                                   @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Latest 5 quizzes</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/quizzes" class="btn btn-sm btn-primary">All quizzes</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Quiz name</th>
                                    <th scope="col">Course name</th>
                                    <th scope="col">Creation date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                <tr>
                                    <th scope="row">
                                        {{$quiz->name}}
                                    </th>
                                    <td>
                                        {{$quiz->course->title}}
                                    </td>
                                     <td>
                                        {{$track->created_at->diffForhumans()}}
                                    </td>
                                   @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>

        @include('layout.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush