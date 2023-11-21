<?php

use App\Http\Controllers\AuthAdmin;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrainingController;
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

    Route::get('/data-admin', [AdminController::class, 'dataAdmin']);
    Route::get('/getDetailAdmin', [AdminController::class, 'getDetailAdmin']);
    Route::get('/form-add-admin', [AdminController::class, 'addFormAdmin']);
    Route::post('/add-new-admin', [AdminController::class, 'storeAdmin']);
    Route::get('/form-edit-admin/{number}', [AdminController::class, 'editFormAdmin']);
    Route::post('/edit-new-admin', [AdminController::class, 'updateAdmin']);

    Route::get('/data-participant', [AdminController::class, 'dataParticipant']);
    
    Route::get('/registrant', [AdminController::class, 'registrant']);
    
    Route::resource('/category', CategoryController::class)->only("index", "store", "update", "destroy");
    
    Route::resource('/service', TrainingController::class)->except("show");
    Route::resource('/service-detail', TrainingContentController::class)->except("show");
    
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::post('/settings', [SettingsController::class, 'update']);
    
    Route::post('/logout-admin', [AuthAdmin::class, 'logout']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/berita', [HomeController::class, 'posts']);
Route::get('/pelatihan', [ServiceController::class, 'index']);
Route::get('/pelatihan/{id}', [ServiceController::class, 'detail']);
Route::get('/getDataServices', [ServiceController::class, 'getDataServices']);

Route::get('/register', [ParticipantController::class, 'index']);
Route::post('/register', [ParticipantController::class, 'store']);
Route::get('/login', [ParticipantController::class, 'login']);
Route::post('/login', [ParticipantController::class, 'loginValidation']);

Route::get('/_profile', [ParticipantController::class, 'profile']);
Route::get('/update-profile', [ParticipantController::class, 'updateProfile']);
Route::put('/update-profile/{number}', [ParticipantController::class, 'updateProfileData']);
Route::get('/getVillages/', [GeneralController::class, 'getVillages']);

Route::post('/logout', [ParticipantController::class, 'logout']);