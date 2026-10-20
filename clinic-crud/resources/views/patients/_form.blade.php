<div class="row g-3">
    <div class="col-md-6">
        <label for="patient_number" class="form-label">
            Patient Number <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            id="patient_number"
            name="patient_number"
            class="form-control @error('patient_number') is-invalid @enderror"
            value="{{ old('patient_number', $patient?->patient_number) }}"
            maxlength="50"
            required>
        @error('patient_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="sex" class="form-label">
            Sex <span class="text-danger">*</span>
        </label>
        <select id="sex" name="sex" class="form-select @error('sex') is-invalid @enderror" required>
            <option value="">Select sex</option>
            <option value="Male" @selected(old('sex', $patient?->sex) === 'Male')>Male</option>
            <option value="Female" @selected(old('sex', $patient?->sex) === 'Female')>Female</option>
        </select>
        @error('sex')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="first_name" class="form-label">
            First Name <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            id="first_name"
            name="first_name"
            class="form-control @error('first_name') is-invalid @enderror"
            value="{{ old('first_name', $patient?->first_name) }}"
            maxlength="100"
            required>
        @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="last_name" class="form-label">
            Last Name <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            id="last_name"
            name="last_name"
            class="form-control @error('last_name') is-invalid @enderror"
            value="{{ old('last_name', $patient?->last_name) }}"
            maxlength="100"
            required>
        @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="birth_date" class="form-label">
            Date of Birth <span class="text-danger">*</span>
        </label>
        <input
            type="date"
            id="birth_date"
            name="birth_date"
            class="form-control @error('birth_date') is-invalid @enderror"
            value="{{ old('birth_date', $patient?->birth_date?->format('Y-m-d')) }}"
            max="{{ now()->toDateString() }}"
            required>
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="contact_number" class="form-label">Contact Number</label>
        <input
            type="text"
            id="contact_number"
            name="contact_number"
            class="form-control @error('contact_number') is-invalid @enderror"
            value="{{ old('contact_number', $patient?->contact_number) }}"
            maxlength="30">
        @error('contact_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <textarea
            id="address"
            name="address"
            class="form-control @error('address') is-invalid @enderror"
            rows="3"
            maxlength="2000">{{ old('address', $patient?->address) }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
