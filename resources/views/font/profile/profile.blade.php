@extends('font.master.mastering')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('images/clients/' . ($client->image ?? 'default.png')) }}" alt="Profile Image"
                             class="rounded-circle shadow" width="100" height="100">
                        <div class="ms-4">
                            <h3 class="mb-0">{{ $client->first_name ?? $user->name }} {{ $client->last_name ?? '' }}</h3>
                            <small class="text-muted">{{ $user->email }}</small>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Division:</label>
                            <div class="form-control">{{ $client->division ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">District:</label>
                            <div class="form-control">{{ $client->district ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Home District:</label>
                            <div class="form-control">{{ $client->home_district ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Address:</label>
                            <div class="form-control">{{ $client->address ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Terms Accepted:</label>
                            <div class="form-control">
                                {{ $client->terms_accepted ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">

                    <div class="text-end">
                        <a href="{{ url('user/update/'.$client->id) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('link')
<style>
.rounded-circle {
    border-radius: 50% !important;
    object-fit: cover;
}
</style>
@endpush