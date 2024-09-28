<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\categoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;

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

// Rute dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);

// Rute untuk artikel
Route::resource('article', ArticleController::class);
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
// Atau jika ingin menambahkan route delete secara eksplisit
Route::delete('article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
// Rute untuk kategori
Route::resource('/categories', categoryController::class)->only([
    'index', 'create', 'store', 'update', 'destroy'
]);
});

// Rute untuk halaman depan dan artikel

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/frontend/{slug}', [FrontendController::class, 'show'])->name('frontend.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::resource('users', UserController::class);


// Rute untuk menampilkan halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Rute untuk menangani form login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




// Tampilan Form Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->only([
        'index', 'create', 'store', 'update', 'destroy'
    ]);
});
// Rute dengan middleware 'auth'
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rute untuk pengguna (admin)
    Route::resource('users', UserController::class)->only([
        'index', 'create', 'store', 'update', 'destroy'
    ]);
});

// Kamu bisa menghapus middleware `role:User` atau sesuaikan dengan rute lain jika ada fungsionalitas khusus
Route::middleware(['auth', 'role:User'])->group(function () {
    // Misalnya untuk halaman profil pengguna
    Route::get('/profile', [ProfileController::class, 'show']);
});

// Jika ada kebutuhan untuk user dengan role biasa
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
