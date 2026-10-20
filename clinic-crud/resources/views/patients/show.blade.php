@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Patient Details</h2>
            <p class="text-muted mb-0">
                Patient Number: {{ $patient->patient_number }}
            </p>
        </div>
        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
            Back to List
        </a>
    </div>

    <div class="card p-4">
        <h5 class="fw-bold mb-3">Personal Information</h5>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-muted small">Patient Number</div>
                <div class="fw-semibold">{{ $patient->patient_number }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Full Name</div>
                <div class="fw-semibold">
                    {{ $patient->first_name }} {{ $patient->last_name }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Date of Birth</div>
                <div>{{ $patient->birth_date->format('F d, Y') }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Sex</div>
                <div>{{ $patient->sex }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Contact Number</div>
                <div>{{ $patient->contact_number ?: 'Not provided' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Address</div>
                <div>{{ $patient->address ?: 'Not provided' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Date Registered</div>
                <div>{{ $patient->created_at->format('F d, Y h:i A') }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Last Updated</div>
                <div>{{ $patient->updated_at->format('F d, Y h:i A') }}</div>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex gap-2">
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-primary">
                Edit Patient
            </a>
            <form
                action="{{ route('patients.destroy', $patient) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this patient record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    Delete Patient
                </button>
            </form>
        </div>
    </div>
@endsection
