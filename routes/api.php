<?php

use App\Http\Controllers\api\v1\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('list-education', [UserApiController::class, 'listEducations']);
    Route::get('list-companies', [UserApiController::class, 'listCompanies']);
    Route::post('add-user', [UserApiController::class, 'addUser']);
    Route::post('find-user', [UserApiController::class, 'findUser']);
    Route::post('update-user', [UserApiController::class, 'updateUser']);
    Route::post('delete-user', [UserApiController::class, 'deleteUser']);
});
