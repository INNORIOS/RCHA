<?php


//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
use App\Http\Controllers\RCHAcontroller\paymentInfoExportController;
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
Route::post('/generatePaidLink',[paymentController::class,'generatePaidLink']);
Route::get('/processPaidLinks/{id}',[paymentController::class,'processPaidLink']);
Route::get('/showPaymentInfos', [paymentController::class,'showPaymentInfo']);
Route::get('/videoView/{paidToken}', [paymentController::class, 'validatePaidToken']);


/** ROUTE FOR FLUTTERWAVE PAYMENT CONTROLLER */
// The route that the button calls to initialize payment
Route::post('/pay', [flutterController::class, 'initialize'])->name('pay');
// The callback url after a payment
Route::get('/rave/callback', [flutterController::class, 'callback'])->name('callback');


/**ROUTE FOR EXPORTING FILE IN EXCEL */
Route::get('/exportPaymentInfoExcel',[paymentInfoExportController::class,'export']);


/**ROUTE TO SEND PAID TOKEN EMAIL TO PAID USER */
Route::post('/sendVideoLinkView', function (Request $request) {
    try {
        $user = Auth::user();
        $place_id = $request->input('place_id');

        // Call the generatePaidLink method with a request object
        $paidLinkResponse = app('App\Http\Controllers\RCHAcontroller\paymentController')->generatePaidLink($request);

        // Get the JSON data from the response
        $data = $paidLinkResponse->getData();

        if (isset($data->paidToken)) {
            \Illuminate\Support\Facades\Mail::to($user->email)
                ->send(new \App\Mail\sendVideoLink($user, $data->paidToken));

            return 'Email sent successfully!';
        }

        return 'Error generating paid link';

    } catch(\Exception $e) {
        Log::error('Exception occurred: ' . $e->getMessage());
        return response()->json([
            'message' => 'An error occurred while sending the token.',
        ], 500);
    }
});

/**CALLING paymentInfoExportView DOWNLOAD BUTTON */
Route::get('downloadPaymentInfoExport',function(){
    return view('paymentInfoExportView');
});
Route::get('/export-payment-info', [paymentInfoExportController::class, 'exportPaymentInfo']);


});

