<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'status'  => 'ok',
        'message' => 'MediaHub API is working!',
    ]);
});