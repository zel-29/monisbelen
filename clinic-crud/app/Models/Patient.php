<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_number',
        'first_name',
        'last_name',
        'birth_date',
        'sex',
        'contact_number',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }
}
