@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Workshop</div>
                    <div class="panel-body">
                        @foreach($data as $single)

                        <form action="{{route('admin.workshopUpadate',['id'=>$single->id])}}" class="" method="post">

                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                            <div class="form-group">
                                <label for="title">Title &nbsp;<input type="text" name="title" value="{{$single->title}}"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Language:  &nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="language" value="arabic" {{$single->language == 'arabic'?'checked':''}}>Arabic</label>
                                <label class="radio-inline"><input type="radio" name="language" value="english"  {{$single->language == 'english'?'checked':''}}>English</label>
                            </div>

                            <div class="form-group">
                                <label for="">Days: &nbsp; </label>
                                <label class="radio-inline"><input type="radio" name="oneDay" value="yes"  {{$single->oneDay == 'yes'?'checked':''}}> One Day</label>
                                <label class="radio-inline"><input type="radio"  name="oneDay"  value="no"   {{$single->oneDay == 'no'?'checked':''}}> No</label>
                            </div>
                            <div class="form-group">
                                <label for="locBuilding">Date range: &nbsp;</label>
                                <input type="date" placeholder="From..." value="{{$single->dateFrom}}" name="dateFrom">
                                <input type="date" placeholder="To..." name="dateTo" value="{{$single->dateTo}}">
                            </div>

                            <div class="form-group">
                                <label for="locationBuilding">Location: &nbsp;</label>
                                <input type="text" placeholder="Building..." name="locationBuilding"  value="{{$single->locationBuilding}}">
                                <input type="text" placeholder="Room..." name="locationRoom"  value="{{$single->locationRoom}}">
                            </div>


                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" name="city" value="sakkair" {{$single->city == 'sakkair'?'checked':''}}>Sakkair</label>
                                <label class="radio-inline"><input type="radio" name="city" value="isatown" {{$single->city == 'isatown'?'checked':''}}>Isatown</label>
                                <label class="radio-inline"><input type="radio" name="city" value="other" {{$single->city == 'other'?'checked':''}}>Other</label>
                            </div>



                            <div class="form-group">
                                <label for="maxSeat">Max seat &nbsp;
                                <input type="number" name="maxSeat" value="{{$single->maxSeat}}"></label>
                            </div>


                            <div class="form-group">
                                <label for="">Coffee Break &nbsp;
                                <label class="radio-inline"><input type="radio" name="coffeBreak" value="yes"  {{$single->coffeBreak == 'yes'?'checked':''}}>Yes</label>
                                <label class="radio-inline"><input type="radio" name="coffeBreak" value="no"  {{$single->coffeBreak == 'no'?'checked':''}}>No</label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="inviteGroup"> Send email invitation group &nbsp;
                                    <select name="invitationTo" id="">
                                        <option value="no">No</option>
                                        <option value="activeInstructor">Active Instructor</option>
                                        <option value="allInstructor">All Instructor</option>
                                    </select>
                                </label>

                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Save</button>
                                <button type="reset" class="btn btn-primary"> Cancel</button>
                            </div>
                        </form>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


