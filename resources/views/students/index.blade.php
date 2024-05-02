

@extends('adminlte::page')

@section('title', 'Active Student')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop
    
<style>
    .green {
        color: greenyellow;
    }

    .red{
        color: red;
    }
</style>

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>{{ __('Data Admin Pengelola') }}</h1>
                    <div class="card-header mt-3 px-5">
                        <div class="row g-3 align-items-left">
                            <div class="col-auto">
                              <label for="inputPassword6" class="col-form-label">Search</label>
                            </div>
                            <div class="col-auto">
                            <form action="/siswa" method="GET">
                              <input type="search" id="inputPassword6" name="search" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                            </form>
                            <div class="btn-tambah-data px-2">
                                

                                 
                                <!-- <button class="btn btn-danger" id="multi-delete" data-route="{{ route('posts.multi-delete') }}">Delete All Selected</button> -->
                                <!-- <button class="btn btn-danger btn-sm" onclick="deleteAllSelectedRecord($id/)" data-toggle="tooltip" title='Delete' style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus Semua</button> -->
                                <!-- <a href ="/selected-siswa" class="btn btn-danger" id="deleteAllSelectedRecord">Delete All Selected</a> -->
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    {{-- <div class="alert alert-info">
                        Sample table page
                    </div> --}}

                    <div class="card">
                        <div class="card-body p-0">

                            <!-- <table class="table table-hover table-bordered"> -->
                            <table class="table table-hover table-bordered" id="posts-table">

                                <thead>
                                    <tr>
                                        <!-- <th>
                                            <input type="checkbox" id="select_all_ids">
                                        </th> -->
                                        <!-- <th scope="col"><input type="checkbox" class="check-all"></th> -->
                                        <th scope="col">No</th>
                                        <th scope="col" style="width: 10%">Nama</th>
                                        <th scope="col" style="width: 50%;">Bio</th>
                                        <th scope="col" style="width:20% ;">Gambar</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1; ?>
                                    @foreach ($students as $student)
                                    <!-- <tr id="siswa_ids{{ $student->id}}"> -->
                                    <tr>
                                        <!-- <td><input type="checkbox" class="check" value="{{ $student->id }}"></td> -->
                                        <!-- <td><input type="checkbox" name="ids" class="checkbox_ids" id=""></td> -->
                                        <td><?= $a; ?></td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->bio }}</td>
                                        <td>
                                            <img class="profile img-fluid img-circle"
                                            src="{{ asset('image/profile/' . $student->user->profile_image) }}"
                                            alt="User profile" style="width: 150px; height: 150px;">
                                        </td>
                                        <td >
                                            @if ($student->status == 'Aktif')
                                                <i class="fa fa-circle green" aria-hidden="true"></i>
                                                {{ $student->status}}
                                            @elseif ($student->status == 'Nonaktif')
                                                <i class="fa fa-circle red" aria-hidden="true"></i>
                                                {{ $student->status}}

                                            @endif
                                        </td>
                                        
                                        <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex px-2">
                                                <a href="{{ route('activeStudent.edit', Crypt::encrypt($student->id)) }}" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                            </div>
                                            <div class="mt-3">
                                                <form action="{{ route('activeStudent.destroy', $student->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"> </i>&nbsp; Hapus</button>
                                                </form>         
                                                </div>                                       
                                        </div>
                                        </td>
                                    </tr>
                                    <?php $a++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

            
                        <!-- /.card-body -->

                        {{-- <div class="card-footer clearfix">
                            {{ $siswa->links() }}
                        </div> --}}
                    </div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <form action="{{ route('activeStudent.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
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
                                                <div class="form-group">
                                                    <label for="nama" style="font-weight: 500">Nama Admin</label>
                                                    <select name="user_id" id="user_id" class="form-control">
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id}}">{{ $data->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                    
                                                <div class="form-group">
                                                    <label for="telp" style="font-weight: 500">Bio</label>
                                                    <input type="text" id="bio" name="bio" required class="form-control @error('bio') is-invalid @enderror" placeholder="{{ __('Bio') }}">
                                                </div>
                                                
                                            

                                                <div class="form-group">
                                                    <label for="">Status</label><br>
                                                    <input type="radio" name="status" id="status" value="Aktif"> Aktif <br>
                                                    <input type="radio" name="status" id="status" value="Nonaktif"> Nonaktif<br>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer br">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection



