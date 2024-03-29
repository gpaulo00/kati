<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Models\Student;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('home');
});
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AppController::class, 'profile'])->name('profile');
    Route::post('/student/edit/{user}', [AppController::class, 'student_edit'])->name('student.edit');
    Route::post('/student/create', [AppController::class, 'student_create'])->name('student.create');
    Route::get('/students', [AppController::class, 'student_searcher'])->name('students');
    Route::get('/students/search', [AppController::class, 'student_form_edit2'])->name('students.search');
    Route::get('/students/modify/{user}', [AppController::class, 'student_form_edit'])->name('students.form.edit');
    Route::get('/students/create', [AppController::class, 'student_form_create'])->name('students.form.create');

    Route::get('/workers', [AppController::class, 'worker_searcher'])->name('workers');
    Route::post('/worker/edit/{user}', [AppController::class, 'worker_edit'])->name('worker.edit');
    Route::post('/worker/create', [AppController::class, 'worker_create'])->name('worker.create');
    Route::get('/workers/search', [AppController::class, 'worker_form_edit2'])->name('workers.search');
    Route::get('/workers/modify/{user}', [AppController::class, 'worker_form_edit'])->name('workers.form.edit');
    Route::get('/workers/create', [AppController::class, 'worker_form_create'])->name('workers.form.create');

    Route::get('/notifications', [AppController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/edit/{notif}', [AppController::class, 'notif_edit'])->name('notifications.edit');
    Route::post('/notifications/delete/{notif}', [AppController::class, 'notif_delete'])->name('notifications.delete');
    Route::post('/notifications/create', [AppController::class, 'notif_create'])->name('notifications.create');

    Route::get('/password', [AppController::class, 'password'])->name('password');
    Route::post('/update_password', [AppController::class, 'change_password'])->name('password.change');

    Route::get('/mision', function () {
        return view('mision');
    })->name('mision');
    Route::get('/vision', function () {
        return view('vision');
    })->name('vision');
    Route::get('/resena_historica', function () {
        return view('resena_historica');
    })->name('resena_historica');

    Route::get('/reports/constancia_inscripcion.pdf', [PdfController::class, 'constancia_inscripcion'])->name('reports.inscripcion');
    Route::get('/reports/constancia_estudios.pdf', [PdfController::class, 'constancia_estudios'])->name('reports.estudios');
    Route::get('/reports/constancia_trabajo.pdf', [PdfController::class, 'constancia_trabajo'])->name('reports.trabajo');
    Route::get('/reports/constancia_retiro.pdf', [PdfController::class, 'constancia_retiro'])->name('reports.retiro');
    Route::get('/reports/constancia_prosecucion.pdf', [PdfController::class, 'constancia_prosecucion'])->name('reports.prosecucion');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
*/