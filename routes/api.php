<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\studentcontroller;
use App\Http\Controllers\subjectcontroller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'create']);
//students
Route::get('/students', [studentcontroller::class, 'index']);
Route::get('/students/{id}', [studentcontroller::class, 'select']);
Route::post('/students', [studentcontroller::class, 'create']);
Route::patch('/students/{id}', [studentcontroller::class, 'update']);
Route::delete('/students/{id}', [studentcontroller::class, 'delete']);
//subjects
Route::get('/students/{id}/subjects', [subjectcontroller::class, 'index']);
Route::get('/students/{id}/subjects/{subject_id}', [subjectcontroller::class, 'select']);
Route::post('/students/{id}/subjects', [subjectcontroller::class, 'create']);
Route::patch('/students/{id}/subjects/{subject_id}', [subjectcontroller::class, 'update']);
