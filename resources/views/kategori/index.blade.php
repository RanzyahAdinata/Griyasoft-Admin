<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>


@extends('adminlte::page')

@section('title', 'Kategori')

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
                <h3 class="col-sm-12 d-flex justify-content-between">Kategori Konten
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Kategori </button>
                    {{-- <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-md"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Kategori </a> --}}
                </h3>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = 1; ?>
                        @forelse ($kategori as $row)
                        {{-- @forelse() --}}
                        <tr>
                            <td><?= $a; ?></td>
                            {{-- <td>{{ $row->id }}</td> --}}
                            <td>{{ $row->nama_kategori }}</td>
                            <td>{{ $row->slug }}</td>
                            <td>
                                <div class="d-flex px-2">
                                    <a href="{{ route('kategori.edit', Crypt::encrypt($row->id)) }}" class="btn btn-warning"><i class="nav-icon fas fa-edit"></i> &nbsp;Edit</a>
                                    <div class="btn px-2"></div>
                                    <button class="btn btn-danger" onclick="deleteConfirmation({{$row->id}})"><i class="nav-icon fas fa-trash-alt"></i> &nbsp;Hapus
                                </button>
                                </div>    
                            </td>
                        </tr>
                        <?php $a++; ?>
                        @empty
                        <tr>
                            <td colspan="4" align="center">Data masih kosong</td>
                        </tr>
                        
                        @endforelse
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
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
                                                    <label for="kategori" style="font-weight: 500">Nama Kategori</label>
                                                    <input type="text" id="kategori" name="nama_kategori" required class="form-control @error('nama') is-invalid @enderror" placeholder="Enter Kategori">
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
</div>
    
<script type="text/javascript">
    function deleteConfirmation(id) {
        swal.fire({
            title: "Delete?",
            icon: 'warning',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('kategori/delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            setTimeout(function(){
                                location.reload();
                            },2000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>
@endsection