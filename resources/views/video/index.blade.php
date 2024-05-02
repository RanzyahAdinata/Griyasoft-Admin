@extends('adminlte::page')

@section('title', 'Video List')

@section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop

@section('content_header')
    <h1>Video List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('videos.create') }}" class="btn btn-primary">Add New Video</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered" style="max-width: 100%;border-collapse: collapse">
                <thead>
                    <tr>
                        <th style="width:5%;">ID</th>
                        <th style="width:10%;">Title</th>
                        <th style="width:10%;">Kategori</th>
                        <th style="width:40%;">Description</th>
                        <th style="width:10%;">Video</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody style="width: 90%;">
                    <?php $a = 1; ?>
                    @foreach($videos as $video)
                        <tr >
                            <!-- <td>{{ $video->id }}</td> -->
                            <td style="width:5%; max-width: 20px;"><?= $a; ?></td>
                            <td style="width:10%">{{ $video->title }}</td>
                            <td style="width:10%">{{ $video->kategori->nama_kategori }}</td>
                            <td style="width:40% ;max-width: 150px;">{{ $video->description }}</td>
                            <td style="width: 5%;">{{ $video->file_path }}</td>
                            <td style="width: 10%;">
                                <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('videos.play', $video->id) }}" class="btn btn-sm btn-info">Play</a>
                                <a href="{{ asset($video->file_path) }}" class="btn btn-sm btn-primary" download>Download</a>
                                <button class="btn btn-danger btn-sm" data-image-id="{{ $video->id }}" data-action="{{route ('videos.destroy',$video->id) }}" onclick="deleteConfirmation({{$video->id}})" data-toggle="tooltip" title='Delete' style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                                <!-- <form action="{{ route('videos.destroy', $video->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                        <?php $a++; ?>
                    @endforeach
                </tbody>
            </table>
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
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('/delete')}}/" + id,
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
@stop

@section('css')
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
@stop
