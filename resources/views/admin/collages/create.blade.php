@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Collage</div>
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
                        <form action="{{route('admin.collageStore')}}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <div class="form-group">
                                <label for="name"> Collage Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Name of collage" required>
                            </div>
                            <div class="form-group">
                                <label for="instructor"> Dean Name</label>
                                <select name="instructor" id="" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($users as $user)

                                                <option value="{{$user->id}}">  {{$user->name}}</option>

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


