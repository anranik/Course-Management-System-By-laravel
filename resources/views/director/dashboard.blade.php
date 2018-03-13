@extends('layouts.app')



@section('content')

    @can('director')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses Request</div>
                    <div class="panel-body">


                        <table id="coursesTable" class="table table-bordered">

                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Instructor</th>
                                <th>Waiting time</th>
                                <th>Action</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($data as $single)


                                    <tr>
                                    <td><form action="{{route('admin.viewCourseDirector', ['id' => $single->id])}}" method="post">
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                        {{$i++}}
                                    </td>
                                    <td>
                                        {{$single->courseId}}
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
                                       {{$single->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">VIew Request</button>
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
                                <th>Builder</th>
                                <th>Request Date</th>
                                <th>Status</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($all_courses as $single)


                                <tr>
                                    <td>
                                        {{$i++}}
                                    </td>
                                    <td>
                                        {{$single->courseId}}
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
                                        @foreach ($single->builder()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ucfirst($single->created_at)}}
                                    </td>
                                    <td>
                                        {{ucfirst($single->status)}}
                                    </td>


                                </tr>

                            @endforeach
                            @if(count($all_courses) === 0)
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
