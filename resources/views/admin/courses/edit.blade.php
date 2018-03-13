@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Course</div>
                    <div class="panel-body">


                        <form action="{{route('admin.courseUpdate',['id'=> $course->id])}}" class="" method="post">

                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <div class="form-group">
                                <label for="courseID">Course ID</label>
                                <input class="form-control" type="text" name="courseID" value="{{$course->courseID}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Course Name</label>
                                <input class="form-control" type="text" name="name" value="{{$course->name}}">
                            </div>
                            <div class="form-group">
                                <label for="collageName"> Collage Name</label>
                                <select name="collageName" id="" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($collages as $collage)
                                        <option value="{{$collage->id}}" {{($collage->id = $course->collageId)?'selected':''}}>  {{$collage->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="departmentName"> Department Name</label>
                                <select name="departmentName" id="" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{($department->id = $course->departmentId)?'selected':''}}>  {{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


