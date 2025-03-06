<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/template', function () {
    return view('template');
});

Route::get('/add-dosen', function () {
    return view('add-dosen');
});

Route::get('/update-dosen', function () {
    return view('update-dosen');
});


Route::get('/add-student', function () {
    return view('add-student');
});

Route::get('/update-student', function () {
    return view('update-student');
});
