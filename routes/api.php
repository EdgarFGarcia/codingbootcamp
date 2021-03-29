<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Endpoint for Category
 */
Route::post('/createcategory', [ApiController::class, 'createcategory']);
Route::get('/getcategory/{item?}', [ApiController::class, 'getcategory']);
Route::put('/updatecategory/{id?}', [ApiController::class, 'updatecategory']);
Route::delete('/deletecategory/{id?}', [ApiController::class, 'deletecategory']);

/**
 * Endpoint for Item
 */
Route::post('/createitem', [ApiController::class, 'createitme']);
Route::get('/getitems/{item?}', [ApiController::class, 'getitems']);
Route::put('/updateitem/{id?}', [ApiController::class, 'updateitem']);
Route::delete('/deleteitem/{id?}', [ApiController::class, 'deleteitem']);