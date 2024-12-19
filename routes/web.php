<?php

use App\Http\Controllers\WaitingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoundController;
use App\Filament\Pages\RoundSelectionPage;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LeaderboardController;
use Filament\Facades\Filament;


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
    return view('user.welcome');
});

// Route::get('/login', function () {
//     return view('user.login');
// })->name('user.login');
// Route::get('/level', function () {
//     return view('user.level');
// });


// Route::get('/view_kelas', [AdminController::class,'view_kelas']);
Route::get('/signup', [SchoolsController::class, 'index'])->name('user.register');
// Route::middleware(['restrict.admin.login'])->group(function () {
//     Route::get('/admin');
//     Route::get('/admin/login');
// });
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/popup/{roundId}', [RoundController::class, 'popup'])->name('user.popup');
    Route::post('/round/{roundId}/submit', [QuestionController::class, 'submit'])->name('user.submit');
    Route::post('/save-temporary-answer/{roundId}', [QuestionController::class, 'saveTemporaryAnswer'])
        ->name('user.save.temporary.answer');
    Route::get('/round/{roundId}/question/{questionIndex}', [QuestionController::class, 'showQuestion'])
        ->name('user.question');
    Route::get('/leaderboard/{roundId}', [LeaderboardController::class, 'index'])
        // ->middleware('check.waitingroom')
        ->name('leaderboard');
    Route::get('/waiting-room/{roundId}', [WaitingController::class, 'index'])->name('user.waiting');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.session.ip'
])->group(function () {
    Route::get('/dashboard', [RoundController::class, 'index'])->name('user.level');
});

// Route::prefix(config('filament.path'))->group(function () {
//     // Cek jika halaman login sudah dikonfigurasi pada Filament
//     Route::middleware(['restrict.admin.login'])->group(function () {
//         if ($loginPage = config('filament.auth.pages.login')) {
//             Route::get('admin', $loginPage)->name('auth.login');
//         }
//     });

//     // Menggunakan middleware yang telah dikonfigurasi untuk autentikasi
//     Route::middleware(config('filament.middleware.auth'))->group(function (): void {
//         // Menambahkan route untuk halaman-halaman Filament
//         Route::name('pages.')->group(function (): void {
//             foreach (Filament::getPages() as $page) {
//                 Route::group([], $page::getRoutes());
//             }
//         });

//         // Menambahkan route untuk resources di Filament
//         Route::name('resources.')->group(function (): void {
//             foreach (Filament::getResources() as $resource) {
//                 Route::group([], $resource::getRoutes());
//             }
//         });
//     });
// });