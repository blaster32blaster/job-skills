<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('jobs', App\Http\Controllers\Api\JobsController::class)
    ->only('index');

Route::resource('skills', App\Http\Controllers\Api\SkillsController::class)
    ->only('index');
