@extends('adminlte::page')

@section('title', 'Active Student')

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
                            <h4>Edit Content {{ $student->user->name }}</h4>
                            <a href="{{ route('slider.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('activeStudent.update', $student->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kategori" style="font-weight: 500">Nama</label>
                                    <select id="user_id" name="user_id" required class="form-control @error('nama') is-invalid @enderror">
                                        @foreach ($users as $row)
                                        <option value="{{ $row->id }}" selected='selected'>{{$row->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
            
                                <div class="form-group">
                                    <label for="description" style="font-weight: 500">Description</label>
                                    <textarea id="bio" name="bio" required class="form-control @error('bio') is-invalid @enderror" placeholder="Deskripsi">{{ $student->bio }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label><br>
                                    <input type="radio" name="status" id="status" value="Aktif"> Aktif <br>
                                    <input type="radio" name="status" id="status" value="Nonaktif"> Nonaktif<br>
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