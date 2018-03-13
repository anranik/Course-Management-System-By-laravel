@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Years and Semester</div>
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

                            <div class="col-md-6">

                                <table  class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of the year</th>
                                        <th>Info</th>
                                        <th>Action</th>
                                    </tr>
                                <?php $i =1; ?>
                                    @foreach($years as $year)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$year->year}}</td>
                                            <td>{{($year->isCurrent == 1)?'Current year':'No'}}</td>
                                            <td  style="width: 30%;">

                                                <form style="display:inline" method="post" action="{{route('admin.yearEdit',['id'=>$year->id])}}">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                                <form style="display:inline" method="post" action="{{route('admin.yearDelete',['id' => $year->id,])}}" onsubmit="return ConfirmDelete()">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="3">
                                            <form method="post" action="{{route('admin.yearAdd')}}">
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                                <div class="col-md-4">
                                                    <label for="current">
                                                        Current Semester <input type="checkbox" name="current" value="1">
                                                    </label>
                                                </div>
                                                <div class="input-group col-md-8">
                                                    <input type="text" class="form-control" name="year">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit" id="addSemesterBtn">Add Year!</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">

                                <table  class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of Semester</th>
                                        <th>Info</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $j = 1; ?>
                                    @foreach($semesters as $semester)
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$semester->semester}}</td>
                                            <td>{{($semester->isCurrent == 1)?'Current semester':'No'}}</td>
                                            <td style="width: 30%;">

                                                <form style="display:inline" method="post" action="{{route('admin.semesterEdit',['id'=>$semester->id])}}">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                                <form style="display:inline"  method="post" action="{{route('admin.semeterDelete',['id' => $semester->id,])}}" onsubmit="return ConfirmDelete()">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                            <form method="post" action="{{route('admin.semesterAdd')}}">
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                                <div class="col-md-4">
                                                    <label for="current">
                                                    Current Semester <input type="checkbox" name="current" value="1">
                                                    </label>
                                                </div>
                                                <div class="input-group col-md-8">
                                                    <input type="text" class="form-control" name="semester">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit" id="addSemesterBtn">Add Semester!</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}

@endsection


@section('javascript')
    <script>
            function ConfirmDelete()
            {
                var x = confirm("Are you sure you want to delete?");
                if (x)
                    return true;
                else
                    return false;
            }

    </script>
@endsection



