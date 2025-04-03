<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Cache;

Route::get('/', [HomeController::class, 'index']);
Route::get('/up', HealthCheckController::class);

Route::get('/test-cache', function () {
    Cache::put('test_key', 'test_value', 60);
    return [
        'prefix' => config('cache.prefix'),
        'key' => 'test_key',
        'full_key' => config('cache.prefix') . ':test_key'
    ];
});
