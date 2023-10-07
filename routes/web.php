<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('index');
});

Route::get('/add-product',[ProductController::class,'view_add']);
Route::post('/add-product',[ProductController::class,'add']);
Route::get('/list-product',[ProductController::class,'list_product']);
Route::get('/edit/{id}',[ProductController::class,'view_edit']);
Route::post('/update/{id}',[ProductController::class,'update']);
Route::delete('/delete-product/{id}',[ProductController::class,'delete']);
