@extends('layouts.app')



@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Your profile details</div>
                <div class="panel-body">
                    <form action="{{route('admin.updateProfile')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text" name="name" value="{{$data->name}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"> Email</label>
                            <input type="email" name="email" value="{{$data->email}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"> Phone</label>
                            <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="otherInfo">Other Information</label>
                            <textarea rows="5" name="otherInfo"  class="form-control">{{$data->otherInfo}}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile Information</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection