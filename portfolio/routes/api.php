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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(\App\Http\Controllers\API\AuthController::class)->group(function (){
    Route::post('login', 'login');

    Route::post('register','register');

});

Route::controller(\App\Http\Controllers\API\AboutController::class)->group(function (){
   Route::get('edit_about','edit_about');
   Route::post('update_about/{id}', 'update_about');
});

Route::controller(\App\Http\Controllers\API\ServiceController::class)->group(function () {
    Route::get('display_all_service', 'index');
    Route::post('create_service', 'create');
    Route::post('update_service/{id}', 'update');
    Route::get('/delete_service/{id}', 'delete');

});

Route::controller(\App\Http\Controllers\API\SkillController::class)->group(function () {
    Route::get('/get_all_skill', 'get_all_skill');
    Route::post('/create_skill', 'create_skill');
    Route::post('/update_skill/{id}', 'update_skill');
    Route::get('delete_skill/{id}','delete');
});
Route::controller(\App\Http\Controllers\API\Edu::class)->group(function () {
    Route::get('display_all_education', 'get_all_education');
    Route::post('create_education', 'create_education');
    Route::post('update_education/{id}', 'update');
    Route::get('delete_education/{id}', 'delete');
});
Route::controller(\App\Http\Controllers\API\ExperienceController::class)->group(function () {
    Route::get('display_all_experience', 'get_all_experience');
    Route::post('create_experience', 'create_experience');
    Route::post('update_experience/{id}', 'update');
    Route::get('delete_experience/{id}', 'delete');
});
Route::controller(\App\Http\Controllers\API\ProjectController::class)->group(function () {
    Route::get('display_all_project', 'get_all_project');
    Route::post('/add_project', 'add_project');
    Route::get('/get_edit_project/{id}', 'get_edit_project');
    Route::post('/update_project/{id}', 'update_project');
    Route::get('/delete_project/{id}', 'delete_project');
});
Route::controller(\App\Http\Controllers\API\UserController::class)->group(function(){
    Route::get('/get_all_user', 'get_all_user');
    Route::post('/create_user', 'create_user');
    Route::post('/update_user/{id}', 'update_user');
    Route::delete('/delete_user/{id}', 'delete_user');
    Route::get('/profile', 'profile');
    Route::post('/update_profile/{id}', 'update_profile');
    Route::get('/get_user_name', 'get_user_name');
});
