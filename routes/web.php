<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
use Livewire\Features\SupportFileUploads\FileUploadSynth;

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

Route::controller(GuestController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
});

Route::controller(PageController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard','fl');
    Route::get('/modules', 'modules')->name('modules');
    Route::get('/module-lessons/{module_id}', 'module_lessons')->name('module_lessons');
    Route::get('/manage_lessons/{module_id}/{lesson_id}', 'manage_lessons')->name('manage_lessons');
});

Route::controller(StudentController::class)->middleware('auth','fl')->group(function () {
    Route::get('/learn', 'learn')->name('learn');
});

Route::controller(SurveyController::class)->middleware('auth')->group(function () {
    Route::get('/survey', 'survey')->name('survey');
    Route::get('/get_pre_assessment', 'get_pre_assessment')->name('get_pre_assessment');

});

Route::controller(FileUploadController::class)->middleware('auth')->group(function () {
    Route::post('/upload', 'upload')->name('upload');
});
