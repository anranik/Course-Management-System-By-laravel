@extends('layouts.app')

@section('content')

    {{--section for instructor--}}
    @can('users_manage')
        @include('admin.admin')
    @endcan
    {{--end section for instructor--}}


    {{--section for instructor--}}
    @can('instructor')
        @include('instructor.instructor')
    @endcan
    {{--end section for instructor--}}

@endsection
