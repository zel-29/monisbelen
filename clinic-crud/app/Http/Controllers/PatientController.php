<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $patients = Patient::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('patient_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        $totalPatients = Patient::count();

        return view('patients.index', compact('patients', 'search', 'totalPatients'));
    }

    public function create(): View
    {
        return view('patients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Patient::create($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient registered successfully.');
    }

    public function show(Patient $patient): View
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient): View
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $validated = $request->validate($this->rules($patient));

        $patient->update($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient record updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient record deleted successfully.');
    }

    private function rules(?Patient $patient = null): array
    {
        return [
            'patient_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('patients', 'patient_number')->ignore($patient?->id),
            ],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'sex' => ['required', Rule::in(['Male', 'Female'])],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
