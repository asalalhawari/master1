<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AppointmentController;

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

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\bookingController;

Route::get('/dash', [DashboardController::class, 'index']);




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


Route::resource('services', ServiceController::class);



Route::get('/dash', function () {
    return view('dashbord.layout.dashboard');
});
// Route::get('/super_dash', function () {
//     return view('dashbord.layout.superdashboard');
// });
Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/dashboard/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::resource('contacts', ContactController::class);

Route::resource('users', UserController::class);

Route::resource('appointments', AppointmentController::class);

Route::get('appointments/{id}/restore', [AppointmentController::class, 'restore'])->name('appointments.restore');
Route::delete('appointments/{id}/force-delete', [AppointmentController::class, 'forceDelete'])->name('appointments.forceDelete');

Route::get('/statistics', [StatisticsController::class, 'index']);

Route::put('/appointments/{appointment}/rate', [AppointmentController::class, 'updateRating'])->name('appointments.updateRating');

/// Email verification route
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth', 'verified'])->name('verification.notice');

// Handle the verification logic
Route::get('email/verify/{id}/{hash}', [RegisteredUserController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend verification email route
Route::post('email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
// Register routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Show the registration form
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Handle the registration logic
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);



Route::get('email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [RegisteredUserController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/dashboard', function () {
    return view('dashbord.layout.dashbord');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/book-appointment', function () {
    return view('book-appointment');
})->name('book-appointment');


Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('book-appointment');

Route::get('/about', function () {
    return view('public.layout.about');
});

Route::get('/contact', function () {
    return view('public.layout.contact');
});

// Update Rating
Route::put('/appointments/{appointment}/rating', [AppointmentController::class, 'updateRating'])->name('appointments.updateRating');

// Update Review
Route::put('/appointments/{appointment}/review', [AppointmentController::class, 'updateReview'])->name('appointments.updateReview');

Route::get('/service', action: function () {
    return view('public.layout.services');
});
Route::middleware('auth')->group(function () {
    // Protected routes go here
});


Route::get('/booking', function () {
    return view('public.layout.booking');
});

Route::get('/booking', [BookingController::class, 'show']);


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/admin-profile', function () {
    return view('admin.profile');
});
Route::middleware(['auth', 'role:super_admin'])->get('/super-admin-dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
Route::middleware(['auth', 'role:admin'])->get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/', [HomeController::class, 'index'])->name('homepage');



Route::post('/book-appointment', [BookingController::class, 'store'])->name('book-appointment');

Route::resource('customer',CustomerController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Apply the role middleware to ensure only super_admins can access these routes
Route::middleware(['role:super_admin'])->group(function() {
    Route::get('/admin-management', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin-management/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin-management', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin-management/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin-management/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin-management/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


require __DIR__.'/auth.php';
