@extends('adminlte::page')

@section('title', 'Griyasoft | Course')

@section('css')
    <link rel="stylesheet" href="./asset/style.css">
    <link rel="stylesheet" href="./asset/style2.css">
    <link rel="stylesheet" href="./asset/all.css">

@stop

@section('content_header')
    <div class="welcome">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <h6 class="display-5">Welcome To</h6>
                <h1 class="text-bold" style="text-shadow: 2px 2px rgb(202, 202, 202);">
                    <span style=" color: rgb(6, 147, 227);">Griya</span><span style="color: rgb(5, 3, 72);">Course</span>
                </h1>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="d-flex justify-content-between align-items-center px-5">

        <div class="courses-container">
            <div class="course">
                <div class="course-preview">
                    <h6>GriyaCourse</h6>
                    <h2>Programing</h2>
                    <a href="#">View all chapters <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="course-info">
                    <div class="progress-container">
                        <div class="progress"></div>
                        <span class="progress-text">
                            6/9 Challenges
                        </span>
                    </div>
                    <h6>Chapter 4</h6>
                    <h2>Program</h2>
                    <h2>Science</h2>
                    <a href="">
                        <button class="btn-con">Continue</button></a>
                </div>
            </div>
        </div>

        <div class="courses-container">
            <div class="course">
                <div class="course-preview">
                    <h6>GriyaCourse</h6>
                    <h2>Designing</h2>
                    <a href="#">View all chapters <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="course-info">
                    <div class="progress-container">
                        <div class="progress"></div>
                        <span class="progress-text">
                            6/9 Challenges
                        </span>
                    </div>
                    <h6>Chapter 4</h6>
                    <h2>Figma</h2>
                    <h2>Canva</h2>
                    <button class="btn-con">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Playlist Video</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <video controls width="350" height="200" style=" height: 100;">
                                <source src="{{ asset($video->file_path) }}" type="video/mp4">
                                <!-- <source src="/storage/videos/{{ $video->file_path }}" type="video/mp4"> -->
                                Your browser does not support the video tag.
                            </video>
                            <h3 class="card-title"><b>{{ $video->title }} </b></h3><br><br>
                            <h6>{{ $video->created_at->diffForHumans() }}</h6>
                            <div class="d-flex align-items-center mb-2">
                                <img class="profile img-fluid img-circle"
                                    src="{{ asset('image/profile/' . $video->users->profile_image) }}" alt="User profile"
                                    style="width: 35px; height: 35px;">
                                <h6 class="profile-username mx-2 fs-6">{{ $video->users->name }}</h6>
                            </div>
                            <a href="{{ route('course.play', $video->id) }}" class="btn btn-md btn-info">Play</a>

                            <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


        <!-- SOCIAL PANEL HTML -->
        <div class="social-panel-container">
            <div class="social-panel">
                <p>Created with</i> by
                    <a target="_blank" href="https://florin-pop.com">GriyaTech</a>
                </p>
                <button class="close-btn"><i class="fas fa-times"></i></button>
                <h4>Get in touch on</h4>
                <ul>
                    <li>
                        <a href="https://www.griyasoft.com" target="_blank">
                            <i class="fas fa-globe"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/griyasoft" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://facebook.com/Griyasoft-Banjarnegara" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/cv.griyasoft" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <button class="floating-btn">
            Get in Touch
        </button>


        <script>
            // INSERT JS HERE


            // SOCIAL PANEL JS
            const floating_btn = document.querySelector('.floating-btn');
            const close_btn = document.querySelector('.close-btn');
            const social_panel_container = document.querySelector('.social-panel-container');

            floating_btn.addEventListener('click', () => {
                social_panel_container.classList.toggle('visible')
            });

            close_btn.addEventListener('click', () => {
                social_panel_container.classList.remove('visible')
            });
        </script>


    @endsection
