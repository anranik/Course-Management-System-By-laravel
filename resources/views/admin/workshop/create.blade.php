@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Workshop</div>
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

                        <form action="{{route('admin.workshopStore')}}" class="" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

                            <div class="form-group">
                                <label for="title">Title &nbsp;<input type="text" name="title" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Language:  &nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="language" value="arabic" >Arabic</label>
                                <label class="radio-inline"><input type="radio" name="language" value="english">English</label>
                            </div>

                            <div class="form-group">
                                <label for="">Days: &nbsp; </label>
                                <label class="radio-inline"><input type="radio" name="oneDay" value="yes"> One Day</label>
                                <label class="radio-inline"><input type="radio"  name="oneDay"  value="no"> No</label>
                            </div>
                            <div class="form-group">
                                <label for="locBuilding">Date range: &nbsp;</label><br>
                               From: <input style="width: 50%" type="date" placeholder="From..." name="dateFrom"  class="form-control">
                                To: <input style="width: 50%" type="date" placeholder="To..." name="dateTo"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="locationBuilding">Location: &nbsp;</label><br>
                                Building:<input  style="width: 40%" type="text" placeholder="Building..." name="locationBuilding"  class="form-control">
                                <br>Room:<input style="width: 40%" type="text" placeholder="Room..." name="locationRoom"  class="form-control">
                            </div>


                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" name="city" value="sakkair">Sakkair</label>
                                <label class="radio-inline"><input type="radio" name="city" value="isatown">Isatown</label>
                                <label class="radio-inline"><input type="radio" name="city" value="other">Other</label>
                            </div>



                            <div class="form-group">
                                <label for="maxSeat">Max seat &nbsp;
                                <input type="number" name="maxSeat" class="form-control"></label>
                            </div>


                            <div class="form-group">
                                <label for="">Coffee Break &nbsp;
                                <label class="radio-inline"><input type="radio" name="coffeBreak" value="yes">Yes</label>
                                <label class="radio-inline"><input type="radio" name="coffeBreak" value="no">No</label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="inviteGroup"> Send email invitation group &nbsp;
                                    <select name="invitationTo" id="" class="form-control">
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
                    </div>
                </div>
            </div>
        </div>
    @endcan
    {{--end section for instructor--}}



@endsection


