@extends('adminlte::page')

@section('title', 'Siswa PKL')

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
                            <h4>Edit Siswa {{ $siswa->nama }}</h4>
                            <a href="{{ route('siswa.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama Siswa') }}" value="{{ $siswa->nama }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="telp">No. Telp</label>
                                    <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. TElp Siswa') }}" value="{{ $siswa->telp }}">                  
                                </div>
                                <div class="form-group">
                                    <label>Asal Sekolah</label>
                                    <textarea id="sekolah" name="sekolah" class="form-control @error('sekolah') is-invalid @enderror" placeholder="{{ __('sekolah') }}">{{ $siswa->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ $siswa->alamat }}</textarea>
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