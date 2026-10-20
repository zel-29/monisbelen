@extends('layouts.app')

@section('title', 'Register Patient')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Register New Patient</h2>
        <p class="text-muted">Enter the patient's information below.</p>
    </div>

    <div class="card p-4">
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            @include('patients._form', ['patient' => null])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Save Patient</button>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
