@extends('layouts.app')

@section('javascript')
    <script>
        jQuery(document).ready(function($) {



            var table = $('#insreport').DataTable( {

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ],
                "pageLength": 50,
                initComplete: function () {
                    this.api().columns([1,2,3,4,5,6]).every( function () {
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

    @can('instructor')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Generate report</div>
                    <div class="panel-body">

                        <table id="insreport" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Id</th>
                                    <th>Course Name</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Course Builder</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot style="
    /* display: table-column-group; */
    display: table-header-group;
">
                                <tr>
                                    <th>#</th>
                                    <th>Course Id</th>
                                    <th>Course Name</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Course Builder</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>

                            @foreach($data as $single)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$single->courseId}}</td>
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
                                            @foreach ($single->builder()->pluck('name') as $name)
                                                {{$name}}
                                            @endforeach
                                        </td>

                                        <td>
                                            {{$single->status}}
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