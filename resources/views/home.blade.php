@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="./asset/all.css">
    <link rel="stylesheet" href="./asset/home.css">
    <link rel="stylesheet" href="./asset/style2.css">
@stop
@section('content_header')

    {{-- BAGIAN UTAMA --}}

    <div class="news-container">
        <div class="news-item" style="font-weight:500">
            <!-- Teks berita pertama -->
            Griyasoft adalah perusahaan web dan software house indonesia berada di Banjarnegara Jawa Tengah berfokus pada
            pengembangan website dan software khusus.
        </div>
        <div class="news-item" style="font-weight:500">
            <!-- Teks berita kedua -->
            Griyasoft kini sedang melaksanakan prakerin selama 6 bulan yang berisikan siswa dari 2 sekolah yang berbeda.
        </div>

    </div>

    <script>
        // Jika ingin menghentikan animasi saat hover, Anda dapat menambahkan JavaScript di sini.
    </script>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 text-center">
            <h2 class="display-5">Welcome <b>{{ Auth::user()->name }}</b> to Griyasoft</h2>
            <p class="lead">Start your learning journey here.</p>
        </div>
    </div>
@stop

@section('content')
    <div class="ag-format-container">
        <div class="ag-courses_box">
            <div class="ag-courses_item">
                <a href="{{ route('siswa.index') }}" class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>

                    <div class="ag-courses-item_title px-2">
                        Daftar Data Siswa PKL Aktif
                    </div>
                </a>
            </div>

            <div class="ag-courses_item">
                <a href="{{ route('video.index') }}"  class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>

                    <div class="ag-courses-item_title px-2">
                        Daftar Video Konten Aktif 
                    </div>
                </a>
            </div>
            <div class="ag-courses_item">
                <a href="{{ route('slider.index') }}"  class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>

                    <div class="ag-courses-item_title px-2">
                        Daftar Artikel Konten Aktif
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card bg-gradient-warning text-white rounded-lg shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Total Siswa</h5>
                        <p class="card-text">{{ $siswa }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-gradient-danger text-white rounded-lg shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-book"></i> Total Video</h5>
                        <p class="card-text">{{ $video }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-gradient-primary text-white rounded-lg shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-file"></i> Total Content</h5>
                        <p class="card-text">{{ $slider }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <h5 class="card-header text-bold text-center">
                    <!-- RECENT CONTENT -->
                    Recent Content
                </h5>
            </div>


            <!-- <div class="row mt-4 d-flex align-items-center justify-content-between"></div> -->
            <div class="col-md-8">
                <div class="card">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner text-center d-flex align-items-end bg-dark">
                            @forelse ($sliders as $key => $row)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '1' }}">
                                    <img style="width: 200px; height: 400px;" class="d-block w-100"
                                        src="/storage/konten/{{ $row->gambar_konten }}" alt="{{ $row->judul }}">
                                    <!-- <div class="carousel-caption" style="margin-top: 5rem; bottm: 0;"> -->
                                        <!-- <div class="card-header"> -->
                                        <h6 class="badge badge-primary text-bold text-white">{{ $row->judul }} </h6>
                                        <!-- </div> -->
                                        <!-- <div class="card-body"> -->

                                        <a href="{{ route('blog.index') }}"
                                            class="badge badge-danger">{{ $row->kategori->nama_kategori }}</a>
                                        <!-- </div> -->
                                    <!-- </div> -->
                                </div>
                            @empty
                                <tr>
                                    <td align="center">Tidak ada konten untuk saat ini</td>
                                </tr>
                            @endforelse
                        </div>



                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <!-- <div class="col-md-8 text-center">
            <p class="lead">Our Active Student</p>
        </div> -->
        <div class="col-md-8 text-center">
                <h5 class="card-header text-bold text-center">
                    Our Active Student
                </h5>
        </div>
    </div>
    </div>



    <section class="articles">
        @foreach ($activeStudents as $student)
            @if ($student->status == 'Aktif')
                <article>
                    <div class="article-wrapper">
                        <figure>
                            <img class="profile" src="{{ asset('image/profile/' . $student->user->profile_image) }}"
                                alt="User profile" style=" max-height: 200px; width: 100%">
                        </figure>
                        <div class="article-body">
                            <h2>{{ $student->user->name }}</h2>
                            <p>
                                {{ $student->bio }}
                            </p>
                            <a href="{{ route('activeStudent.index') }}" class="read-more">
                                Read more <span class="sr-only">about this is some title</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endif
        @endforeach
    </section>
    <!-- GET IN TOUCH -->
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
@stop
