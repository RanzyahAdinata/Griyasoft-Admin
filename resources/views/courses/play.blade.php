@extends('adminlte::page')

@section('title', 'Play Video')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop


@section('content')
    <div class="row py-2">
        <div class="col-md-12">
            <!-- Konten Utama -->
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <a href="{{ route('course.index') }}"><i class="fas fa-arrow-left"></i></a>
                    <h4 class="mx-3 pt-2">Kembali</h4>
                </div>
            </div>


            <div class="content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">

                                <video controls width="1000" height="800" style="max-width: 100%; height:650px;">
                                    <source src="{{ asset($video->file_path) }}" type="video/mp4">
                                </video>
                                <h2><b>{{ $video->title }}</b></h2>
                                <p><i> Terakhir diperbarui {{ $video->created_at->diffForHumans() }}</i></p>
                                <div class="d-flex align-items-center mb-2">
                                    <img class="profile img-fluid img-circle"
                                        src="{{ asset('image/profile/' . $video->users->profile_image) }}"
                                        alt="User profile" style="width: 40px; height: 40px;">
                                    <h6 class="profile-username mx-2 fs-6"><b>{{ $video->users->name }}</b></h6>
                                </div>
                                <h4><b>Deskripsi</b> </h4>
                                <h6>{{ $video->description }} </h6>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card d-flex mx-2">
                            <h5 class="text-bold mx-4" style="margin-top: 1rem;">Video Lainnya</h5>
                            @foreach ($videos as $video)
                                <hr>
                                <div class="card-body d-flex">
                                    <a href="{{ route('course.play', $video->id) }}" class="text-dark">
                                        <video controls width="120" height="100" style="height: 100;">
                                            <source src="{{ asset($video->file_path) }}" type="video/mp4">
                                        </video>
                                        <div>
                                            <a href="{{ route('course.play', $video->id) }}" class="text-dark">
                                                <h5 class="card-title mx-2 text-bold">{{ $video->title }}</h5><br>
                                                <h6 class="fs-6 mx-2"><i> Diupload
                                                        {{ $video->created_at->diffForHumans() }}</i></h6>
                                                <div class="d-flex align-items-center mx-2 mb-2">
                                                    <img class="profile img-fluid img-circle"
                                                        src="{{ asset('image/profile/' . $video->users->profile_image) }}"
                                                        alt="User profile" style="width: 35px; height: 35px;">
                                                    <h6 class="profile-username mx-2 fs-6">{{ $video->users->name }}</h6>
                                                </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
@stop
