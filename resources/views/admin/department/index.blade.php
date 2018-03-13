@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Departments</div>
                    <div class="panel-body">

                        <div class="box-default text-right">
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.createDepartmentRoute')}}">Add new collage</a>

                        </div>
                        <p></p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Collage</th>
                                <th>Chairmen</th>
                            </tr>
                            @foreach($data as $single)
                                <tr>
                                    <td>{{$single->id}}</td>
                                    <td>{{$single->name}}</td>
                                    <td> @foreach ($single->collage()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach</td>
                                    <td>
                                        @foreach ($single->instructor()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


