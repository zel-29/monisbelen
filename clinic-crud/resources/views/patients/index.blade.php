@extends('layouts.app')

@section('title', 'Patient List')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1">Patient Records</h2>
            <p class="text-muted mb-0">Manage registered clinic patients.</p>
        </div>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            + Register New Patient
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-muted">Total Registered Patients</div>
                <h2 class="fw-bold text-primary mb-0">
                    {{ number_format($totalPatients) }}
                </h2>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <form method="GET" action="{{ route('patients.index') }}" class="row g-2 mb-4">
            <div class="col-md-9">
                <label class="visually-hidden" for="search">Search patient number or name</label>
                <input
                    id="search"
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search patient number or name..."
                    value="{{ $search }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">Search</button>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Patient No.</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_number }}</td>
                            <td>{{ $patient->last_name }}, {{ $patient->first_name }}</td>
                            <td>{{ $patient->birth_date->format('M d, Y') }}</td>
                            <td>{{ $patient->sex }}</td>
                            <td>{{ $patient->contact_number ?: 'N/A' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-outline-info">View</a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form
                                        action="{{ route('patients.destroy', $patient) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this patient record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                @if ($search)
                                    No patients found matching "{{ $search }}".
                                @else
                                    No patient records yet. Register your first patient.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <small class="text-muted">
                Showing {{ $patients->firstItem() ?? 0 }}
                to {{ $patients->lastItem() ?? 0 }}
                of {{ $patients->total() }} records
            </small>
            {{ $patients->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
