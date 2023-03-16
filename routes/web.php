<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
   return redirect('/login');
});

Auth::routes(['verify' => true]);

//require __DIR__ . '/auth.php';
