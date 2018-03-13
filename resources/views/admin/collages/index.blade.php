@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Collages</div>
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
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.createCollageRoute')}}">Add new collage</a>
                        </div>
                        <p></p>
                        <table id="coursesTable" class="table table-bordered">
                            <tr>
                                <th>Collage Id</th>
                                <th>Collage</th>
                                <th>Dean</th>
                                <th>Dean Id</th>
                                <th>Action</th>
                            </tr>

                                @foreach($data as $single)
                                <form action="{{route('admin.collageEdit',['id'=>$single->id])}}" method="post">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                                    <tr>
                                    <td>{{$single->id}}</td>
                                    <td>{{$single->name}}</td>
                                    <td>{{$single->instructor['name']}}</td>
                                    <td>{{$single->instructor['id']}}</td>
                                    <td><button type="submit" class="btn btn-primary">Edit</button></td>
                                </tr>
                                </form>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


