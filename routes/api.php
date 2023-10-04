<?php

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\RCHAcontroller\placeController;

Auth::routes([
    'verify'=>true
]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/login',[userAuthController::class,'login'])->name('login');
    Route::post('/register',[userAuthController::class,'register'])->name('register');
    Route::get('/profile',[userAuthController::class,'profile'])->name('profile');
    Route::post('/logout',[userAuthController::class,'logout'])->name('logout'); 
    //Route::get('/send',[MailController::class,'index'])->name('send');
    Route::post('sendPasswordResetLink', 'App\Http\Controllers\PasswordResetRequestController@sendEmail');
   // Route::post('resetPassword', 'App\Http\Controllers\ChangePasswordController@passwordResetProcess');

   Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
                
                Route::get('/send-email', [MailController::class,'sendEmail']);
Route::post('/storeNewPlace',[placeController::class,'storePlace'])->name('storeNewPlace');
Route::post('/upload-image',[imagesController::class,'createImage'])->name('upload-image');
});
