<?php

use App\Http\Controllers\AuthAdmin;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
});

Route::post('/register-admin', [AuthAdmin::class, 'store']);


Route::middleware('admin')->group(function () {
    Route::get('/profile', [AdminController::class, 'index']);
    Route::get('/dashboard', [Dashboard::class, 'index']);

    Route::get('/data-admin', [AdminController::class, 'dataAdmin']);
    Route::get('/getDetailAdmin', [AdminController::class, 'getDetailAdmin']);
    Route::get('/form-add-admin', [AdminController::class, 'addFormAdmin']);
    Route::post('/add-new-admin', [AdminController::class, 'storeAdmin']);
    Route::get('/form-edit-admin/{code}', [AdminController::class, 'editFormAdmin']);
    Route::post('/edit-new-admin', [AdminController::class, 'updateAdmin']);

    Route::get('/data-participant', [AdminController::class, 'dataParticipant']);

    Route::get('/registrant', [AdminController::class, 'registrant']);
    
    Route::resource('/category', CategoryController::class); 

    Route::post('/logout-admin', [AuthAdmin::class, 'logout']);
});

Route::get('/', function () {
    return view('user-page/index');
});


