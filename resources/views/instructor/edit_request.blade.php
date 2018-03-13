@extends('layouts.app')

@section('custom_css')
    {{--<link rel="stylesheet" href="{{url('adminlte/css/multi-select.css')}}" />--}}
@endsection
@section('javascript')
    {{--<script src="{{url('adminlte/js/jquery.multi-select.js')}}"></script>--}}

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
                    <div class="panel-heading">Reactive eCourse Request</div>

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
                            @foreach($data as $single)
                        <form action="{{route('admin.ecourseRequestReactive',['id'=>$single->id])}}" method="post">

                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <div class="form-group col-md-3">
                                <label for="courseId"> Course name&nbsp;(Id)</label>
                                <select name="courseId" id="" class="form-control" readonly>
                                        @foreach ($single->course()->pluck('name') as $name)
                                            <option value="{{$single->id}}">{{$name.' ('.$single->id.')'}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="year" >Year</label>
                                <select name="year" id="" class="form-control" readonly>
                                    <option value="{{$single->year}}">{{$single->year}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="semester">Semister</label>
                                <input type="text" name="semester"  value="{{$single->semester}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="totalSection">Total Section</label>
                                <input min="1" type="number" name="totalSection" value="{{$single->totalSection}}" class="form-control" id="totalSection">
                            </div>
                            <div class="form-group col-md-8" id="multiSection">
                                <label for="multiSection">Course with multi section</label>
                                <select name="multiSection" id=""  class="form-control">
                                    <option value="course with multi section" {{($single->multiSection=='course with multi section')?'selected':''}}>Course with multi section</option>
                                    <option value="separated courses for each section" {{($single->multiSection=='separated courses for each section')?'selected':''}}>Separated courses for each section</option>
                                    <option value="i dont know" {{($single->multiSection=='i dont know')?'selected':''}}>I don't know</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6" id="otherInsDiv">
                                <label for="otherInstructor">Other Instructor</label>

                                <select id='otherInstructor' multiple='multiple' name="otherInstructor[]"  class="form-control">

                                    @if($single->totalSection > 1)
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
                                    @else
                                        @foreach($instructors as $all)
                                            <option value="{{$all->id}}" >{{$all->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="otherAssistance">Assistance Teacher</label>
                                <select id='otherAssistance' multiple='multiple' name="otherAssistance[]"  class="form-control">
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


                            <div class="form-group">
                                <textarea name="remark" id="" cols="30" rows="5" class="form-control">{{$single->remark}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Save</button>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endcan
    {{--end section for instructor--}}

@endsection
