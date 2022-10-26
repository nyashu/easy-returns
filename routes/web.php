<?php

use App\Http\Controllers\Admin\ReturnController as AdminReturnController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\Return\ReturnController;
use App\Http\Controllers\Store\AuthController;
use App\Http\Controllers\Store\DashboardController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\User\UserController;
use App\Models\EasyReturn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
	$users = User::withCount(['returns'])->orderBy('returns_count', 'DESC')
		->take(3)->get();

	$total_returns = EasyReturn::count();

	return view('welcome', compact('users', 'total_returns'));
});

Auth::routes();

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/store/register', [AuthController::class, 'registerForm'])->name('register-store');
Route::post('/store/register', [AuthController::class, 'register']);

Route::get('/store/login', [AuthController::class, 'loginForm'])->name('login-store');
Route::post('/store/login', [AuthController::class, 'login']);

Route::get('/home/stores', [StoreController::class, 'homepageStore'])->name('homepage-stores');

Route::get('/{user}/predict', [PredictionController::class, 'predict'])->name('predict');

Route::group(['middleware' => 'auth'], function () {

	Route::middleware('role:' . User::USER)->group(function () {
		Route::patch('/users/password', [UserController::class, 'updatePassword'])->name('update-password');
		Route::resource('/users', UserController::class, ['as' => 'frontend']);
		Route::resource('/easy-return', ReturnController::class);
	});

	Route::get('/share-link', [StoreController::class, 'shareLink'])->name('share-link');

	Route::middleware('role:' . User::STORE . ',' . User::ADMIN)->group(function () {
		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

		Route::post('/stores/{id}/status', [StoreController::class, 'changeStatus'])->name('store-verify');
		Route::resource('/stores', StoreController::class);

		Route::get('store/all-return', [DashboardController::class, 'storeRequests'])->name('store-returns');
		Route::delete('store/return-request/{id}', [DashboardController::class, 'destroyRequest']);
		Route::get('/store/return-request/{id}', [DashboardController::class, 'requestEdit'])->name('store-request-edit');
		Route::put('/store/return-request/{id}', [DashboardController::class, 'requestUpdate']);

		Route::resource('backend/users', AdminUserController::class);
		Route::get('/return-request', [AdminReturnController::class, 'returnRequests'])->name('all-return');
		Route::delete('/admin/return-request/{id}', [AdminReturnController::class, 'destroyRequest']);

		Route::get('/store-user', [StoreController::class, 'storeUser'])->name('store-user');

	});

	Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');

	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/clear-cache', function () {
	$output = [];
	\Illuminate\Support\Facades\Artisan::call('cache:clear', $output);
	dd($output);
});
