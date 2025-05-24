@extends('backend.master.masterback')
@section('title')
Events
@endsection

@push('link')
<link href="{{ asset('backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .modal.fade .modal-dialog {
        transform: translateY(-100%);
        transition: transform 0.4s ease-out;
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">EVENTS</h2>
        <a href="{{ url('admins/new-event') }}" class="btn btn-primary">NEW EVENT</a>
    </div>

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Image</th>
                <th>Banner</th>
                <th>Thumbnail</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td class="event-id">{{ $event->id }}</td>
                <td class="event-name">{{ $event->event_name }}</td>
                <td class="event-location">{{ $event->location }}</td>
                <td class="start-date">{{ $event->start_date }}</td>
                <td class="end-date">{{ $event->end_date }}</td>
                <td class="event-image">
                    @if($event->images)
                    <img src="{{ asset('/images/events/gallery/' . $event->images) }}" style="width: 70px;">
                    @else No Image
                    @endif
                </td>
                <td class="event-banner">
                    @if($event->banner)
                    <img src="{{ asset('/images/events/banners/' . $event->banner) }}" style="width: 70px;">
                    @else No Banner
                    @endif
                </td>
                <td class="event-thumbnail">
                    @if($event->thumbnail)
                    <img src="{{ asset('/images/events/thumbnails/' . $event->thumbnail) }}" style="width: 70px;">
                    @else No Thumbnail
                    @endif
                </td>
                <td class="event-description">{{ $event->description }}</td>
                <td class="event-status">{{ ucfirst($event->status) }}</td>
                <td>
                    <button class="btn btn-success btn-sm editEventBtn">Edit</button>
                    <a href="{{ route('event.delete', $event->id) }}" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this designer?')">
                        Delete
                     </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="updateEventForm" method="POST" action="{{ url('admins/event/update') }}">
            @csrf
            <input type="hidden" name="id" id="eventId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Event Name</label>
                        <input type="text" name="event_name" id="eventName" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Location</label>
                        <input type="text" name="location" id="eventLocation" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="startDate" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="endDate" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="description" id="eventDescription" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" id="eventStatus" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary mt-3" type="submit">Update Event</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('backend_script')
<script>
    $(document).ready(function () {
        // Show modal with data
        $('.editEventBtn').on('click', function () {
            let row = $(this).closest('tr');

            let id = row.find('.event-id').text().trim();
            let name = row.find('.event-name').text().trim();
            let location = row.find('.event-location').text().trim();
            let startDate = row.find('.start-date').text().trim();
            let endDate = row.find('.end-date').text().trim();
            let description = row.find('.event-description').text().trim();
            let status = row.find('.event-status').text().trim().toLowerCase();

            $('#eventId').val(id);
            $('#eventName').val(name);
            $('#eventLocation').val(location);
            $('#startDate').val(startDate);
            $('#endDate').val(endDate);
            $('#eventDescription').val(description);
            $('#eventStatus').val(status);

            $('#editEventModal').modal('show');
        });

        // AJAX update
        $('#updateEventForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = "{{ url('admins/event/update') }}";

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.status === 'success') {
                        alert('Event updated successfully!');
                        window.location.reload();
                    } else {
                        alert('Failed to update!');
                    }
                },
                error: function (err) {
                    console.error(err);
                    alert('Something went wrong!');
                }
            });
        });
    });
</script>
@endpush