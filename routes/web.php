<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\PokemonController;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->post('/user/avatar', [ProfileController::class, 'updateAvatar']);


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');;

Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');

Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

Route::middleware('auth')->group(function () {
    Route::post('/comments', [UserCommentController::class, 'store']);
    Route::put('/comments/{id}', [UserCommentController::class, 'update']);
    Route::delete('/comments/{id}', [UserCommentController::class, 'destroy']);
    Route::patch('/comments/{id}/restore', [UserCommentController::class, 'restore']);
});

Route::resource('companies', CompanyController::class);
Route::middleware(['auth'])->group(function () {
    Route::post('/companies/{company}/toggle-interest', [CompanyController::class, 'toggleInterest'])
        ->name('companies.toggleInterest');
});
Route::get('/interests', [CompanyController::class, 'interestedCompanies'])->middleware(['auth']);


Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/{id}', [PokemonController::class, 'show'])->name('pokemon.show');


require __DIR__.'/auth.php';
