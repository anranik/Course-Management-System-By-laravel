<div class="row">
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">New eCourse Request</div>
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

            <div class="panel-body">
                <table id="coursesTable" class="table table-bordered">

                    <tr>
                        <th>#</th>
                        <th>Course Id</th>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        <th>Waiting time</th>
                        <th>Action</th>

                    </tr>
                    <?php $i = 1; ?>
                    @foreach($courses_pending as $single)
                        <form action="{{route('admin.assignCourseBuilder',['id'=>$single->id])}}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />


                            <tr>
                                <td>
                                    {{$i++}}
                                </td>
                                <td>
                                    {{$single->id}}
                                </td>
                                <td>
                                    @foreach ($single->course()->pluck('name') as $name)
                                        {{$name}}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($single->instructor()->pluck('name') as $name)
                                        {{$name}}
                                    @endforeach
                                </td>

                                <td>
                                    {{$single->created_at->diffForHumans()}}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Assign Course Builder</button>
                                </td>
                            </tr>

                        </form>
                    @endforeach
                    @if(count($courses_pending) === 0)
                        <tr>
                            <td colspan="8" style="text-align: center"><h1 class="info">No record found</h1></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>


        {{--list of ecourses--}}
        <div class="panel panel-default">
            <div class="panel-heading">List of eCourses</div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Course Id</th>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        <th>Builder</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                    @foreach($courses_active as $single)


                        <tr>
                            <td>
                                    {{$single->id}}
                            </td>
                            <td>
                                @foreach ($single->course()->pluck('name') as $name)
                                    {{$name}}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($single->instructor()->pluck('name') as $name)
                                    {{$name}}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($single->builder()->pluck('name') as $name)
                                        {{$name}}
                                @endforeach
                            </td>
                            <td>{{$single->created_at}}</td>
                            <td>
                                {{$single->status}}
                            </td>
                        </tr>

                    @endforeach
                    @if(count($courses_active) === 0)
                        <tr>
                            <td colspan="8" style="text-align: center"><h1 class="info">No record found</h1></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        {{--end list of ecourses--}}

        {{--chart--}}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h2 class="text-capitalize">Courses by collage: <span style="font-size: 30px;font-weight: bold;color: #ec3535;">CHART</span> </h2>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="col-md-6"></div>
                </div>

            </div>
        </div>
        {{--end chart--}}
    </div>
</div>

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["Collage one", "Collage two", "Collage 3"],
                datasets: [{
                    label: "Collages",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [10,40,50],
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection


