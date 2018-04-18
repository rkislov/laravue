<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Документооборот</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap3.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">

    </head>
    <body>
        <div id="app">
            <vue-layout></vue-layout>
        </div>
        {{--<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>--}}
        {{--<script src="{{asset('js/bootstrap3.js')}}"></script>--}}
    <script src="/js/app.js"></script>
    </body>
</html>
