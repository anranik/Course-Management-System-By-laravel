@extends('layouts.app')
@section('javascript')
    {{--<script src="{{url('adminlte/js/jquery.multi-select.js')}}"></script>--}}

    <script>
        jQuery(document).ready(function ($) {
            $('#otherInstructor').select2();
            $('#otherAssistance').select2();
        })
    </script>

@endsection

@section('content')

    {{--section for instructor--}}
    @can('director')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @foreach($data as $single)
                    <div class="panel-heading">Course request #{{$single->courseId}}</div>

                    <div class="panel-body">

                            <div class="form-group col-md-6">
                                <label for="courseId"> CourseID</label>
                                <input type="text" class="form-control" value="{{$single->courseId}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="courseId"> Course Name</label>
                                @foreach ($single->course()->pluck('name') as $name)
                                <input type="text" value="{{$name}}" class="form-control" disabled>
                                @endforeach
                            </div>
                            <div class="form-group col-md-6">
                                <label for="courseId"> Builder Name</label>
                                @foreach ($single->builder()->pluck('name') as $name)
                                <input type="text" value="{{$name}}" class="form-control" disabled>
                                @endforeach
                            </div>
                            <div class="form-group col-md-6">
                                <label for="total">Total section</label>
                                <input id="totalsection" type="text" value="{{$single->totalSection}}" class="form-control" disabled>
                            </div>
                        @if($single->totalSection != 1)
                            <div class="form-group col-md-6" id="multiSection">
                                <label for="courseId">Course with multi section</label>
                                <input id="" type="text" value="{{$single->multiSection}}" class="form-control" disabled>
                            </div>
                        @endif

                        <div class="form-group col-md-8" >
                            <label for="otherInstructor">Other Instructor</label>

                            <select id='otherInstructor' multiple='multiple' name="otherInstructor[]"  class="form-control" disabled>


                                    @foreach($instructors as $all)
                                        <?php

                                        if(in_array($all->id,unserialize($activeInsId[0]))){
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        };
                                        ?>
                                        <option value="{{$all->id}}" {{$selected}}>{{$all->name}}</option>
                                    @endforeach


                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="otherAssistance">Assistance Teacher</label>
                            <select id='otherAssistance' multiple='multiple' name="otherAssistance[]"  class="form-control" disabled>
                                @foreach($assistance as $all)
                                    <?php

                                    if(in_array($all->id,unserialize($activeAsisId[0]))){
                                        $selected = "selected";
                                    }else{
                                        $selected = "";
                                    };
                                    ?>
                                    <option value="{{$all->id}}" {{$selected}}>{{$all->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="">Other Remark</label>
                            <textarea class="form-control" rows="5" disabled>{{$single->remark}}</textarea>
                        </div>
                        <div class="col-md-12 text-right">
                            <a class="btn btn-default" href="{{url('/admin/director/dashboard')}}">Close</a>
                        </div>

                    </div>
                        @endforeach
                </div>
            </div>
        </div>

    @endcan
    {{--end section for instructor--}}

@endsection
