<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\Api\{
    
    RegisterController,
    LoginController,
    Family_accountController,
    

};
use App\Http\Controllers\LoginTokenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
     return view('app');
 });
 */

/*  Route::get('{any?}', fn () => view('app')) -> where('any', '*'); */

Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api).*$');


//Route::get('/', [HomeController::class, 'welcome'])->name('home');


Route::post('/api/login', [LoginController::class, 'login_api'])->name('login_api')->middleware('guest');
Route::delete('/api/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('/api/comments', [Family_accountController::class, 'indexComment']);
// Route::post('/login_token', [LoginTokenController::class, 'store']);

//Payment
Route::get('/api/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::post('/api/session', 'App\Http\Controllers\StripeController@session')->name('session');
Route::get('/api/cancel', 'App\Http\Controllers\StripeController@cancel')->name('cancel');
Route::get('/api/success', 'App\Http\Controllers\StripeController@success')->name('success');



// Route::middleware([EnsureFrontendRequestsAreStateful::class])->group(function () {

//     Route::post('/login', [LoginController::class, 'login_api'])->name('login_api');
// });


// Route::middleware([EnsureFrontendRequestsAreStateful::class])->group(function () {
//     // Ваши маршруты API здесь
//     Route::post('/login', [LoginController::class, 'login_api'])->name('login_api');
//     // Route::post('/login', [AuthController::class, 'login']);
//     // Route::post('/logout', [AuthController::class, 'logout']);
//     // Добавьте другие маршруты, которые требуют аутентификации
// });