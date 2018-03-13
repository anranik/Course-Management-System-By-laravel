@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign To Course</div>

                    <div class="panel-body">
                        @foreach($data as $single)
                        <form action="{{route('admin.assignCourseBuilderTo',['id'=>$single->id])}}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                            <div class="form-group col-md-6">
                                <label for="assigTon"> Course Builder Assign to</label>
                                <select name="builderId" id="" class="form-control">
                                    <option value=""> Select </option>
                                    @foreach($builders as $builder)
                                        <option value="{{$builder->id}}">{{$builder->name}} - ({{$builder->id}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">

                                    <label for="courseId">Course Id</label>
                                    <input type="text" value="{{$single->courseId}}" class="form-control" readonly>

                            </div>

                            <div class="form-group text-right col-md-12">
                                <button type="submit" class="btn btn-primary"> Save and Email</button>&nbsp;&nbsp;
                                <button type="submit" class="btn" name="cancel" value="cancel"> Cancel </button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>


            </div>

            {{--instructor histry --}}

            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Instructor History</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course Builder</th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>344353</td>
                                <td>Sanmar</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>344353</td>
                                <td>Sanmar</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>344353</td>
                                <td>Sanmar</td>
                            </tr>
                        </table>
                    </div>
                </div>


            </div>
            {{--end of instructor histry--}}
            {{--Builder Record histry --}}

            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Builder Record</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Builder</th>
                                <th>Number of courses</th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>Sanmar</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sanmar</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sanmar</td>
                                <td>4</td>
                            </tr>
                        </table>
                    </div>
                </div>


            </div>
            {{--end of instructor histry--}}

        </div>
    @endcan
    {{--end section for instructor--}}



@endsection



