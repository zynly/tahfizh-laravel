<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UstadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MurojaahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryMurojaahController;

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
    return redirect()->route('login');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->middleware('role:owner');
        
        Route::resource('siswas', SiswaController::class)->middleware('role:owner|ustad');
        Route::get('/admin/siswas/search', [SiswaController::class, 'search'])->middleware('role:owner')->name('siswas.search');

        Route::resource('ustads', UstadController::class)->middleware('role:owner');
        Route::get('/admin/ustads/search', [UstadController::class, 'search'])->middleware('role:owner')->name('ustads.search');
        Route::resource('murojaahs', MurojaahController::class)->middleware('role:owner|ustad');

        Route::resource('historymurojaah', HistoryMurojaahController::class)->middleware('role:owner|ustad|siswa');
        Route::post('/historymurojaah/request/{murojaah}',[HistoryMurojaahController::class,'store'])
        ->middleware('role:owner|ustad')->name('historymurojaah.store');
        //{murojaah} cukup gini aja kalau yg mau di panggil id tp kalau selain id harus dibuat seperti ini {murojaah:email}
        Route::get('/admin/historymurojaah/search', [HistoryMurojaahController::class, 'search'])
        ->middleware('role:owner|ustad')->name('historymurojaah.search');
        Route::get('/admin/historymurojaah/cari', [HistoryMurojaahController::class, 'cari'])
        ->middleware('role:owner|ustad')->name('historymurojaah.cari');
        

    });
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
