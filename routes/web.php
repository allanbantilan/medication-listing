<?php

use App\Livewire\ListMedications;
use Illuminate\Support\Facades\Route;

Route::get('/', ListMedications::class);
