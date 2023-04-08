<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Countries\Index as CountriesIndex;
use App\Http\Livewire\Countries\Show as CountriesShow;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', CountriesIndex::class)->name('countries.index');
Route::get('/countries/{alpha}', CountriesShow::class)->name('countries.show');
