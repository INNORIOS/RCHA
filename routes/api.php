<?php


//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\RCHAcontroller\placeController;
use App\Http\Controllers\RCHAcontroller\imagesController;
use App\Http\Controllers\paymentGatways\flutterController;
use App\Http\Controllers\RCHAcontroller\paymentController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

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

/*  ROUTE FOR IMAGE CONTROLLER API*/
// Route::post('/upload-image',[imagesController::class,'createImage']);
Route::post('multiple-image-upload', [imagesController::class, 'createImage']);
Route::PUT('/updateImage/{id}', [imagesController::class, 'updateImage']);
Route::delete('/deleteImage/{id}', [imagesController::class, 'deleteImage']);
Route::get('/getImageById/{id}', [imagesController::class, 'getImageById']);


/*  ROUTE FOR PLACE CONTROLLER API*/
Route::post('/storeNewPlace',[placeController::class,'storePlace'])->name('storeNewPlace');
Route::get('/places', [placeController::class, 'getPlaces']);
Route::get('/place/{id}', [placeController::class, 'getPlaceById']);
Route::put('/updatePlace/{id}', [placeController::class, 'updatePlace']);
Route::delete('/deletePlace/{id}', [placeController::class, 'deletePlace']);

/** ROUTE FOR PAYMENT INFO CONTROLLER */
Route::post('/savePaymentinfo',[paymentController::class,'payment']);
Route::get('/getPaymentInfo',[paymentController::class,'getPaymentInfo']);


/** ROUTE FOR FLUTTERWAVE PAYMENT CONTROLLER */
// The route that the button calls to initialize payment
Route::post('/pay', [flutterController::class, 'initialize'])->name('pay');
// The callback url after a payment
Route::get('/rave/callback', [flutterController::class, 'callback'])->name('callback');

/** ROUTE FOR sendVideoLink AFTER PAYMENT */
if(\Illuminate\Support\Facades\App::environment('local')){
    Route::get('/sendVideoLinkView',function(){
    return (new \App\Mail\sendVideoLink())->render();
    });
    }
});
