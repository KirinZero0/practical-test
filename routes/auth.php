<?php

use App\Actions\Auth\Login\Login;
use App\Actions\Auth\Login\LoginView;
use App\Actions\Auth\Logout;
use App\Actions\Auth\Recovery\Password\EmailForm;
use App\Actions\Auth\Recovery\Password\ResetForm;
use App\Actions\Auth\Recovery\Password\ResetPassword;
use App\Actions\Auth\Recovery\Password\ResetRequest;
use App\Actions\Auth\Register\Register;
use App\Actions\Auth\Register\RegisterView;
use App\Actions\Confirmation\Password\Confirmation;
use App\Actions\Confirmation\Password\ConfirmationView;
use App\Actions\Profile\Password\Update;
use App\Actions\Verification\Email\Notification;
use App\Actions\Verification\Email\Prompt;
use App\Actions\Verification\Email\Verify;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', RegisterView::class)
                ->name('register');

    Route::post('register', Register::class);

    Route::get('login', LoginView::class)
                ->name('login');

    Route::post('login', Login::class);

    Route::get('forgot-password', ResetRequest::class)
                ->name('password.request');

    Route::post('forgot-password', EmailForm::class)
                ->name('password.email');

    Route::get('reset-password/{token}', ResetForm::class)
                ->name('password.reset');

    Route::post('reset-password', ResetPassword::class)
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', Prompt::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', Verify::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', Notification::class)
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', ConfirmationView::class)
                ->name('password.confirm');

    Route::post('confirm-password', Confirmation::class);

    Route::put('password', Update::class)->name('password.update');

    Route::post('logout', Logout::class)
                ->name('logout');
});
