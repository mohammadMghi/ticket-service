<?php

use App\Http\Controllers\Admin\Ticket\ApproveBulkTicktController;
use App\Http\Controllers\Admin\Ticket\ApproveTicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Ticket\CreateTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->group(function (){
    Route::post('/login' , LoginController::class);
    Route::post('/register' , RegisterController::class);

    Route::middleware(['auth:sanctum' , 'admin'])->prefix('/admin')->group(function (){
        Route::put('/ticket/approve/{ticket_id}' , ApproveTicketController::class);
        Route::put('/ticket/bulk/approve' , ApproveBulkTicktController::class);
    });
    
    Route::prefix('/user')->middleware(['auth:sanctum'])->group(function (){
        Route::post('/ticket' , CreateTicketController::class);
    });

}); 