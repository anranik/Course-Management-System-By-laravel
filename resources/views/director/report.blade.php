@extends('layouts.app')

@section('javascript')
    <script>
    jQuery(document).ready(function($) {



    var table = $('#adminreporttable').DataTable( {

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print','colvis'
        ],
        "pageLength": 50,
    initComplete: function () {
    this.api().columns([3,4,6,7,8]).every( function () {
    var column = this;
        //var titllle = column.text();
    var select = $('<select><option value=""></option></select>')
    .appendTo( $(column.footer()).empty() )
    .on( 'change', function () {
    var val = $.fn.dataTable.util.escapeRegex(
    $(this).val()
    );

    column
    .search( val ? '^'+val+'$' : '', true, false )
    .draw();
    } );

    column.data().unique().sort().each( function ( d, j ) {
    select.append( '<option value="'+d+'">'+d+'</option>' )
    } );
    } );
    }
    } );


    } );
    </script>
@endsection

@section('content')

    {{--section for instructor--}}
    @can('director')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Report for all courses</div>

                    <div class="panel-body">
                        {{--<input type="text" id="column3_search" placeholder="searcccccccccccc">--}}
                        <table class="table table-bordered" id="adminreporttable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course name</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Course Instructor</th>
                                <th>Status</th>
                                <th>Collage</th>
                                <th>Department</th>
                            </tr>
                            </thead>
                            <tfoot style="
    /* display: table-column-group; */
    display: table-header-group;
">
                            <tr>
                                <th></th>
                                <th></th>
                                <th> </th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th></th>
                                <th>Status</th>
                                <th>Collage</th>
                                <th>Department</th>
                            </tr>
                            </tfoot>
                            <?php $i = 1; ?>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$course->id}}</td>
                                <td>
                                    @foreach ($course->course()->pluck('name') as $name)
                                        {{$name}}
                                    @endforeach
                                </td>
                                <td>{{$course->year}}</td>
                                <td>{{$course->semester}}</td>
                                <td>
                                    @foreach ($course->instructor()->pluck('name') as $name)
                                        {{$name}}
                                    @endforeach
                                </td>
                                <td>{{$course->status}}</td>
                                <td>


                                    {{--@foreach ($course->collage()->pluck('name') as $name)--}}
                                        {{--{{$name}}--}}
                                    {{--@endforeach--}}
                                    Collage name
                                </td>
                                <td>
                                    {{--@foreach ($course->department()->pluck('name') as $name)--}}
                                        {{--{{$name}}--}}
                                    {{--@endforeach--}}
                                    Department
                                </td>


                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


            </div>

    @endcan
@endsection