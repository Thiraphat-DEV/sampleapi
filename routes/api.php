<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dummy;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(Dummy::class)->group(function() {
    Route::get('data', 'index');
});

Route::controller(SubjectController::class)->group(function() {
   Route::get('subject', 'ListData'); 
});


Route::controller(StudentController::class)->group(function() {
    Route::post('student/added', 'AddData');
});


Route::controller(StudentController::class)->group(function() {
    Route::post('student/added', 'AddData');
    Route::put('student/update/{id}', 'updateData');
    Route::delete('student/delete/{id}', 'deleteData');
    Route::get('student/search/{name}', 'searchData');
    Route::get('student/list/{id}', 'listDataId');
    Route::get('student/list','listDataId');
});


Route::controller(AuthController::class)->group(function() {
        Route::post('signup', 'signup');
        Route::post('login', 'login');
});


//use sanctum authenticated

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('logout', [AuthController::class, 'logout']);
});