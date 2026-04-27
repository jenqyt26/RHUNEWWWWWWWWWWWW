<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BarangayController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('families', FamilyController::class);
Route::resource('patients', PatientController::class);
Route::resource('barangays', BarangayController::class);