<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//---страницы
Route::get('/', [PageController::class, 'MainPage'])->name('MainPage');
Route::get('/registration', [PageController::class, 'RegistrationPage'])->name('RegistrationPage');
Route::get('/authorization', [PageController::class, 'AuthorizationPage'])->name('login');

Route::get('/user', [PageController::class, 'UserPage'])->name('UserPage');


//---функции
Route::post('/registration/save', [UserController::class, 'Registration'])->name('Registration');
Route::post('/authorization/entry', [UserController::class, 'Authorization'])->name('Authorization');
Route::get('/exit', [UserController::class, 'Exit'])->name('Exit');

Route::post('/task/create', [TaskController::class, 'create'])->name('CreateTask');
Route::post('/task/update/{task}', [TaskController::class, 'update'])->name('UpdateTask');
Route::delete('/task/delete/{task}', [TaskController::class, 'destroy'])->name('DeleteTask');
Route::post('/tasks/filter', [TaskController::class, 'filter'])->name('Filter');
