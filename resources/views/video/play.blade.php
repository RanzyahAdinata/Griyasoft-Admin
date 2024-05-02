@extends('adminlte::page')

@section('title', 'Play Video')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content_header')
    <h1><b>{{ $video->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <video controls width="2000" height="800" style="max-width: 100%; height:650px;">
                <source src="{{ asset($video->file_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
@stop
