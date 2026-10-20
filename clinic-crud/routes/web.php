<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;


Route::get('/', function () {
    return redirect()->route('patients.index');
});

Route::resource('patients', PatientController::class);
