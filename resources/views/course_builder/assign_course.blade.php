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
        })
    </script>

@endsection


@section('content')

    {{--section for instructor--}}
    @can('course_builder')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign To A eCourse</div>

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

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="pull-right">Created At
                                            <input readonly value="{{$single->created_at}}" class="form-control"></input>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Request type
                                            <input readonly value="{{$single->requestType}}" class="form-control"></input>
                                            </label>
                                        </div>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                        <form action="{{route('admin.course_builderCourseActivate')}}" method="post">

                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                            <input name="id" value="{{$single->id}}" type="hidden"></input>
                            <div class="form-group col-md-3">
                                <label for="courseId"> Course Id</label>
                                <input value="{{$single->courseId}}" readonly class="form-control"></input>

                            </div>

                            <div class="form-group col-md-3">
                                <label for="year" >Year</label>
                                <input name="year" value="{{$single->year}}" readonly class="form-control"></input>

                            </div>
                            <div class="form-group col-md-3">
                                <label for="semester">Semister</label>
                                <input value="{{$single->semester}}" readonly  class="form-control"></input>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="totalSection">Total Section</label>
                                <input value="{{$single->totalSection}}" readonly  class="form-control"></input>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="multiSection">Course with multi section</label>
                                <select name="multiSection" id=""  class="form-control" readonly="">
                                    <option value="{{$single->multiSection}}" readonly  class="form-control">{{$single->multiSection}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="otherInstructor">Other Instructor</label>
                                <select id='otherInstructor' multiple='multiple' name="otherInstructor[]"  class="form-control" disabled>

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
                                <label for="otherAssistance">Teacher Assistance</label>
                                <select id='otherAssistance' multiple='multiple' name="otherAssistance[]"  class="form-control" disabled="disabled">
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
                                <textarea name="remark" id="" cols="30" rows="2" placeholder="Other reamrk" class="form-control" readonly>
                                    {{$single->remark}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Course Activate</button>
                                <a href="#" type="" class="btn">Cancel</a>
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
