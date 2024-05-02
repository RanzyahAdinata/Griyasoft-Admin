@extends('adminlte::page')

@section('title', 'Add New Video')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content_header')
    <h1>Add New Video</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Video Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Author</label>
                    <select name="user_id" id="kategori_id" class=" form-control">
                        <option value="">-- Pilih Author --</option>
                        @foreach ($user as $data)
                            <option value="{{  $data->id }}">{{ $data->name}} </option>
                        @endforeach
                    </select>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class=" form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $data)
                            <option value="{{  $data->id }}">{{ $data->nama_kategori}} </option>
                        @endforeach
                    </select>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file">Video File (MP4)</label>
                    <input type="file" name="file_path" id="file_path" class="form-control @error('file') is-invalid @enderror" accept=".mp4" required>
                    @error('file_path')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Video</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
@stop
