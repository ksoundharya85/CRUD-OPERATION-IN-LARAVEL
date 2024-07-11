<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\studentformController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
Route::post('/submitlogin', [LoginController::class, 'login'])->name('submitlogin');

Route::get('/studentlist', [studentformController::class, 'index'])->name('student.list');
Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard',[studentformController::class,'studentpage'])->name('dashboard');
Route::post('/studentlist', [studentformController::class, 'form'])->name('studentlist');
Route::get('/editstudent/{studentid}', [studentformController::class, 'edit'])->name('editstudent');
Route::post('/updatestudent/{studentid}', [studentformController::class, 'update'])->name('updatestudent');
Route::delete('/deletestudent/{studentid}', [studentformController::class, 'destroy'])->name('deletestudent');
require __DIR__.'/auth.php';

