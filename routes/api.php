<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\V1\TokenController;
use App\Http\Controllers\API\V1\PoemController;



Route::prefix('v1')->group(function ()  {

        // this route has two modes: 1. email verification 2. token creation
        Route::post('token/create',   [TokenController::class, 'create'])->name('token.create');

        Route::middleware(['auth:sanctum'])->group(function () 
        {
                // TODO: list user's poems (or all public poems) / delete a user's poem
                // Route::get('poems', [PoemController::class, 'index'])->name('poems.index');
                // Route::get('poem/{id}/delete', [PoemController::class, 'destroy'])->name('poem.delete');
                
                Route::get('poem/{$id}', [PoemController::class, 'show'])->name('api.poem.show');
                Route::post('poem/create', [PoemController::class, 'create'])->name('api.poem.create');

                // TODO: show user tokens / delete a user tokens
                //   Route::get('tokens', [TokenController::class, 'index'])->name('tokens.show');
                //   Route::post('token/{id}/delete', [TokenController::class, 'destroy'])->name('token.delete');
        });
 
});


Route::fallback(function () {
        return response()->json(['result' => 'failure', 'errors' => ['Not Found']], 404);
});