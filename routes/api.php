<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReservaController;
use App\Http\Controllers\API\MailController;

use App\Http\Controllers\API\SendEmailController;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
     
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('reservas', ReservaController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('email', [MailController::class, 'sendEmail']);
        
    Route::get('sendemail', [SendEmailController::class, 'sendEmail']);
    //Route::post'sendemail', [SendEmailController::class, 'sendMail']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
