<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RelevanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Exports\AnimalsChartExport;
use App\Exports\AdocoesChartExport;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/', [HomeController::class, 'show']);

Route::get('/about', [AboutController::class, 'show']);

Route::get('/gallery', [GalleryController::class, 'show']);

Route::post('/gallery', [GalleryController::class, 'show']);

Route::get('/animal/{id}', [DetailsController::class, 'show']);

Route::post('/animal/{id}/store', [DetailsController::class, 'store']);

Route::get('/relevance', [RelevanceController::class, 'show']);

Route::get('/contact', [ContactController::class, 'show']);

Route::get('/login', [AuthController::class, 'showLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/profile', [UserController::class, 'showProfile']);

Route::post('/profile/edit/{id}', [UserController::class, 'update']);

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'pt',])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
});

Route::get('/blog', [PostController::class, 'show']);

Route::get('/blog/new_post', [PostController::class, 'showAdd']);

Route::post('/blog/new_post/{id}', [PostController::class, 'add']);

Route::get('/blog/post/{id}', [PostController::class, 'showPost']);

Route::post('/delete/{id}', [PostController::class, 'delete']);

Route::get('/blog/edit/{id}', [PostController::class, 'showEdit']);

Route::post('/blog/edit/{id}', [PostController::class, 'edit']);

Route::post('/livewire/upload-image', [PostController::class, 'uploadImage'])->name('livewire.upload-image');

Route::middleware('admin')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard']);

        Route::get('/animais-pdf', [AnimalController::class, 'generatePdfAnimalsChart']);
        Route::get('/adocoes-pdf', [AnimalController::class, 'generatePdfAdocoesChart']);

        Route::get('/animais-excel', function () {
            return Excel::download(new AnimalsChartExport, 'relatorio-animais.xlsx');
        });
        Route::get('/adocoes-excel', function () {
            return Excel::download(new AdocoesChartExport, 'relatorio-adocoes.xlsx');
        });


        Route::prefix('users')->group(function () {
            Route::get('/list', [UserController::class, 'showList']);
            Route::get('/add', [UserController::class, 'showAdd']);
            Route::post('/add', [UserController::class, 'add']);
            Route::get('/edit/{id}', [UserController::class, 'showEdit']);
            Route::post('/edit/{id}', [UserController::class, 'update']);
            Route::post('/delete/{id}', [UserController::class, 'delete']);
        });

        Route::prefix('animal')->group(function () {
            Route::get('/list', [AnimalController::class, 'show']);
            Route::get('/edit/{id}', [AnimalController::class, 'showEdit']);
            Route::post('/edit/{id}', [AnimalController::class, 'update']);
            Route::get('/add', [AnimalController::class, 'showAdd']);
            Route::post('/add', [AnimalController::class, 'add']);
            Route::post('/delete/{id}', [AnimalController::class, 'delete']);
            Route::get('/list/export', [AnimalController::class, 'exportExcel']);
            Route::get('/list/animais-pdf', [AnimalController::class, 'generatePdf']);
        });
    });
});
