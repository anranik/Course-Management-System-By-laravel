@extends('layouts.app')
@section('javascript')
    <script>
        jQuery(document).ready(function($) {
            var dt = $('#courses').DataTable();
            var export_filename = 'Filename-' + tools.date( '%d-%M-%Y' );
            new $.fn.dataTable.Buttons( dt, {
                buttons: [
                    {
                        text: '<i class="fa fa-lg fa-print"></i> Print Assets',
                        extend: 'print',
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn export-print'
                    }
                ]
            } );

// Add the Print button to the toolbox
            dt.buttons( 1, null ).container().appendTo( '#anrbtn' );
        } );
    </script>
@endsection

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses</div>
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
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.createCourseRoute')}}">Add new course</a>

                        </div>
                        <p></p>
                        <table class="table table-bordered" id="courses">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Collage Name</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($data as $single)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$single->courseID}}</td>
                                    <td>{{$single->name}}</td>
                                    <td>
                                        @foreach ($single->collage()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($single->department()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td><a href="{{route('admin.editCourse',['id'=> $single->id])}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


