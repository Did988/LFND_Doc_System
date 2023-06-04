<?php

use App\Http\Controllers\doc_inboundController;
use App\Http\Controllers\outbound_detailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/OutDetail/view/{outDocId}', [outbound_detailController::class, 'ViewOutDetail']);
Route::get('/testPdf/{outDocId}', [outbound_detailController::class, 'testPdf']);

Route::get('/viewDocIn/{docId}', [doc_inboundController::class, 'viewPdf']);


