<?php

use App\Http\Controllers\apiTestController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\doc_inboundController;
use App\Http\Controllers\document_CategoryController;
use App\Http\Controllers\inbound_to_departController;
use App\Http\Controllers\userController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\doc_outboundController;
use App\Http\Controllers\outbound_detailController;
use App\Http\Resources\outbound_detailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//authentication
Route::post('/authenticate', [AuthenController::class, 'authenticate']);
Route::get('/logout', [AuthenController::class, 'logout']);
Route::put('/changepassword', [AuthenController::class, 'changepassword']);






//department
Route::get('/Department/all',[departmentController::class,'index']);
Route::post('/Department/add',[departmentController::class,'store']);
Route::put('/Department/edit/{department}',[departmentController::class,'update']);
Route::delete('/Department/delete/{department}', [departmentController::class,'destroy']);

//document_Category
Route::get('/DocCategory/all',[document_CategoryController::class,'index']);
Route::post('/DocCategory/add',[document_CategoryController::class,'store']);
Route::put('/DocCategory/edit/{document_Category}',[document_CategoryController::class,'update']);
Route::delete('/DocCategory/delete/{document_Category}', [document_CategoryController::class,'destroy']);

//user
Route::get('/user/all',[userController::class,'index']);
Route::post('/user/add',[userController::class,'store']);
Route::post('/user/{user}',[userController::class,'show']);
Route::put('/user/edit/{user}',[userController::class,'update']);
Route::delete('/user/delete/{user}', [userController::class,'destroy']);

//doc_inbound
Route::get('/doc_inbound/all',[doc_inboundController::class,'index']);
Route::post('/doc_inbound/add',[doc_inboundController::class,'store']);
Route::post('/doc_inbound/{doc_Inbound}',[doc_inboundController::class,'show']);
Route::put('/doc_inbound/edit/{doc_Inbound}',[doc_inboundController::class,'update']);
Route::delete('/doc_inbound/delete/{doc_Inbound}', [doc_inboundController::class,'destroy']);
//return DocInbound URL
Route::post('/docInbound/{fileName}',[doc_inboundController::class,'getFilePath']);

//inbound_to_department
Route::get('/inbound_to_Department/all',[inbound_to_departController::class,'index']);
Route::post('/inbound_to_Department/add',[inbound_to_departController::class,'store']);
Route::get('/inbound_to_Department/{inbound_to_Department}',[inbound_to_departController::class,'show']);
Route::put('/inbound_to_Department/edit/{inbound_to_Department}',[inbound_to_departController::class,'update']);
Route::delete('/inbound_to_Department/delete/{inbound_to_Department}', [inbound_to_departController::class,'destroy']);

//insert inbound_to_department file
Route::put('/inbound_to_Department/edit/{inbound_to_Department}',[inbound_to_departController::class,'insert_file']);

//outbound_detail
Route::get('/outbound_detail/all',[outbound_detailController::class,'index']);
Route::post('/outbound_detail/add',[outbound_detailController::class,'store']);
Route::get('/outbound_detail/{outbound_Detail}',[outbound_detailController::class,'show']);
Route::put('/outbound_detail/edit/{outbound_Detail}',[outbound_detailController::class,'update']);
Route::delete('/outbound_detail/delete/{outbound_Detail}', [outbound_detailController::class,'delete_form']);
Route::put('/outbound_detail/insert_file/{outbound_Detail}',[outbound_detailController::class,'insert_file']);
Route::post('/outbound_detail/makeOutForm',[outbound_detailController::class,'make_Out_De_form']);
Route::get('/print_out_de_form/{outbound_Detail}',[outbound_detailController::class,'print_out_form']);


//doc_outbound
Route::get('/doc_outbound/all',[doc_outboundController::class,'index']);
Route::post('/doc_outbound/add',[doc_outboundController::class,'store']);
Route::get('/doc_outbound/{doc_Outbound}',[doc_outboundController::class,'show']);
Route::put('/doc_outbound/edit/{doc_Outbound}',[doc_outboundController::class,'update']);
Route::put('/doc_outbound/insert_file/{doc_Outbound}',[doc_outboundController::class,'insert_file']);
Route::delete('/doc_outbound/delete/{doc_Outbound}', [doc_outboundController::class,'destroy']);
Route::post('/doc_outbound/add/make_out_doc',[doc_outboundController::class,'make_out_doc']);
Route::get('/doc_outbounds/{outbound_Detail_Id}',[doc_outboundController::class,'show_by_out_de']);

//services

Route::get('/inbound/{depart}/all',[doc_inboundController::class,'depart_doc']);
Route::get('/outbound/{depart}/all',[doc_outboundController::class,'depart_out_doc']);

//apitest
Route::post('/apitest',[apiTestController::class,'store']);

//view
Route::get('/viewDocIn/{docId}', [doc_inboundController::class, 'viewPdf']);
