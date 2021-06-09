<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::any('/buy', [Controller::class, 'buy']);
Route::any('/sell', [Controller::class, 'sell']);
