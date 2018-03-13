@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Notification Email</div>
                    <div class="panel-body">
                        <form action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="mailTo"> To</label>
                                <select name="mailTo" id="">
                                    <option value="1">Instructor</option>
                                    <option value="1">Builder</option>
                                    <option value="1">Director</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject"> Subject</label>
                                <input type="text" name="subject" placeholder="Subject of mail">
                            </div>
                            <div class="form-group">
                                <label for="message"> Subject</label>
                                <textarea name="message" id="" cols="30" rows="10" placeholder="Mail subject"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="attachment">Attachment</label>
                                <input type="file" name="attachment">
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


