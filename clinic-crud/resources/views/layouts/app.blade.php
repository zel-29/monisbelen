<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Clinic Patient Records')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">
<style>
body {
background-color: #f4f7fb;
}
.navbar-brand {
font-weight: 700;
}

.main-container {
max-width: 1200px;
margin: 35px auto;
}
.card {
border: none;
border-radius: 12px;
box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
}
.table th {
background-color: #f8fafc;
white-space: nowrap;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand" href="{{ route('patients.index') }}">
Clinic Patient Records
</a>
<div class="ms-auto">
<a href="{{ route('patients.index') }}"
class="btn btn-outline-light btn-sm me-2">
Patient List
</a>
<a href="{{ route('patients.create') }}"
class="btn btn-light btn-sm">
+ Register Patient
</a>
</div>
</div>
</nav>
<main class="container main-container">

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show"
role="alert">
{{ session('success') }}
<button type="button" class="btn-close"
data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger" role="alert">
<strong>Please correct the following errors:</strong>
<ul class="mb-0 mt-2">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@yield('content')
</main>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>