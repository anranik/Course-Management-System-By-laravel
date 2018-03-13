@extends('layouts.app')



@section('content')

    @can('course_builder')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses Request</div>
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


                        <p></p>
                        <table id="coursesTable" class="table table-bordered">

                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Request Type</th>
                                <th>Waiting time</th>
                                <th>Action</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($data as $single)


                                    <tr>
                                    <td><form action="{{route('admin.course_builderAssignTo', ['id' => $single->id])}}" method="post">
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                        {{$i++}}
                                    </td>
                                    <td>
                                        @foreach ($single->course()->pluck('id') as $name)
                                            {{$name}}
                                        @endforeach</td>
                                    <td>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($single->instructor()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                       {{ucfirst($single->requestType)}}
                                    </td>
                                    <td>
                                       {{$single->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{$single->id}}">
                                        <button type="submit" class="btn btn-primary">Edit Request</button>
                                </form>
                                    </td>
                                </tr>

                            @endforeach
                            @if(count($data) === 0)
                                <tr>
                                    <td colspan="8" style="text-align: center"><h1 class="info">No record found</h1></td>
                                </tr>
                            @endif
                        </table>
                    </div>



                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses</div>
                    <div class="panel-body">


                        <p></p>
                        <table id="coursesTable" class="table table-bordered">

                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Status</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($my_courses as $single)


                                <tr>
                                    <td>
                                        {{$i++}}
                                    </td>
                                    <td>
                                        @foreach ($single->course()->pluck('id') as $name)
                                            {{$name}}
                                        @endforeach</td>
                                    <td>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($single->instructor()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ucfirst($single->status)}}
                                    </td>


                                </tr>

                            @endforeach
                            @if(count($my_courses) === 0)
                                <tr>
                                    <td colspan="6" style="text-align: center"><h1 class="info">No record found</h1></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endcan
    {{--end section for instructor--}}


@endsection

{{--active courses--}}
