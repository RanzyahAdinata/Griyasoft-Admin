@extends('adminlte::page')

@section('title', 'Content')

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
                            <h4>Edit Content {{ $sliders->judul }}</h4>
                            <a href="{{ route('slider.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('slider.update', $sliders->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="judul" style="font-weight: 500">Judul Content</label>
                                    <input type="text" id="judul" name="judul" required class="form-control @error('nama') is-invalid @enderror" placeholder="Judul Content"
                                    value="{{ $sliders->judul }}">
                                </div>
            
                                <div class="form-group">
                                    <label for="description" style="font-weight: 500">Description</label>
                                    <textarea id="body" name="body" required class="form-control @error('nama') is-invalid @enderror" placeholder="Deskripsi">{{ $sliders->body }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kategori" style="font-weight: 500">Kategori</label>
                                    <select id="kategori_id" name="kategori_id" required class="form-control @error('nama') is-invalid @enderror">
                                        @foreach ($kategori as $row)
                                        @if ($row->id == $sliders->kategori_id)
                                        <option value={{ $row->id }} selected='selected'>{{$row->nama_kategori}}</option>
                                        @else
                                        <option value="{{ $row->id }}">
                                        {{$row->nama_kategori}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status" style="font-weight: 500">Status</label>
                                    <select id="is_active" name="is_active" required class="form-control @error('nama') is-invalid @enderror">
                                        <option value="1" {{ $sliders->is_active == '1' ? 'selected' : '' }}>
                                            Publish
                                        </option>
                                        <option value="0" {{ $sliders->is_active == '0' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gambar" style="font-weight: 500">Gambar</label>
                                    <input type="file" id="gambar_konten" name="gambar_konten" class="form-control @error('nama') is-invalid @enderror">
                                    <br>
                                    <label for="gambar" style="font-weight: 500">Gambar Saat Ini</label><br>
                                    <img src="/storage/konten/{{ $sliders->gambar_konten }}" width="100">
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Content</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('slider.index') }}"> Kembali</a>
            </div>
        </div>
    </div> -->
     
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- <form action="{{ route('slider.update',$sliders->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
     
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $sliders->title }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $sliders->descripcion }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/images/{{ $sliders->image }}" width="300px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
     
    </form> -->
@endsection