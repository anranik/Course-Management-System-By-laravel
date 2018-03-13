@extends('layouts.app')

@section('content')
    {{--section for instructor--}}
    @can('users_manage')
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All help questions</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Date</th>
                                        <th>Question title</th>
                                        <th>Question details</th>
                                        <th>Course id</th>
                                        <th>Request by</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td>{{$question->created_at->todatestring()}}</td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->message}}</td>
                                            <td>{{$question->course->name}}</td>
                                            <td>{{$question->instructor->name}}</td>
                                            <td><a href="{{route('admin.adminHelpView',['id'=>$question->id])}}" class="btn btn-primary"> View </a></td>
                                        </tr>
                                    @endforeach


                                </table>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection