@extends('layouts.app')

@section('content')
    {{--section for instructor--}}
    @can('users_manage')
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Question view</div>
                    <div class="panel-body">
                        @foreach($question as $question)



                        <p>
                            This question is created at : <b>{{$question->created_at->todatestring()}}</b>
                        </p>

                        <p>
                            Title: <b>{{$question->title}}</b>
                        </p>
                        <p>
                            Message body: <b>{{$question->message}}</b>
                        </p>
                        <p>
                            Name of the course: <b>{{$question->course->name}}</b>
                        </p>

                            <h4> Request by: <b>{{$question->instructor->name}}</b></h4>
                            
                            <p>Attachment:</p>
                            
                            <div id="help_img" style="
    max-width: 50%;

">
                                <img src="{{url('helpdesk/images/'.$question->attachment)}}" alt="" style="
    max-width: 100%;
">
                            </div>



                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection