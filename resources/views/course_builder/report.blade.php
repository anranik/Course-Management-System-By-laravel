@extends('layouts.app')

@section('javascript')
    <script>
        jQuery(document).ready(function($) {
            $('#coursesTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ],
                "pageLength": 50,
                initComplete: function () {
                    this.api().columns([3,4]).every( function () {
                        var column = this;
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

    @can('course_builder')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses Request</div>
                    <div class="panel-body">


                        <p></p>
                        <table id="coursesTable" class="table table-bordered" >
                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Course Id</th>
                                <th>Course Name</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Course Instructor</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th></th>
                            <th></th>

                            </tfoot>
                        <?php $i = 1; ?>
                            @foreach($data as $single)


                                <tr>
                                    <td>
                                        {{$i++}}
                                    </td>
                                    <td>
                                        @foreach ($single->course()->pluck('id') as $name)
                                            {{$name}}
                                        @endforeach</td>
                                    <td>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$single->year}}
                                    </td>
                                    <td>
                                        {{$single->semester}}
                                    </td>

                                    <td>
                                        @foreach ($single->instructor()->pluck('name') as $name)
                                            {{$name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ucfirst($single->status)}}
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