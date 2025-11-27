<?php

use App\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');