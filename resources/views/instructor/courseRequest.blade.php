@extends('layouts.app')

@section('custom_css')
    <link rel="stylesheet" href="{{url('adminlte/css/multi-select.css')}}" />
@endsection
@section('javascript')
    <script src="{{url('adminlte/js/jquery.multi-select.js')}}"></script>

    <script>
        jQuery(document).ready(function ($) {
            $('#otherInstructor').select2();
            $('#otherAssistance').select2();
            $('#courseId').select2();
            var total = $('#totalSection').val();
            if (total == 1){
                $('#otherInsDiv').hide();
                $('#multiSection').hide();
            }

            $("#totalSection").bind("kwyup change", function() {
                total = $('#totalSection').val();
                if (total == 1){
                    $('#otherInsDiv').fadeOut(500);
                    $('#multiSection').fadeOut(500);
                }else {
                    $('#otherInsDiv').fadeIn(500);
                    $('#multiSection').fadeIn(500);
                }
            });
        })
    </script>

@endsection


@section('content')

    {{--section for instructor--}}
    @can('instructor')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New eCourse Request</div>

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
                        <form action="{{route('admin.ecourseRequestRouteCreate')}}" method="post">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <div class="form-group col-md-6">
                                <label for="courseId"> Course name&nbsp;(Id)</label>
                                <select name="courseId" id="courseId" class="form-control">
                                    @foreach($data as $single)

                                            <option value="{{$single->id}}">{{$single->name}} ({{$single->courseID}})</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="year" >Year</label>

                                <select name="year" id="" class="form-control">
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}" {{($year->isCurrent == 1)?'selected':''}}>{{$year->year}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="semester">Semister</label>
                                    <select name="semester" id="" class="form-control">
                                        @foreach($semesters as $year)
                                            <option value="{{$year->semester}}"  {{($year->isCurrent == 1)?'selected':''}}>{{$year->semester}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="totalSection">Total Section</label>
                                <input min="1" id="totalSection" type="number" name="totalSection" placeholder="Total Section" value="1"  class="form-control">
                            </div>
                            <div class="form-group col-md-8" id="multiSection">
                                <label for="multiSection">Course with multi section</label>
                                <select name="multiSection" id=""  class="form-control">
                                    <option value="course with multi section">Course with multi section</option>
                                    <option value="separated courses for each section">Separated courses for each section</option>
                                    <option value="i dont know">I don't know</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6" id="otherInsDiv">
                                <label for="otherInstructor">Other Instructor</label>
                                <select id='otherInstructor' multiple='multiple' name="otherInstructor[]"  class="form-control">
                                    @foreach($users as $single)

                                        @if(\Auth::id() != $single->id)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="otherAssistance">Assistance Teacher</label>
                                <select id='otherAssistance' multiple='multiple' name="otherAssistance[]"  class="form-control">
                                    @foreach($assistance as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea name="remark" id="" cols="30" rows="5" placeholder="Other reamrk" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endcan
    {{--end section for instructor--}}

@endsection
