<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');

// });
Route::get('/courses',[CourseController::class,'index'])->name('courses');
Route::get('/course/{id}',[CourseController::class,'show'])->name('courses.show');

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('/course/{id}',[CourseController::class,'show'])->name('courses.show');
    Route::post('/courses',[CourseController::class,'store'])->name('courses.store');
    Route::get('/courses/edit/{id}',[CourseController::class,'edit'])->name('courses.edit');
    Route::patch('/courses/{id}',[CourseController::class,'update'])->name('courses.update');
    Route::post('/toggleProgress',[CourseController::class,'toggleProgress'])->name('courses.toggle');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
