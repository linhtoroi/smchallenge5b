<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Controller;
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

Route::get('/', function () {
    return view('login');
});

Route::get('logout', [Controller::class, 'logout']);
Route::any('/listOfUsers', [UserController::class, 'index']);
Route::get('/detail/{username}', [UserController::class, 'show'])->name('detail');
Route::any('/listOfUsersType/{id}', [UserController::class, 'type'])->name('listOfUsersType');
Route::get('/edit', [UserController::class, 'edit'])->name('edit');
Route::get('/editForTeacher/{username}', [UserController::class, 'editForTeacher'])->name('editForTeacher');
Route::any('/editComplete', [UserController::class, 'editComplete'])->name('editComplete');
Route::any('/editCompleteForTeacher/{username}', [UserController::class, 'editCompleteForTeacher'])->name('editCompleteForTeacher');
Route::any('/delete/{username}', [UserController::class, 'destroy'])->name('delete');

// Route::post('/signUp', [UserController::class, 'store']);

Route::any('/message', [MessageController::class, 'index']);
Route::get('/detailMessage/{username}', [MessageController::class, 'show'])->name('detailMessage');
Route::any('inbox', [MessageController::class, 'inbox'])->name('inbox');
Route::any('myMessage/{accountSender}', [MessageController::class, 'myMessage'])->name('myMessage');
Route::any('messageDelete', [MessageController::class, 'messageDelete'])->name('messageDelete');
Route::any('messageEdit', [MessageController::class, 'messageEdit'])->name('messageEdit');
Route::any('openMessageEdit', [MessageController::class, 'openMessageEdit'])->name('openMessageEdit');

Route::any('/challenge', [ChallengeController::class, 'index']);
Route::get('/detailChallenge/{id}', [ChallengeController::class, 'show'])->name('detailChallenge');
Route::post('postChallengeFile', [ChallengeController::class, 'postChallengeFile'])->name('postChallengeFile');
Route::post('answerChallenge', [ChallengeController::class, 'answerChallenge'])->name('answerChallenge');

Route::any('/exercise', [ExerciseController::class, 'index']);
Route::get('/detailExercise/{id}', [ExerciseController::class, 'show'])->name('detailExercise');
Route::post('postFile', [ExerciseController::class, 'postFile'])->name('postFile');
Route::post('postExerciseFile', [ExerciseController::class, 'postExerciseFile'])->name('postExerciseFile');
Route::post('detailExercise/postHomeworkFile', [ExerciseController::class, 'postHomeworkFile'])->name('postHomeworkFile');
Route::get('/detailExercise/downloadExercise/{file}', [ExerciseController::class, 'downloadExercise']);
Route::get('/detailExercise/downloadHomework/{file}', [ExerciseController::class, 'downloadHomework']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

