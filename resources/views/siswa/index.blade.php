<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- SweetAlert2 -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="plugins/Jquery-Table-Check-All/dist/TableCheckAll.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

@extends('adminlte::page')

@section('title', 'Siswa PKL')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>{{ __('Data Siswa PKL') }}</h1>
                    <div class="card-header mt-3 px-5">
                        <div class="row g-3 align-items-left">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Search</label>
                            </div>
                            <div class="col-auto">
                                <form action="/siswa" method="GET">
                                    <input type="search" id="inputPassword6" name="search" class="form-control"
                                        aria-labelledby="passwordHelpInline">
                            </div>
                            </form>
                            <div class="btn-tambah-data px-2">


                                <!-- <button class="btn btn-danger" id="deleteAllSelectedRecord" onclick="deleteAllSelectedRecord({{ $siswa }})">Delete All</button> -->

                                <button class="btn btn-danger" id="multi-delete"
                                    data-route="{{ route('posts.multi-delete') }}">Delete All Selected</button>
                                <!-- <button class="btn btn-danger btn-sm" onclick="deleteAllSelectedRecord($id/)" data-toggle="tooltip" title='Delete' style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus Semua</button> -->
                                <!-- <a href ="/selected-siswa" class="btn btn-danger" id="deleteAllSelectedRecord">Delete All Selected</a> -->
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i
                                        class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data </button>
                                <button class="btn btn-success btn-md" data-toggle="modal" data-target="#import"><i
                                        class="nav-icon fas fa-file-import"></i>&nbsp; Import Excel</button>
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
                            <table class="table table-hover" id="posts-table">

                                <thead>
                                    <tr>
                                        <!-- <th>
                                                    <input type="checkbox" id="select_all_ids">
                                                </th> -->
                                        <th scope="col"><input type="checkbox" onchange="checkAll(this)"></th>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Telepone</th>
                                        <th scope="col">Asal Sekolah</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1; ?>
                                    @foreach ($siswa as $s)
                                        <!-- <tr id="siswa_ids{{ $s->id }}"> -->
                                        <tr>
                                            <td><input type="checkbox" class="check" value="{{ $s->id }}"></td>
                                            <!-- <td><input type="checkbox" name="ids" class="checkbox_ids" id=""></td> -->
                                            <td><?= $a ?></td>
                                            <td>{{ $s->nama }}</td>
                                            <td>{{ $s->telp }}</td>
                                            <td>{{ $s->sekolah }}</td>
                                            <td>{{ $s->alamat }}</td>

                                            <td>
                                                <div class="d-flex px-2">
                                                    <a href="{{ route('siswa.edit', Crypt::encrypt($s->id)) }}"
                                                        class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i>
                                                        &nbsp; Edit</a>

                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="deleteConfirmation({{ $s->id }})"
                                                        data-toggle="tooltip" title='Delete' style="margin-left: 8px"><i
                                                            class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>

                                                    <!-- <a href="/delete/{{ $s->id }}" type="button" class="btn btn-danger" onclick="return confirm('Anda Yakin akan menghapus data ini??');">Hapus</a> -->
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
                                    <h5 class="modal-title">Tambah Siswa PKL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('siswa.store') }}" method="POST"
                                        enctype="multipart/form-data">
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
                                                    <label for="nama" style="font-weight: 500">Nama Siswa</label>
                                                    <input type="text" id="nama" name="nama" required
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        placeholder="{{ __('Nama Siswa') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="telp" style="font-weight: 500">No. Telp</label>
                                                    <input type="text" id="telp" name="telp" required
                                                        class="form-control @error('telp') is-invalid @enderror"
                                                        placeholder="{{ __('No. Telp Siswa') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="sekolah" style="font-weight: 500">Asal Sekolah</label>
                                                    <textarea id="sekolah" name="sekolah" required class="form-control @error('sekolah') is-invalid @enderror"
                                                        placeholder="{{ __('Sekolah') }}"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat" style="font-weight: 500">Alamat</label>
                                                    <textarea id="alamat" name="alamat" required class="form-control @error('alamat') is-invalid @enderror"
                                                        placeholder="{{ __('Alamat') }}"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer br">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih File Excel</h1>
                                </div>
                                <form action="/siswa/importexcel" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" name="file" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal.fire({
                title: "Anda ingin menghapus data ini?",
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
                        url: "{{ url('/hapus') }}/" + id,
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
    <!-- <script type="text/javascript">
        $(function(e) {
            $("#select_all_ids").click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function() {
                    all_ids.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('siswa.delete') }}",
                    type: "DELETE",
                    data: {
                        ids: all_ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $.each(all_ids, function(key, val) {
                            $('#siswa_ids' + val).remove();
                        })
                    }
                });
            });
        });
    </script> -->

    <script type="text/javascript">
        function checkAll(box) {
            let checkboxes = document.getElementsByTagName('input');
            if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = true;
                    }
                }
            } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        };

        // $("#posts-table").TableCheckAll();
        // $('#posts-table').click(function(e){
        //     var table= $(e.target).closest('table');
        //     $('td input:checkbox',table).attr('checked',e.target.checked);
        // });

        $('#multi-delete').on('click', function() {
            var button = $(this);
            var selected = [];
            $('#posts-table .check:checked').each(function() {
                selected.push($(this).val());
            });

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin ingin menghapus data yang dipilih?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: button.data('route'),
                        data: {
                            'selected': selected
                        },
                        success: function(response, textStatus, xhr) {
                            Swal.fire({
                                icon: 'success',
                                title: response,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                window.location = '/siswa'
                            });
                        }
                    });
                }
            });
        });

        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            var button = $(this);

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin ingin menghapus data yang dipilih?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: button.data('route'),
                        data: {
                            '_method': 'delete'
                        },
                        success: function(response, textStatus, xhr) {
                            Swal.fire({
                                icon: 'success',
                                title: response,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                window.location = '/posts'
                            });
                        }
                    });
                }
            });
        })
    </script>
@endsection
