<?php

use App\Http\Controllers\UsuarioApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource("usuarios", UsuarioApiController::class);