<?php

use App\Http\Controllers\Dummy;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// v8
Route::get('/dummy', [Dummy::class, 'index']);
// v9
// Route::controller(Dummy::class)->group(function() {
//     Route::get('/api', 'index');
// });