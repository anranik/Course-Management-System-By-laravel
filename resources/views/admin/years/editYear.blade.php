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

                                @foreach($data as $year)

                                    <form action="{{route('admin.yearUpdate', ['id'=> $year->id])}}" method="post">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label for="year"></label>
                                            <input type="text" value="{{$year->year}}" name="year"  class="form-control">
                                        </div>
                                        @if($year->isCurrent == 1)
                                            <div class="form-group">
                                                <input type="text" value="Its current year" disabled>
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




