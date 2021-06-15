<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () 
{  
    return redirect()->route("reservas");
})->name('dashboard');

Route::get('/', HomeController::class);

Route::get('reservas', [ReservasController::class, "index"])->name('reservas')->middleware('auth');

Route::get('reservas/{day}/{month}', [ReservasController::class, "todas"])->name('reservas.todas')->middleware('auth');

Route::get('reservar/{day}/{month}', [ReservasController::class, "new"])->name('reservar')->middleware('auth');

Route::post("reservar" , [ReservasController::class, "store"])->name('reservar.store');

Route::get('reservas/{id}',  [ReservasController::class, "show"])->name('reservas.show')->middleware('auth');

Route::get("reservas/{id}/{day}/{month}/edit",  [ReservasController::class, "edit"])->name('reservas.edit')->middleware('auth');

Route::put("reservas/{reserva}" , [ReservasController::class, "update"])->name('reservas.update');

Route::delete("reservas/{reserva}", [ReservasController::class, "destroy"])->name('reservas.destroy')->middleware('auth');
{

}