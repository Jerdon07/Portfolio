<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
