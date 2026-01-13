<?php

use App\Http\Middleware\CheckDoodlePassword;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    if (session('doodle_authenticated')) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::get('/', function () {
    return view('home');
})->middleware(CheckDoodlePassword::class)->name('home');
