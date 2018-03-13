@extends('layouts.app')



@section('content')

    @can('instructor')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Desk</div>
                    <div class="panel-body">
                        <div class="box-default text-right">
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.insHelpCreate')}}">Send New Question</a>

                        </div>
                        <p></p>
                        @if(Session::has('msg'))
                            <div class="alert alert-info">
                                <a class="close" data-dismiss="alert">×</a>
                                <strong>{!!Session::get('msg')!!}</strong>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>Date</th>
                                <th>Question title</th>
                                <th>Question details</th>
                                <th>Course id</th>
                                <th>Status</th>
                            </tr>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{$question->created_at->todatestring()}}</td>
                                    <td>{{$question->title}}</td>
                                    <td>{{$question->message}}</td>
                                    <td>{{$question->course->name}}</td>
                                    <td>{{$question->status}}</td>
                                </tr>
                            @endforeach

                        </table>


                        <h1>Frequently asked questions</h1>

                        @foreach($randomQuestion as $question)
                            <h3><a href="">{{$question->title}}</a></h3>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection
