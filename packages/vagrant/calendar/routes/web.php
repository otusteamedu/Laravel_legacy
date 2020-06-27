<?php

use Illuminate\Support\Facades\Route;
use Lara\Calendar\Controllers\CalendarController;

//Route::get('/calendar', [CalendarController::class, 'index']);

Route::get('/calendar/{data?}', [CalendarController::class, 'calendar'])->name('calendar');
