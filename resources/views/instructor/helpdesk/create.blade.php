@extends('layouts.app')

@section('javascript')

    <script>
        jQuery(document).ready(function ($) {
            $('#coursesList').select2();
        })
    </script>

@endsection

@section('content')
    @can('instructor')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Help Desk</div>
                    <div class="panel-body">
                        <form action="{{route('admin.insHelpStore')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for=""> Course</label>
                                <select name="courseId" id="coursesList" class="form-control" >
                                    <option value="course">Select course name</option>
                                    @foreach($data as $key => $single)
                                        <?php
                                        $b = unserialize($single->otherInstructor);
                                        ?>
                                        @if(is_array($b) && in_array(Auth::id(),$b))
                                                @foreach ($single->course()->pluck('id') as $id)
                                                <option value="{{$id}}">
                                                    @foreach ($single->course()->pluck('name') as $name)
                                                        {{$name}}
                                                    @endforeach
                                                </option>
                                                @endforeach
                                        @endif
                                    @endforeach

                                    @foreach($inscourse as $single)
                                            @foreach ($single->course()->pluck('id') as $id)
                                                <option value="{{$id}}">
                                                    @foreach ($single->course()->pluck('name') as $name)
                                                        {{$name}}
                                                    @endforeach
                                                </option>
                                            @endforeach
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message">Subject</label>
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="attachment">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Send Question </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
