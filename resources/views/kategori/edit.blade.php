@extends('adminlte::page')

@section('title', 'Kategori')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content')
<section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                                </button>
                                @foreach ($errors->all() as $error )
                                    {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="col-sm-12 py-3 px-3 d-flex justify-content-between">
                            <h4>Edit Kategori {{ $kategori->nama_kategori }}</h4>
                            <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('kategori.update', $kategori->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kategori">Nama Kategori</label>
                                    <input type="text" id="kategori" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="{{ __('Judul Kategori') }}" value="{{ $kategori->nama_kategori }}">
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection