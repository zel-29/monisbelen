@extends('layouts.app')

@section('title', 'Edit Patient')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Edit Patient Record</h2>
        <p class="text-muted">
            Update the information for {{ $patient->first_name }}
            {{ $patient->last_name }}.
        </p>
    </div>

    <div class="card p-4">
        <form action="{{ route('patients.update', $patient) }}" method="POST">
            @csrf
            @method('PUT')
            @include('patients._form', ['patient' => $patient])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Update Patient</button>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
