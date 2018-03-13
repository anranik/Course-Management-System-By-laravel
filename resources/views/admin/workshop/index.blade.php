@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Workshops</div>
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
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.createWorkshopRoute')}}">Add new workshop</a>

                        </div>
                        <p></p>

                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Workshop Name</th>
                                <th>Workshop Date</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($data as $single)
                            <tr>
                                <td>{{$single->id}}</td>
                                <td>{{$single->title}}</td>
                                <td>{{$single->dateFrom}}</td>
                                <td>
                                    <a href="{{route('admin.workshopEdit',['id'=>$single->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('admin.workshopShow',['id'=>$single->id])}}" class="btn btn-success">View</a>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($data) === 0)
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


