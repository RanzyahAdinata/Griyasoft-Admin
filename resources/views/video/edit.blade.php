@extends('adminlte::page')

@section('title', 'Edit Video')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content_header')
    <h1>Edit Video <b>{{ $video->title}} </b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Video Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $video->title) }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class=" form-control">
                        @foreach ($kategori as $data)
                        @if ($data->id == $video->kategori_id)
                            <option value="{{ $data->id }}" selected='selected'>{{$data->nama_kategori}}</option>
                        @else
                            <option value="{{ $row->id }}">
                            {{$data->nama_kategori}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('title', $video->title) }}</textarea>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file">Video File (MP4)</label>
                    <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" accept=".mp4">
                    @error('file')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Video</button>
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
