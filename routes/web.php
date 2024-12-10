<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Verified;
 
 
use Illuminate\Support\Facades\Hash;
use App\Models\User;


//use App\Http\Controllers\PoemController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PoetryController;
use App\Http\Controllers\Web\APIController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\EmailVerificationController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/poetry', [PoetryController::class, 'index'])->name('poetry');
Route::get('/api', [APIController::class, 'index'])->name('api');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/poem/{id}', [PoetryController::class, 'show'])->name('poem.show');
Route::post('/poem/make', [PoetryController::class, 'create'])->name('poem.make');
Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');





 