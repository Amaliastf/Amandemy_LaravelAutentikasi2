<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('products');
})->name('dashboard');

require __DIR__.'/auth.php';
