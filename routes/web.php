<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioAdminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/freelancing', [PortfolioController::class, 'freelancing'])->name('freelancing');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:3,1')->name('contact.store');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [PortfolioController::class, 'project'])->name('projects.show');
Route::get('/music', [PortfolioController::class, 'music'])->name('music.index');
Route::get('/photography', [PortfolioController::class, 'photography'])->name('photography.index');
Route::get('/photography/{slug}', [PortfolioController::class, 'photography'])->name('photography.category');
Route::get('/sitemap.xml', [PortfolioController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', fn (Request $request) => response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".$request->getSchemeAndHttpHost().'/sitemap.xml'."\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']))->name('robots');
Route::view('/privacy', 'pages.legal', ['document' => 'Privacy policy'])->name('privacy');
Route::view('/terms', 'pages.legal', ['document' => 'Terms of service'])->name('terms');

Route::middleware('guest')->group(function (): void {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:20,1');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', fn (string $token) => view('auth.reset-password', ['token' => $token]))->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:5,1')->name('password.store');
});

Route::middleware(['auth', 'auth.session'])->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/verify-email', 'auth.verify-email')->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])->middleware('throttle:6,1')->name('verification.send');
    Route::view('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'password'])->middleware('throttle:6,1')->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('throttle:6,1')->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.session', 'verified', 'can:manage-portfolio'])->group(function (): void {
    Route::get('/', [PortfolioAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PortfolioAdminController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [PortfolioAdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/messages', [PortfolioAdminController::class, 'contactMessages'])->name('messages.index');
    Route::get('/messages/{message}', [PortfolioAdminController::class, 'showContactMessage'])->name('messages.show');
    Route::delete('/messages/{message}', [PortfolioAdminController::class, 'destroyContactMessage'])->name('messages.destroy');
    Route::get('/{resource}', [PortfolioAdminController::class, 'index'])->name('resources.index');
    Route::get('/{resource}/create', [PortfolioAdminController::class, 'create'])->name('resources.create');
    Route::post('/{resource}', [PortfolioAdminController::class, 'store'])->name('resources.store');
    Route::get('/{resource}/{entry}/edit', [PortfolioAdminController::class, 'edit'])->name('resources.edit');
    Route::put('/{resource}/{entry}', [PortfolioAdminController::class, 'update'])->name('resources.update');
    Route::delete('/{resource}/{entry}', [PortfolioAdminController::class, 'destroy'])->name('resources.destroy');
});
