<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImagesController;
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

// Use all of the routes created in the ProducController.php file
// Route::resource('products', ProductController::class);

//Public routes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/get_all_users', [AuthController::class, 'index']);


Route::get('/products', [ProductController::class, 'index']);
Route::get('/paginatedproducts', [ProductController::class, 'indexPaginated']);

Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);

Route::post('/set_profile', [HouseController::class, 'store']);
Route::get('/get_profiles', [HouseController::class, 'index']);
Route::get('/get_user_profile/{id}', [HouseController::class, 'show']);

Route::get('/get_images', [ImagesController::class, 'index']);
Route::get('/get_user_images/{user_id}', [ImagesController::class, 'user']);
Route::delete('/images/{id}', [ImagesController::class, 'destroy']);
Route::post('/firebaseurl', [ImagesController::class, 'store']);




// Protected routes with Sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth routes    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update', [AuthController::class, 'update']);

    // Product routes
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    //House routes
    // Route::post('/set_profile', [HouseController::class, 'store']);
    
    //Images routes
    


     
});










Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
