<!DOCTYPE html>
<?php
        $bg = url('img/').'/loginbg.jpg';
?>
<html lang="en" style="background-image:url({{$bg}});">

<head>
    @include('partials.head')
</head>
<style>
    .panel-default {
        border-color: #ddd;
        background: #0000008a;
    }
    label {
        color: #f5f5f5;
    } r
</style>
<body class="page-header-fixed" style="background: transparent">

    <div style="margin-top: 10%;"></div>

    <div class="container-fluid">
        @yield('content')
    </div>

    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>

    @include('partials.javascripts')

</body>
</html>