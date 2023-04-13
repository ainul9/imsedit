<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('list_task', [App\Http\Controllers\backend\TaskController::class,'TaskList'])->name('task.index');
Route::get('/add_task/{agentID}',[App\Http\Controllers\backend\TaskController::class,'TaskAdd'])->name('taskadd');
Route::post('/insert_task', [App\Http\Controllers\backend\TaskController::class,'TaskInsert']);
Route::get('/edit_task/{id}', [App\Http\Controllers\backend\TaskController::class,'TaskEdit']);
Route::post('/update_task/{id}', [App\Http\Controllers\backend\TaskController::class,'TaskUpdate']);
Route::get('/delete_task/{id}', [App\Http\Controllers\backend\TaskController::class,'TaskDelete']);

Route::get('user_list', [App\Http\Controllers\backend\UsermanagementController::class,'UserList'])->name('user.index');
Route::get('/edit_user/{id}', [App\Http\Controllers\backend\UsermanagementController::class,'UserEdit']);
Route::post('/update_user/{id}', [App\Http\Controllers\backend\UsermanagementController::class,'UserUpdate']);
Route::get('/delete_user/{id}', [App\Http\Controllers\backend\UsermanagementController::class,'UserDelete']);

Route::get('list_agent', [App\Http\Controllers\backend\AgentController::class,'AgentList'])->name('agent.index');
Route::get('/add_agent/{usersID}/{agentName}',[App\Http\Controllers\backend\AgentController::class,'AgentAdd'])->name('agentadd');
Route::post('/insert_agent/{usersID}', [App\Http\Controllers\backend\AgentController::class,'AgentInsert']);
Route::get('/show_details/{usersID}', [App\Http\Controllers\backend\AgentController::class,'AgentShow']);
Route::get('/edit_agent/{agentID}', [App\Http\Controllers\backend\AgentController::class,'AgentEdit']);
Route::post('/update_agent/{agentID}', [App\Http\Controllers\backend\AgentController::class,'AgentUpdate']);
Route::get('/delete_agent/{agentID}', [App\Http\Controllers\backend\AgentController::class,'AgentDelete']);

