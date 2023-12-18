<?php

use App\Models\CashAdvance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CashAdvanceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);

Route::middleware(['auth', 'verified'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    Route::get('/positions',[PositionController::class, 'index']);
    Route::get('/positions/create', [PositionController::class, 'create']);
    Route::post('/positions', [PositionController::class, 'store'])->name('position.store');
    Route::get('/positions/edit/{position}', [PositionController::class, 'edit'])->name('positions.edit');
    Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.store');

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/cash-advance', [CashAdvanceController::class, 'index']);
    Route::get('/cash-advance/create', [CashAdvanceController::class, 'create'])->name('cashAdvance.create');
    Route::post('/cash-advance', [CashAdvanceController::class, 'store'])->name('CashAdvance.store');
    Route::get('/cash-advance/edit/{cashAdvance}', [CashAdvanceController::class, 'edit'])->name('CashAdvance.edit');
    Route::put('/cash-advance/{cashAdvance}', [CashAdvanceController::class, 'update'])->name('CashAdvance.update');
    Route::delete('/cash-advance/{cashAdvance}', [CashAdvanceController::class, 'destroy'])->name('CashAdvance.destroy');

    Route::get('/payroll', [PayrollController::class, 'index']);
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/edit/{payroll}', [PayrollController::class, 'edit'])->name('payroll.edit');
    Route::put('/payroll/{payroll}', [PayrollController::class, 'update'])->name('payroll.update');
    Route::delete('/payroll/{payroll}', [PayrollController::class, 'destroy'])->name('payroll.destroy');



    Route::get('/logs', [UserLogController::class, 'index'])->name('logs.index');
    // Route::get('/sendmail', [EmailController::class ,'sendEmail']);
});
