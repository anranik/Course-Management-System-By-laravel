@extends('layouts.app')



@section('content')

    @can('instructor')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All Course Request ( Pending and Activated )</div>
                    <div class="panel-body">
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

                        <div class="box-default text-right">
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.ecourseRequestRoute')}}">Add new Course Request</a>

                        </div>
                        <p></p>
                        <table id="coursesTable" class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Course Builder</th>
                            </tr>
                            <?php $i =1; ?>
                            @foreach($data as $single)
                                @if($single->status != 'canceled')
                                <form action="{{route('admin.editRequestByInstructor',['id' => $single->id])}}" method="post">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                                    <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        @foreach ($single->course()->pluck('courseID') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                       {{ucfirst($single->status)}}
                                    </td>
                                    <td>
                                        @foreach ($single->builder()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                </tr>
                                </form>
                                @endif
                            @endforeach

                            @if(count($data) === 0)
                                <tr>
                                    <td colspan="6" style="text-align: center"><h1 class="info">No record found</h1></td>
                                </tr>
                            @endif
                        </table>
<br>

<h2>Course by other instructor</h2>






                        <table class="table table-bordered">
                            <tr>

                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Request by</th>
                                <th>Course Builder</th>
                            </tr>
                            @foreach($all as $key => $single)
                                <?php
                                $b = unserialize($single->otherInstructor);
                                ?>
                                @if(is_array($b) && in_array(Auth::id(),$b))
                                    <tr>
                                        <td>
                                            @foreach ($single->course()->pluck('courseID') as $name)
                                                {{$name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($single->course()->pluck('name') as $name)
                                                {{$name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ucfirst($single->status)}}
                                        </td>
                                        <td>
                                            @foreach ($single->instructor()->pluck('name') as $name)
                                                {{$name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($single->builder()->pluck('name') as $name)
                                                {{$name}}
                                            @endforeach
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

                {{--Cancelled Course--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Cancelled Course</div>
                    <div class="panel-body">
                        <table id="coursesTable" class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Course Builder</th>
                                <th>Action</th>
                            </tr>
                            <?php $j =1; ?>
                            @foreach($data as $single)
                                @if($single->status == 'canceled')
                                <form action="{{route('admin.editRequestByInstructor',['id' => $single->id])}}" method="post">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                                    <tr>
                                    <td>{{$j++}}</td>
                                    <td>
                                        @foreach ($single->course()->pluck('courseID') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                       {{ucfirst($single->status)}}
                                    </td>
                                    <td>
                                        @foreach ($single->builder()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{$single->id}}">


                                            <button type="submit" class="btn btn-primary">Reactive Request</button>

                                    </td>
                                </tr>
                                </form>
                                @endif
                            @endforeach

                            @if(count($data) === 0)
                                <tr>
                                    <td colspan="6" style="text-align: center"><h1 class="info">No record found</h1></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                {{--upcomeing event--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Upcoming workshop</div>
                    <div class="panel-body">

                            @foreach($events as $single)
                            <input type="text" readonly value="{{$single->title." - ".$single->dateFrom}}" class="form-control"><br>

                            @endforeach

                                @if(count($events) === 0)

                                        <h1 class="info">No record found</h1>

                                @endif

                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}


@endsection