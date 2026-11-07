<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Middleware\EnsureUserIsLoggedIn;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;


Route::get('/send-welcome', function () {
$recipientEmail = 'student@example.com';
$name = 'ghazala roqia';
// Sends a real email via Gmail SMTP
Mail::to($recipientEmail)->send(new WelcomeEmail($name));
return 'Email successfully sent via Gmail SMTP!';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/index', function () {
//     return '<h1>Welcome to the Dashboard</h1>';
// })->name('login');

Route::get('/index', function () {
    return '<h1>Welcome to the Dashboard</h1>';
})->middleware('auth');

require __DIR__.'/auth.php';
