<?php

use Illuminate\Support\Facades\Route;
use Marjose123\FilamentWebhookServer\Http\Controllers\WebhookController;

Route::prefix('/webhook-server/api')->group(function () {
    Route::get('/', [WebhookController::class, 'get']);
    Route::post('/', [WebhookController::class, 'create']);
    Route::patch('/{id}', [WebhookController::class, 'update']);
    Route::delete('/{id}', [WebhookController::class, 'delete']);
});
