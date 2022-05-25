<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('/', function () {
    return redirect('/home');
});
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/createCustomerByAjax', [App\Http\Controllers\UserController::class, 'createCustomerByAjax']);
Route::post('/updateCustomerByAjax', [App\Http\Controllers\UserController::class, 'updateCustomerByAjax']);
Route::post('/deleteCustomerByAjax', [App\Http\Controllers\UserController::class, 'deleteCustomerByAjax']);
Route::post('/updateCustomerStatusByAjax', [App\Http\Controllers\UserController::class, 'updateCustomerStatusByAjax']);

Route::post('/createCategoryByAjax', [App\Http\Controllers\CategoryController::class, 'createCategoryByAjax']);
Route::post('/updateCategoryByAjax', [App\Http\Controllers\CategoryController::class, 'updateCategoryByAjax']);
Route::post('/deleteCategoryByAjax', [App\Http\Controllers\CategoryController::class, 'deleteCategoryByAjax']);

Route::post('/createTypeByAjax', [App\Http\Controllers\TypeController::class, 'createTypeByAjax']);
Route::post('/updateTypeByAjax', [App\Http\Controllers\TypeController::class, 'updateTypeByAjax']);
Route::post('/deleteTypeByAjax', [App\Http\Controllers\TypeController::class, 'deleteTypeByAjax']);

Route::post('/createTagByAjax', [App\Http\Controllers\TagController::class, 'createTagByAjax']);
Route::post('/updateTagByAjax', [App\Http\Controllers\TagController::class, 'updateTagByAjax']);
Route::post('/deleteTagByAjax', [App\Http\Controllers\TagController::class, 'deleteTagByAjax']);

Route::post('/createRecipeByAjax', [App\Http\Controllers\RecipeController::class, 'createRecipeByAjax']);
Route::post('/updateRecipeByAjax', [App\Http\Controllers\RecipeController::class, 'updateRecipeByAjax']);
Route::post('/deleteRecipeByAjax', [App\Http\Controllers\RecipeController::class, 'deleteRecipeByAjax']);

Route::get('storage/app/public/images/{filename}', function ($filename)
{
    $path = storage_path('app/public/images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::resource('category', 'App\Http\Controllers\CategoryController', ['except' => ['show']]);
	Route::resource('type', 'App\Http\Controllers\TypeController', ['except' => ['show']]);
	Route::resource('tag', 'App\Http\Controllers\TagController', ['except' => ['show']]);
	Route::resource('recipe', 'App\Http\Controllers\RecipeController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});