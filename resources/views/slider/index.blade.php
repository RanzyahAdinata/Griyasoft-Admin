a<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>


@extends('adminlte::page')

@section('title', 'Content')

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
                            <div class="btn-tambah-data px-2">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i
                                        class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
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
                                <th>Kategori</th>
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            @forelse ($sliders as $row)
                                {{-- @forelse() --}}
                                <tr>
                                    <td><?= $a ?></td>
                                    <td>{{ $row->judul }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>{{ $row->kategori->nama_kategori }}</td>
                    
                                    <td>{{ $row->users->name }}</td>
                                    <td>
                                        <div class="d-flex px-2">

                                            <a href="{{ route('slider.edit', Crypt::encrypt($row->id)) }}"
                                                class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp;
                                                Edit</a>
                                            <button class="btn btn-danger btn-sm" data-image-id="{{ $row->id }}"
                                                data-action="{{ route('slider.destroy', $row->id) }}"
                                                onclick="deleteConfirmation({{ $row->id }})" data-toggle="tooltip"
                                                title='Delete' style="margin-left: 8px"><i
                                                    class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>

                                        </div>
                                    </td>
                                    <!-- <td>
                                    <div class="d-flex px-2">
                                        <a href="{{ route('slider.edit', Crypt::encrypt($row->id)) }}" class="btn btn-warning btn-md" style="margin-right: 1rem;"><i class="nav-icon fas fa-edit"></i> &nbsp;Edit</a>
                                        <form action="{{ route('slider.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-md"><i class="nav-icon fas fa-trash-alt"></i> &nbsp;Hapus</button>
                                        </form>
                                    </div>
                                    </td> -->
                                </tr>
                                <?php $a++; ?>
                            @empty
                                <tr>
                                    <td colspan="6" align="center">Data masih kosong</td>
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
                                <h5 class="modal-title">Tambah Konten</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    <div class="alert-body">
                                                        <button class="close" data-dismiss="alert">
                                                            <span>&times;</span>
                                                        </button>
                                                        @foreach ($errors->all() as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="judul" style="font-weight: 500">Judul Content</label>
                                                <input type="text" id="judul" name="judul" required
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Judul Content">
                                            </div>

                                            <div class="form-group">
                                                <label for="description" style="font-weight: 500">Description</label>
                                                <textarea id="body" name="body" required class="form-control @error('nama') is-invalid @enderror"
                                                    placeholder="Deskripsi"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori" style="font-weight: 500">Kategori</label>
                                                <select id="kategori_id" name="kategori_id" required
                                                    class="form-control @error('nama') is-invalid @enderror">
                                                    @foreach ($kategori as $row)
                                                        <option value="{{ $row->id }}">{{ $row->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar" class="form-label"
                                                    style="font-weight: 500">Gambar</label>
                                                <input class="form-control" type="file" id="gambar_konten"
                                                    name="gambar_konten" required
                                                    class="form-control @error('nama') is-invalid @enderror">
                                            </div>

                                            <div class="form-group">
                                                <label for="gambar" class="form-label"
                                                    style="font-weight: 500">Video</label>
                                                <input class="form-control" type="file" id="file_path"
                                                    name="file_path" required
                                                    class="form-control @error('file_path') is-invalid @enderror"
                                                    accept=".mp4">
                                            </div>

                                            <div class="form-group">
                                                <label for="status" style="font-weight: 500">Status</label>
                                                <select id="is_active" name="is_active" required
                                                    class="form-control @error('nama') is-invalid @enderror">
                                                    <option value="1">Publish</option>
                                                    <option value="0">Draft</option>
                                                </select>
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
                text: "Data akan terhapus secara permanen!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/destroy') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>

@endsection
