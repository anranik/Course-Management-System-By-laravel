@extends('layouts.app')

@section('content')


    @can('users_manage')
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign To Course</div>

                    <div class="panel-body">
                        <form action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="mailTo" >
                                    To <select name="mailTo" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="course_builde">Course Builder</option>
                                        <option value="instructor">Active Instructor</option>
                                        <option value="instructor">All instructor</option>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Subject <input type="text" name="subject"  class="form-control">
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="message">
                                    Message
                                </label>
                                <textarea name="message" id="" cols="30" rows="10"  class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file"></label>
                                <input type="file" name="file"  class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit">Save</button>
                                <button type="submit">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endcan

@endsection