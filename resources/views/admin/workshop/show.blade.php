@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-10" id="workshopSingle">
                <div class="panel panel-default">
                    <div class="panel-heading">All Workshops</div>
                    <div class="panel-body">

                        <div class="box-default text-right">
                            <a class="btn btn-bitbucket float-right" href="{{route('admin.createWorkshopRoute')}}">Add new workshop</a>

                        </div>




                            @foreach($data as $single)
                            <artcle class="single">
                                <h1>{{$single->title}}</h1>
                                <ul>
                                    <li><b>Language: </b> {{$single->language}}</li>
                                    <li><b>Oneday: </b> {{$single->oneDay}}</li>
                                    <li><b>Date from To: </b> {{$single->dateFrom.' TO '.$single->dateTo}}</li>
                                    <li><b>Location of building: </b> {{$single->locationBuilding}}</li>
                                    <li><b>Room number: </b> {{$single->locationRoom}}</li>
                                    <li><b>City: </b> {{$single->city}}</li>
                                    <li><b>Max Seat: </b> {{$single->maxSeat}}</li>
                                    <li><b>Coffee break: </b> {{$single->coffeBreak}}</li>
                                    <li><b>Created at: </b> {{$single->created_at}}</li>
                                </ul>
                            </artcle>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


