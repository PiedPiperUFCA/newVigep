<?php

//use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ACL\RoleController;
use App\Http\Controllers\ACL\PermissionController;
use App\Http\Controllers\FormsController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::middleware('auth')->group(function () {
    /** Usuários */
    Route::get('users/load', [UserController::class, 'loadDataTable'])->name('users.load');
    Route::get('users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');
    Route::put('users/updateProfile/{user}', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::post('users/{user}/active', [UserController::class, 'activeUser'])->name('users.active');
    Route::post('users/deactivate/{user}', [UserController::class, 'deactivateUser'])->name('users.deactivate');
    Route::resource('users', UserController::class);

    /** Perfis */
    Route::get('roles/load', [RoleController::class, 'loadDataTable'])->name('roles.load');
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions/sync', [RoleController::class, 'permissionsSync'])->name('roles.permissionsSync');
    Route::resource('roles', RoleController::class);
    /** Permissões */
    Route::get('permissions/load', [PermissionController::class, 'loadDataTable'])->name('permissions.load');
    Route::resource('permissions', PermissionController::class);

    /** Formulários */
    Route::get('/forms', [FormsController::class, 'forms']);
    Route::get('forms/antirabico', [FormsController::class, 'antirabico']);
});

require __DIR__ . '/auth.php';
