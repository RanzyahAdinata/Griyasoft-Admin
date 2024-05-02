@extends('adminlte::page')

@section('title', 'Blog')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content')
    <div class="row py-2">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <center>
                        <h2>Blog Griyasoft</h2>
                    </center>
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h2 class="text-black">{{ __('Konten Kami') }}</h2>
                        <div class="row g-3 align-items-left">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Search</label>
                            </div>
                            <div class="col-auto">
                                <form action="/slider" method="GET">
                                    <input type="search" id="inputPassword6" name="search" class="form-control"
                                        aria-labelledby="passwordHelpInline">
                            </div>
                            </form>
                            <!-- <div class="btn-tambah-data px-2">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session('success') }}
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                @forelse ($sliders as $row)
                                    <div class="col-md-4 col-sm-12 mt-4">
                                        <div class="card">
                                            <img src="/storage/konten/{{ $row->gambar_konten }}" class="card-img-top"
                                                style="height: 250px" alt="gambar">
                                            <div class="card-body">
                                                <a href="#"
                                                    class="badge badge-danger">{{ $row->kategori->nama_kategori }}</a>
                                                <a href="#"
                                                    class="badge badge-dark">{{ $row->created_at->diffForHumans() }}</a><br>
                                                <h5 class="card-title text-bold mt-2">{{ $row->judul }}</h5><br>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('blog.detail-blog', $row->id) }}"
                                                    class="btn btn-primary">Baca Artikel</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr></tr>
                                    <td class="text-center">Tidak ada konten untuk saat ini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
