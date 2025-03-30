<?php

use App\Events\MessageSent;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentApiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SurveyController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
    Route::get('/dashboard', 'dashboard')->name('dashboard', 'fl');
    Route::get('/modules', 'modules')->name('modules');
    Route::get('/module-lessons/{module_id}', 'module_lessons')->name('module_lessons');
    Route::get('/manage_lessons/{module_id}/{lesson_id}', 'manage_lessons')->name('manage_lessons');
    Route::get('/manage_lessons/activities/{module_id}/{lesson_id}/{type}', 'manage_activities')->name('manage_activities');
});

Route::controller(StudentController::class)->middleware('auth', 'fl')->group(function () {
    Route::get('/learn', 'learn')->name('learn');
    Route::get('/my-modules', 'my_modules')->name('my_modules');
    Route::get('/my-modules/learn/{module_id}', 'learn_module')->name('learn_module');
    Route::get('/my-modules/learn/lesson/{module_id}/{lesson_id}', 'learn_lesson')->name('learn_lesson');
    Route::get('/module-preview/{module_id}', 'module_preview')->name('module_preview');
});

Route::controller(AssessmentController::class)->middleware('auth')->group(function () {
    Route::get('/module-assessment/{module_id}/{lesson_id}/{type}', 'module_assessment')->name('module_assessment');
    Route::get('/assessment/{module_id}/{lesson_id}/{assessment_id}', 'assessment')->name('assessment');
    Route::get('/view-assessment-result/{assessment_id}', 'view_assessment_result')->name('view_assessment_result');
    // Assessment module
    Route::get('/assessments', 'assessments')->name('assessments');
});

Route::controller(ModuleController::class)->middleware('auth')->group(function () {
    Route::post('/save-module-access/{module_id}', 'save_module_access')->name('save_module_access');

});

Route::controller(SurveyController::class)->middleware('auth')->group(function () {
    Route::get('/survey', 'survey')->name('survey');
    Route::get('/get_pre_assessment', 'get_pre_assessment')->name('get_pre_assessment');
});

Route::controller(ChartController::class)->middleware('auth')->group(function () {
    Route::get('/get_avg_score_per_modules', 'get_avg_score_per_modules')->name('get_avg_score_per_modules');
    Route::get('/get_avg_score_per_modality', 'get_avg_score_per_modality')->name('get_avg_score_per_modality');
});

Route::controller(FileUploadController::class)->middleware('auth')->group(function () {
    Route::post('/upload', 'upload')->name('upload');
    Route::get('/download/{filename}', function ($file) {
        $filePath = public_path('files/' . $file);  // Files in public/files

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404);  // Return 404 if file not found
        }
    })->name('download');

    Route::post('/profile_upload', 'profile_upload')->name('profile_upload');
    Route::post('/module_bg_upload', 'module_bg_upload')->name('module_bg_upload');


});

Route::controller(NotificationController::class)->middleware('auth')->group(function () {
    Route::get('/notifications', 'notifications')->name('notifications');
    Route::get('/notifications-view', 'notifications_view')->name('notifications_view');

    Route::post('/seen', 'seen')->name('seen');
    Route::post('/delete-notification', 'delete')->name('delete_notification');


});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/profile/view/{id}', 'profile_preview')->name('profile_preview');

});

Route::controller(StudentApiController::class)->middleware('auth')->group(function () {
    Route::get('/api/students/recommend', 'sendRecommendRequest')->name('api.recommend');
    Route::get('/api/students/stats',  'sendStudentStatsRequest')->name('api.get_stats');
});

Route::controller(ChatController::class)->middleware('auth')->group(function () {
    
    Route::get('/inbox/{id?}', 'inbox')->name('inbox');

    Route::get('/get-message', 'get_message')->name('get_message');

    Route::post('/send-message', 'send_message')->name('send_message');


});

Route::controller(DatatableController::class)->middleware('auth')->group(function () {
    Route::get('/student_performance_table', 'student_performance_table')->name('student_performance_table');
});

Route::controller(PasswordController::class)->middleware('guest')->group(function () {
    Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    Route::get('/reset-password/{token}','showResetPasswordForm')->name('password.reset');
    Route::post('/update-reset-password', 'updateResetPassword')->name('update_reset_password');
});




