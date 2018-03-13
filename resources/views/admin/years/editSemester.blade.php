@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit year</div>
                    <div class="panel-body">
                            <div class="col-md-6">

                                @foreach($data as $semester)

                                    <form action="{{route('admin.semesterUpdate', ['id'=> $semester->id])}}" method="post">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label for="year"></label>
                                            <input type="text" value="{{$semester->semester}}" name="semester"  class="form-control">
                                        </div>
                                        @if($semester->isCurrent == 1)
                                            <div class="form-group">
                                                <input type="text" value="Its current semester" disabled>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for=""> Make it current</label>
                                                <input type="checkbox" name="current" value="1">
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                @endforeach
                            </div>


                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}

@endsection




