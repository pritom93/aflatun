@extends('backend.master.masterback')

@section('title')
Roles List
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h4 class="mb-0">🛡️ Roles Overview</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive animate__animated animate__fadeInUp">
                    <table class="table table-hover table-striped table-bordered shadow-sm">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $index => $role)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->status ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $role->permission }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning editRoleBtn" data-id="{{ $role->id }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger deleteRoleBtn" data-id="{{ $role->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="updateRoleForm">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="edit_role_id">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" id="edit_name">
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select class="form-select" id="edit_status">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Permission</label>
            <select class="form-select" id="edit_permission">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('backend_script')
<script>
$(document).ready(function () {
    // Handle edit button click
    $('.editRoleBtn').on('click', function () {
        let roleId = $(this).data('id');
        let row = $(this).closest('tr');
        let name = row.find('td:nth-child(2)').text().trim();
        let statusText = row.find('td:nth-child(3)').text().trim();
        let permission = row.find('td:nth-child(4)').text().trim();
        let statusValue = statusText === 'Active' ? 1 : 0;

        $('#edit_role_id').val(roleId);
        $('#edit_name').val(name);
        $('#edit_status').val(statusValue);
        $('#edit_permission').val(permission);

        $('#editRoleModal').modal('show');
    });

    // Handle form submit
    $('#updateRoleForm').on('submit', function (e) {
        e.preventDefault();

        let roleId = $('#edit_role_id').val();
        let name = $('#edit_name').val();
        let status = $('#edit_status').val();
        let permission = $('#edit_permission').val();

        $.ajax({
            url: "{{ route('roles.update') }}",  // backend route
            type: "POST", // or PUT if your route supports it
            data: {
                _token: "{{ csrf_token() }}",
                id: roleId,
                name: name,
                status: status,
                permission: permission
            },
            success: function (response) {
                // Optionally update table row without reloading
                let row = $('.editRoleBtn[data-id="' + roleId + '"]').closest('tr');
                row.find('td:nth-child(2)').text(name);
                row.find('td:nth-child(3)').text(status == 1 ? 'Active' : 'Inactive');
                row.find('td:nth-child(4)').text(permission);

                // Close modal
                $('#editRoleModal').modal('hide');

                // Optional: show a success message
                alert('Role updated successfully!');
            },
            error: function (xhr) {
                alert('Update failed. Please try again.');
            }
        });
    });

    $('.deleteRoleBtn').on('click', function () {
        let roleId = $(this).data('id');
        let confirmed = confirm("Are you sure you want to delete this role?");
        
        if (!confirmed) return;

        $.ajax({
            url: "{{ route('roles.delete') }}", // route should match your backend
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: roleId
            },
            success: function (response) {
                // Remove row from table
                $('.deleteRoleBtn[data-id="' + roleId + '"]').closest('tr').remove();
                alert('Role deleted successfully!');
            },
            error: function (xhr) {
                alert('Delete failed. Please try again.');
            }
        });
    });

});
</script>
@endpush