<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Database\Eloquent\Model;
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

Route::middleware('auth:sanctum')->post("/logout",[UserController::class , 'logout']);
Route::middleware('auth:sanctum')->get("/user-details",[UserController::class, 'userDetails']);
Route::middleware('auth:sanctum')->post("/edit-user",[UserController::class, 'editDetials']);

Route::middleware('auth:sanctum')->post("/create-topic",[TopicController::class, 'createTopic']);
Route::middleware('auth:sanctum')->post("/delete-topic",[TopicController::class, 'removeTopic']);
Route::middleware('auth:sanctum')->get("/find-topic",[TopicController::class, 'findTopic']);
Route::middleware('auth:sanctum')->put("/edit-topic",[TopicController::class, 'editTopic']);

Route::middleware('auth:sanctum')->post("/add-comment",[CommentController::class, 'addComment']);
Route::middleware('auth:sanctum')->post("/edit-comment",[CommentController::class, 'editComment']);
Route::middleware('auth:sanctum')->post("/delete-comment",[CommentController::class, 'deleteComment']);

Route::post("/register-user",[UserController::class , 'registerUser']);
Route::post("/login",[UserController::class , 'login']);

Route::get("/get-topics",[HomeController::class, 'homeView']);