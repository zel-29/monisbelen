<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_be_created_viewed_updated_and_deleted(): void
    {
        $patientData = [
            'patient_number' => 'P-1001',
            'first_name' => 'Avery',
            'last_name' => 'Taylor',
            'birth_date' => '1990-04-12',
            'sex' => 'Female',
            'contact_number' => '555-0100',
            'address' => '12 Main Street',
        ];

        $this->get(route('patients.index'))
            ->assertOk()
            ->assertViewHas('totalPatients', 0);
        $this->get(route('patients.create'))->assertOk();
        $this->post(route('patients.store'), $patientData)
            ->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient registered successfully.');

        $patient = Patient::where('patient_number', 'P-1001')->firstOrFail();
        $this->assertDatabaseHas('patients', ['id' => $patient->id]);

        $this->get(route('patients.show', $patient))
            ->assertOk()
            ->assertSee('Avery Taylor');
        $this->get(route('patients.edit', $patient))->assertOk();

        $this->put(route('patients.update', $patient), [
            ...$patientData,
            'first_name' => 'Jordan',
        ])->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient record updated successfully.');

        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'first_name' => 'Jordan',
        ]);

        $this->delete(route('patients.destroy', $patient))
            ->assertRedirect(route('patients.index'))
            ->assertSessionHas('success', 'Patient record deleted successfully.');
        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }

    public function test_patient_list_can_be_searched(): void
    {
        Patient::create([
            'patient_number' => 'P-2001',
            'first_name' => 'Morgan',
            'last_name' => 'Lee',
            'birth_date' => '1988-08-20',
            'sex' => 'Male',
        ]);

        $this->get(route('patients.index', ['search' => 'Morgan']))
            ->assertOk()
            ->assertSee('P-2001')
            ->assertSee('Lee, Morgan')
            ->assertViewHas('totalPatients', 1);

        $this->get(route('patients.index', ['search' => 'not-found']))
            ->assertOk()
            ->assertSee('No patients found matching "not-found".', false);
    }

    public function test_patient_validation_rejects_duplicate_numbers_future_dates_and_invalid_sex(): void
    {
        Patient::create([
            'patient_number' => 'P-3001',
            'first_name' => 'Casey',
            'last_name' => 'Morgan',
            'birth_date' => '1992-02-10',
            'sex' => 'Female',
        ]);

        $this->from(route('patients.create'))
            ->post(route('patients.store'), [
                'patient_number' => 'P-3001',
                'first_name' => 'Jamie',
                'last_name' => 'Rivera',
                'birth_date' => now()->addDay()->toDateString(),
                'sex' => 'Other',
            ])
            ->assertSessionHasErrors(['patient_number', 'birth_date', 'sex']);

        $this->assertDatabaseCount('patients', 1);
    }
}
