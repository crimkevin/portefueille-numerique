<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeuserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\sitePageController;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;


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
Route::get('test', function () {
    //$pay = Payment::all()->load(['staff']);
   return Hash::make('kevin1234');
});

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/register',[AuthentificationController::class, 'Viewregister'])->name('register');
Route::get('/login',[AuthentificationController::class, 'Viewlogin'])->name('login');

Route::post('/register',[AuthentificationController::class, 'register'])->name('register.store');
Route::post('/login',[AuthentificationController::class, 'login'])->name('login.store');

Route::post('/@fogotyourpassword',[AuthentificationController::class, 'updatePassword']);
Route::post('/@changeyouremail',[AuthentificationController::class, 'changeEmail']);

// ici nous allons mettre les routes auth simpleuser et entreprise
Route::middleware('auth:api')->group(function(){





});

Route::post('/logout',[AuthentificationController::class, 'logout']);

Route::get('/{id}/weekTranactions',[UserController::class,'weekTransaction'])->name('user.weekTransaction');
Route::get('/{id}/mounthTransaction',[UserController::class,'mounthTransaction'])->name('user.mounthTransaction');

Route::post('/transactions/credit', [TransactionController::class, 'deposite'])->name('deposite.store');
Route::post('/transaction/debiter', [TransactionController::class, 'withdraw'])->name('withdraw.store');
Route::post('/transactions/transfer', [TransactionController::class, 'transfer']);

Route::get('/operation',[sitePageController::class, 'operation'])->name('operation');

Route::get('/deposite',[TransactionController::class, 'showdeposite'])->name('deposite');
Route::get('/withdraw',[TransactionController::class, 'showwithdraw'])->name('withdraw');
Route::get('/transfer',[TransactionController::class, 'showtransfer'])->name('transfer');
Route::resources([
    // 'loggin' => LoggingController::class,
    'notification'=> NotificationController::class,
    'operateur'=> OperatorController::class,
    'transaction'=> TransactionController::class,
    'typeuser'=> TypeuserController::class,
    'user'=> UserController::class
]);
