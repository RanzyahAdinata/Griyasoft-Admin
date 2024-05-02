@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')
    <h1>Calendar</h1>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="./asset/all.css">
@stop --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menambahkan dan mengedit acara -->
        <!-- Isi modal seperti sebelumnya -->
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="eventForm">
                        <div class="modal-body">
                            <input type="hidden" id="eventId" name="eventId">
                            <div class="form-group">
                                <label for="title">Judul Acara</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="start">Tanggal Mulai</label>
                                <input type="text" class="form-control" id="start" name="start" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="deleteEvent">Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                editable: true, // Aktifkan fitur edit
                events: {!! json_encode($events) !!},
                select: function(start, end) {
                    $('#eventModal').modal('show');
                    $('#eventId').val('');
                    $('#title').val('');
                    $('#start').val(moment(start).format('YYYY-MM-DD'));
                },
                eventClick: function(calEvent, jsEvent, view) {
                    $('#eventId').val(calEvent.id);
                    $('#title').val(calEvent.title);
                    $('#start').val(moment(calEvent.start).format('YYYY-MM-DD'));
                    $('#eventModal').modal('show');
                }
            });

            $('#eventForm').on('submit', function(e) {
                e.preventDefault();
                var eventId = $('#eventId').val();
                var title = $('#title').val();
                var start = $('#start').val();
                var url = eventId ? '{{ route("update.event") }}' : '{{ route("add.event") }}';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        title: title,
                        start: start,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        calendar.fullCalendar('renderEvent', {
                            id: response.id,
                            title: title,
                            start: start,
                            allDay: true
                        });

                        $('#eventModal').modal('hide');
                        $('#title').val('');
                        $('#start').val('');
                    }
                });
            });

            $('#deleteEvent').on('click', function() {
                var eventId = $('#eventId').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("delete.event") }}',
                    data: {
                        eventId: eventId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        calendar.fullCalendar('removeEvents', eventId);
                        $('#eventModal').modal('hide');
                    }
                });
            });
        });
    </script>
@stop