<?php

use App\Events\MessageSent;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\IDEController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StudentApiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManagementController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::controller(PageController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard', 'fl');
    Route::get('/modules', 'modules')->name('modules');
    Route::get('/module-lessons/{module_id}', 'module_lessons')->name('module_lessons');
    Route::get('/manage_lessons/{module_id}/{lesson_id}', 'manage_lessons')->name('manage_lessons');
    Route::get('/manage_lessons/activities/{module_id}/{lesson_id}/{type}', 'manage_activities')->name('manage_activities');
});

Route::controller(StudentController::class)->middleware('auth', 'fl', 'verified')->group(function () {
    Route::get('/learn', 'learn')->name('learn');
    Route::get('/my-modules', 'my_modules')->name('my_modules');
    Route::get('/my-modules/learn/{module_id}', 'learn_module')->name('learn_module');
    Route::get('/my-modules/learn/lesson/{module_id}/{lesson_id}', 'learn_lesson')->name('learn_lesson');
    Route::get('/module-preview/{module_id}', 'module_preview')->name('module_preview');
});

Route::controller(AssessmentController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/module-assessment/{module_id}/{lesson_id}/{type}', 'module_assessment')->name('module_assessment');
    Route::get('/assessment/{module_id}/{lesson_id}/{assessment_id}', 'assessment')->name('assessment');
    Route::get('/view-assessment-result/{assessment_id}', 'view_assessment_result')->name('view_assessment_result');
    // Assessment module
    Route::get('/assessments', 'assessments')->name('assessments');
});

Route::controller(ModuleController::class)->middleware('auth', 'verified')->group(function () {
    Route::post('/save-module-access/{module_id}', 'save_module_access')->name('save_module_access');
});

Route::controller(SurveyController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/survey', 'survey')->name('survey');
    Route::get('/get_pre_assessment', 'get_pre_assessment')->name('get_pre_assessment');
});

Route::controller(ChartController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/get_avg_score_per_modules', 'get_avg_score_per_modules')->name('get_avg_score_per_modules');
    Route::get('/get_avg_score_per_modality', 'get_avg_score_per_modality')->name('get_avg_score_per_modality');
});

Route::controller(FileUploadController::class)->middleware('auth', 'verified')->group(function () {
    Route::post('/upload', 'upload')->name('upload');
    Route::get('/download/{filename}', 'download')->name('download');

    Route::post('/profile_upload', 'profile_upload')->name('profile_upload');
    Route::post('/module_bg_upload', 'module_bg_upload')->name('module_bg_upload');
});

Route::controller(NotificationController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/notifications', 'notifications')->name('notifications');
    Route::get('/notifications-view', 'notifications_view')->name('notifications_view');

    Route::post('/seen', 'seen')->name('seen');
    Route::post('/delete-notification', 'delete')->name('delete_notification');
});

Route::controller(ProfileController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/profile/view/{id}', 'profile_preview')->name('profile_preview');
});

Route::controller(StudentApiController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/api/students/recommend', 'sendRecommendRequest')->name('api.recommend');
    Route::get('/api/students/stats',  'sendStudentStatsRequest')->name('api.get_stats');
});

Route::controller(ChatController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/inbox/{id?}', 'inbox')->name('inbox');
    Route::get('/get-message', 'get_message')->name('get_message');
    Route::post('/send-message', 'send_message')->name('send_message');
});

Route::controller(DatatableController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/student_performance_table', 'student_performance_table')->name('student_performance_table');
    Route::get('/users_table', 'users_table')->name('users_table');
    Route::get('/submission_table_per_lesson/{module_id}/{lesson_id}', 'submission_table_per_lesson')->name('submission_table_per_lesson');
    Route::get('/task_table', 'task_table')->name('task_table');
});

Route::controller(UserManagementController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/user_management', 'user_management')->name('user_management');
    Route::get('/get_specific_user', 'get_specific_user')->name('get_specific_user');
    Route::post('/update-user', 'update_user')->name('update_user');
});

Route::controller(SiteSettingController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/site_settings', 'site_settings')->name('site_settings');
    Route::get('/documentation', 'documentation')->name('documentation');
});

Route::controller(PasswordController::class)->middleware('guest')->group(function () {
    Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('password.reset');
    Route::post('/update-reset-password', 'updateResetPassword')->name('update_reset_password');
});

Route::controller(ReportController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/reports', 'index')->name('reports');
    Route::get('/report-filter', 'filter')->name('render_filter');
    Route::get('/report-list', 'report_list')->name('report_list');
    Route::post('/generate', 'generate')->name('generate');

    Route::get('/student_list', 'student_list')->name('student_list');
    Route::get('/module_list', 'module_list')->name('module_list');
});

Route::controller(AwardController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/get_award_list', 'get_award_list')->name('get_award_list');
    Route::post('/commend', 'commend')->name('commend');
});

Route::controller(TaskController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/assignments_and_projects', 'index')->name('assignments_and_projects');
    Route::get('/assignments_and_projects/form/{id?}', 'form')->name('assignments_and_projects.form');
    Route::get('/load_students', 'load_students')->name('load_students');
    Route::get('/get_saved_participants', 'get_saved_participants')->name('get_saved_participants');
    Route::post('/process_task', 'process_task')->name('process_task');
});

Route::controller(EmailController::class)->middleware('auth')->group(function () {
    Route::get('/email/verify', 'showNotice')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', 'resend')
        ->middleware('throttle:3,1')
        ->name('verification.send');
});


Route::controller(IDEController::class)->middleware('auth', 'verified')->group(function () {
    Route::get('/IDE/{ide}', 'index')->name('ide');
});
