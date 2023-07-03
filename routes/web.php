<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('index');
});

Route::get('/list-category',[CategoriesController::class,'list_category']);
Route::get('/add-category',[CategoriesController::class,'create_category']);
Route::post('/add-category',[CategoriesController::class,'add_category']);
Route::get('/edit-category/{id}',[CategoriesController::class,'edit_view']);
Route::post('/update-category/{id}',[CategoriesController::class,'update']);
Route::delete('/delete-category/{id}',[CategoriesController::class,'delete']);

Route::get('/add-product',[ProductController::class,'view_add']);
Route::post('/add-product',[ProductController::class,'add']);
Route::get('/list-product',[ProductController::class,'list_product']);
Route::get('/edit/{id}',[ProductController::class,'view_edit']);
Route::post('/update/{id}',[ProductController::class,'update']);
Route::delete('/delete/{id}',[ProductController::class,'delete']);
