<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Dash2Controller;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;

Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');



Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/proyectos', [LandingPageController::class, 'proyectos'])->name('landing.proyectos');
Route::get('/blogs', [LandingPageController::class, 'blogs'])->name('landing.blogs');
Route::get('/galeria', [LandingPageController::class, 'galeria'])->name('landing.galeria');
Route::get('/acerca', [LandingPageController::class, 'acerca'])->name('landing.acerca');
Route::get('/quienes-somos', [LandingPageController::class, 'quienesSomos'])->name('landing.quienes.somos');
Route::get('/premios', [LandingPageController::class, 'premios'])->name('landing.premios');
Route::get('/donaciones', [LandingPageController::class, 'donaciones'])->name('landing.donaciones');

Route::get('/dash2', [Dash2Controller::class, 'index'])->name('dash2')->middleware('auth');


Route::get('/posts/{category}', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);

Route::get('/admin/publicaciones', [PublicacionesController::class, 'index'])->name('admin.publicaciones');
Route::get('/admin/publicaciones/{id}', [PublicacionesController::class, 'show'])->name('admin.publicaciones.show');
Route::get('/admin/publicaciones/crear', [PublicacionesController::class, 'crear'])->name('admin.publicaciones.crear');
Route::post('/admin/publicaciones', [PublicacionesController::class, 'store'])->name('admin.publicaciones.store');
Route::get('/admin/publicaciones/{id}/edit', [PublicacionesController::class, 'editar'])->name('admin.publicaciones.edit');
Route::put('/admin/publicaciones/{id}', [PublicacionesController::class, 'update'])->name('admin.publicaciones.update');
Route::delete('/admin/publicaciones/{id}', [PublicacionesController::class, 'eliminar'])->name('admin.publicaciones.eliminar');

Route::prefix('posts')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('project', [ProjectController::class, 'index'])->name('posts.project');
        Route::get('project/{id}/edit', [ProjectController::class, 'edit'])->name('posts.project.edit');
        Route::put('project/{id}', [ProjectController::class, 'update'])->name('posts.project.update');
        Route::delete('project/{id}', [ProjectController::class, 'destroy'])->name('posts.project.delete');

        Route::get('blog', [BlogController::class, 'index'])->name('posts.blog');
        Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('posts.blog.edit');
        Route::put('blogs/{id}', [BlogController::class, 'update'])->name('posts.blog.update');
        Route::delete('blogs/{id}', [BlogController::class, 'destroy'])->name('posts.blog.delete');
    });
    Route::get('project/{id}', [ProjectController::class, 'show'])->name('posts.project.show');
}); Route::get('blogs/{id}', [BlogController::class, 'show'])->name('posts.blog.show');




Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::middleware(['auth', 'redirect.by.role'])->group(function () {
    Route::get('/dash2', [Dash2Controller::class, 'index'])->name('dash2');
});

Route::get('/page', function () {
    return view('page.page');
});
