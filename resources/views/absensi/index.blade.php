<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- @import url(https://fonts.googleapis.com/css?family=Poppins); -->
<style>
    .green {
        color: greenyellow;
    }

    .blue {
        color: blue;
    }

    .red {
        color: red;
    }
</style>

@extends('adminlte::page')

@section('title', 'Absensi Siswa PKL')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content')
    <!-- <style>
                body{
                    font-family: 'Poppins', poppins;
                    font-weight: bold;
                }
            </style> -->

    <!-- Content Header (Page header) -->
    <div class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>{{ __('Presensi Kehadiran Siswa PKL') }}</h1>
                    <div class="card-header mt-3 px-5">
                        <div class="row g-3 align-items-left">
                            <div class="btn-tambah-data px-2">
                                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal"><i
                                        class="nav-icon fas fa-calendar-plus"></i>&nbsp; Add Attendance </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    {{-- <div class="alert alert-info">
                        Sample table page
                    </div> --}}

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Uraian Kegiatan</th>
                                        <th scope="col">Gambar Kegiatan</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                @if (count($absensi) > 0)
                                    <?php $a = 1; ?>
                                    @foreach ($absensi as $absen)
                                        <tr>
                                            <td><?= $a ?></td>
                                            <td>{{ $absen->siswa->nama }}</td>
                                            <td>
                                                @if ($absen->keterangan == 'Hadir')
                                                    <i class="fa fa-circle green" aria-hidden="true"></i>
                                                    {{ $absen->keterangan }}
                                                @elseif ($absen->keterangan == 'Ijin')
                                                    <i class="fa fa-circle blue" aria-hidden="true"></i>
                                                    {{ $absen->keterangan }}
                                                @elseif ($absen->keterangan == 'Sakit')
                                                    <i class="fa fa-circle red" aria-hidden="true"></i>
                                                    {{ $absen->keterangan }}
                                                @endif
                                            </td>
                                            <td>{{ $absen->kegiatan }}</td>
                                            <td>
                                                <img src="/kegiatan/{{ $absen->image }}"
                                                    style="width:50px; height:50px; border-radius:0%">
                                            </td>
                                            <td>{{ $absen->created_at }} </td>
                                            <td>
                                                <form action="{{ route('absensi.destroy', $absen->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="nav-icon fas fa-trash-alt"></i> &nbsp;Hapus</button>
                                                </form>
                                            </td>


                                        </tr>
                                        <?php $a++; ?>
                                    @endforeach
                                @endif
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
                                    <h5 class="modal-title">Add Attendance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('absensi.store') }}" method="POST"
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
                                                    <label for="">Nama Siswa</label>
                                                    <select id="siswas_id" name="siswas_id"
                                                        class="select2 form-control @error('siswas_id') is-invalid @enderror">
                                                        <option value="">-- Pilih Nama --</option>
                                                        @foreach ($siswa as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Keterangan</label><br>
                                                    <input type="radio" name="keterangan" id="hadir" value="Hadir">
                                                    Hadir <br>
                                                    <input type="radio" name="keterangan" id="ijin" value="Ijin">
                                                    Ijin <br>
                                                    <input type="radio" name="keterangan" id="sakit" value="Sakit">
                                                    Sakit
                                                    <!-- <input type="checkbox" name="keterangan" id="hadir" value="Hadir"> Hadir <br>
                                                                <input type="checkbox" name="keterangan" id="ijin" value="Ijin"> Ijin <br>
                                                                <input type="checkbox" name="keterangan" id="sakit" value="Sakit"> Sakit <br> -->
                                                </div>

                                                <div class="form-group">
                                                    <label for="kegiatan">Uraian Kegiatan</label>
                                                    <textarea id="kegiatan" name="kegiatan" required class="form-control @error('descripcion') is-invalid @enderror"
                                                        placeholder="{{ __('uraian singkat...') }}"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Gambar Presensi</label>
                                                    <input type="file" id="image" name="image" required
                                                        class="form-control @error('image') is-invalid @enderror"
                                                        placeholder="{{ __('Image') }}">
                                                </div>


                                                <div class="modal-footer br">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Button trigger modal -->


                    <!-- Modal -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <script type="text/javascript">
        function deleteConfir(id) {
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
                        url: "{{ url('/hapus/delete') }}/" + id,
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
