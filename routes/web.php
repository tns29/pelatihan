<?php

use App\Http\Controllers\AuthAdmin;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\FE\ServiceController;
use App\Http\Controllers\FE\ParticipantController;
use App\Http\Controllers\TrainingContentController;

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

Route::middleware('guest')->group(function () {
    Route::get('/admin', function () {
        return redirect('/login-admin');
    });
    
    Route::get('/login-admin', [AuthAdmin::class, 'index']);
    Route::post('/login-admin', [AuthAdmin::class, 'auth']);
    Route::get('/register-admin', [AuthAdmin::class, 'register']);
    Route::post('/register-admin', [AuthAdmin::class, 'store']);
});



Route::middleware('admin')->group(function () {
    Route::get('/profile', [AdminController::class, 'index']);
    Route::get('/dashboard', [Dashboard::class, 'index']);
    
    Route::resource('/posts', PostsController::class)->except('show');

    Route::get('/export/admin', [ExportDataController::class, 'export']);

    Route::get('/data-admin', [AdminController::class, 'dataAdmin']);
    Route::get('/getDetailAdmin', [AdminController::class, 'getDetailAdmin']);
    Route::get('/form-add-admin', [AdminController::class, 'addFormAdmin']);
    Route::post('/add-new-admin', [AdminController::class, 'storeAdmin']);
    Route::get('/form-edit-admin/{number}', [AdminController::class, 'editFormAdmin']);
    Route::post('/edit-new-admin', [AdminController::class, 'updateAdmin']);
    Route::delete('/delete-admin/{number}', [AdminController::class, 'deleteAdmin']);
    Route::get('/getRegistrant', [GeneralController::class, 'getRegistrant']);

    Route::get('/registrant-data', [AdminController::class, 'registrantData']); // pendaftar akun
    Route::get('/candidate-data', [AdminController::class, 'candidateData']); // calon peserta
    Route::get('/detail-participant/{number}', [AdminController::class, 'detailParticipant']);
    Route::delete('/delete-registrant/{number}', [AdminController::class, 'deleteRegistrant']); // hapus pendaftar akun
    Route::put('/reset-password/{number}', [AdminController::class, 'resetPassword']); // reset password pendaftar akun
    Route::get('/detail-participant/{number}/{page}', [AdminController::class, 'detailParticipant']);
    Route::put('/acc-participant/{number}', [GeneralController::class, 'accParticipant']);
    
    Route::get('/registrant', [AdminController::class, 'registrant']);
    Route::post('/approve/{number}', [AdminController::class, 'approveParticipant']);
    Route::delete('/decline/{number}', [AdminController::class, 'declineParticipant']);
    
    // DETAIL PESERTA PELATIHAN YANG TELAH DI APPROVE
    Route::get('/detail-participant-appr/{number}/{id}', [AdminController::class, 'detailParticipantAppr']);
    Route::put('/passed-participant/{number}', [AdminController::class, 'passedParticipant']);
    
    Route::get('/participant-passed', [AdminController::class, 'participantPassed']);
    

    Route::resource('/category', CategoryController::class)->only("index", "store", "update", "destroy");
    
    Route::resource('/service', TrainingController::class)->except("show");
    Route::resource('/service-detail', TrainingContentController::class)->except("show");
    
    // REPORTING //
    Route::get('/registrant-report', [GeneralController::class, 'registrantReport']);
    Route::get('/registrant-rpt', [GeneralController::class, 'registrantRpt']);
    Route::get('/open-registrant-rpt', [GeneralController::class, 'openRegistrantRpt']);
    Route::get('/export_registrant', [ExportDataController::class, 'registrant']);

    Route::get('/participant-report', [GeneralController::class, 'participantReport']);
    Route::get('/participant-rpt', [GeneralController::class, 'participantRpt']);
    Route::get('/open-participant-rpt', [GeneralController::class, 'openParticipantRpt']);
    Route::get('/export_participant', [ExportDataController::class, 'participant']);

    // END REPORTING //

    Route::get('/settings', [SettingsController::class, 'index']);
    Route::post('/settings', [SettingsController::class, 'update']);
    Route::get('/set-period', [SettingsController::class, 'setPeriod']);
    Route::post('/set-period', [SettingsController::class, 'savePeriodActive']);
    
    Route::post('/logout-admin', [AuthAdmin::class, 'logout']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/berita', [HomeController::class, 'posts']);

Route::get('/pelatihan', [ServiceController::class, 'index']);
Route::get('/pelatihan/{id}', [ServiceController::class, 'detail']);
Route::get('/getDataServices', [ServiceController::class, 'getDataServices']);
Route::get('/getVillages/', [GeneralController::class, 'getVillages']);

Route::middleware('participant')->group(function () {
    Route::get('/wishlist', [ParticipantController::class, 'wishlist']);
    Route::get('/_profile', [ParticipantController::class, 'profile']);
    Route::get('/update-profile', [ParticipantController::class, 'updateProfile']);
    Route::put('/update-profile/{number}', [ParticipantController::class, 'updateProfileData']);
    Route::get('/checkDataUser/{id}', [GeneralController::class, 'checkDataUser']);
    
    Route::post('/logout', [ParticipantController::class, 'logout']);
});

Route::get('/register', [ParticipantController::class, 'index']);
Route::post('/register', [ParticipantController::class, 'store']);
Route::get('/login', [ParticipantController::class, 'login']);
Route::post('/login', [ParticipantController::class, 'loginValidation']);

