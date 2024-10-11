<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\FrontController;

//Front
Route::get("/", [UserController::class, 'dashboard'])->name('user.home')->middleware('auth');
Route::get("/about", [FrontController::class, 'about'])->name('about');


// User
Route::middleware('auth')->group( function(){

    Route::get("/dashboard", [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get("/course/details/{id}", [UserController::class, 'course'])->name('user.course');
    
    Route::get("/course/details/{id1}/{slug}/{id2}", [UserController::class, 'course'])->name('user.course.module');
 
    Route::get("/course/assignments/download/{id}", [UserController::class, 'assignments_download'])->name('user.assignments.download');
    Route::get("/course/assignments", [UserController::class, 'assignments'])->name('user.assignments');
    Route::post("/course/assignments/upload", [UserController::class, 'assignments_upload'])->name('user.assignments.upload');
  
    Route::get("/course/getquestion/{id}", [UserController::class, 'getquestion'])->name('user.quiz.getquestion');
    Route::get("/course/quiz/{id}", [UserController::class, 'quiz_start'])->name('user.quiz.start');
    Route::get("/course/quiz/result", [UserController::class, 'quiz_result'])->name('user.quiz.result');
   

});

Route::get("/login", [AuthController::class, 'loginshow'])->name('login');
Route::post("/login", [AuthController::class, 'login'])->name('login.submit');
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');



require __DIR__.'/admin.php';