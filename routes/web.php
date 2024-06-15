<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get('/', function () {
    return view('admin.index');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin');

    // staff
    Route::resource('userAnswer', 'App\Http\Controllers\AnswerController');
    Route::get('users/export/', [AnswerController::class, 'export']);

});
