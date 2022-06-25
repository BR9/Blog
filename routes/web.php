<?php

use App\Http\Controllers\Blog\Home;

use App\Http\Controllers\Syspanel\Base;
use App\Http\Controllers\Syspanel\User_management;
use App\Http\Controllers\Syspanel\System_settings;
use App\Http\Controllers\Syspanel\Category_management;
use App\Http\Controllers\Syspanel\Blog_management;

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

/** SYSPanel (Admin ve Yazar) */

/** RoleControl: 1 = Admin */
/** RoleControl: 2 = Yazar */


Route::middleware(['HtmlMinifier', 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->prefix('syspanel')->group(function () {

    Route::get('', [Base::class, 'index'])->name('home');

    /** Kullanıcı Yönetimi */

    Route::middleware(['RoleControl:1'])->get('/user-management', [User_management::class, 'index'])->name('user-management');
    Route::middleware(['RoleControl:1'])->get('/user-management/create', [User_management::class, 'create'])->name('user-management-create');
    Route::middleware(['RoleControl:1'])->post('/user-management/create-p', [User_management::class, 'create_p'])->name('user-management-create-p');
    Route::middleware(['RoleControl:1'])->get('/user-management/edit/{id}', [User_management::class, 'edit'])->name('user-management-edit');
    Route::middleware(['RoleControl:1'])->post('/user-management/edit-p/{id}', [User_management::class, 'edit_p'])->name('user-management-edit-p');
    Route::middleware(['RoleControl:1'])->post('/user-management/delete-p', [User_management::class, 'delete_p'])->name('user-management-delete-p');

    /** Sistem Ayarları */

    Route::middleware(['RoleControl:1'])->get('/system-settings', [System_settings::class, 'index'])->name('system-settings');
    Route::middleware(['RoleControl:1'])->post('/system-settings-edit-p', [System_settings::class, 'edit'])->name('system-settings-edit-p');

    /** Kategori Yönetimi */

    Route::middleware(['RoleControl:1'])->get('/category-management', [Category_management::class, 'index'])->name('category-management');
    Route::middleware(['RoleControl:1'])->get('/category-management/create', [Category_management::class, 'create'])->name('category-management-create');
    Route::middleware(['RoleControl:1'])->post('/category-management/create-p', [Category_management::class, 'create_p'])->name('category-management-create-p');
    Route::middleware(['RoleControl:1'])->get('/category-management/edit/{id}', [Category_management::class, 'edit'])->name('category-management-edit');
    Route::middleware(['RoleControl:1'])->post('/category-management/edit-p/{id}', [Category_management::class, 'edit_p'])->name('category-management-edit-p');
    Route::middleware(['RoleControl:1'])->post('/category-management/delete-p', [Category_management::class, 'delete_p'])->name('category-management-delete-p');

    /** Blog Yönetimi */

    Route::middleware(['RoleControl:1|2'])->get('/blog-management', [Blog_management::class, 'index'])->name('blog-management');
    Route::middleware(['RoleControl:1|2'])->get('/blog-management/create', [Blog_management::class, 'create'])->name('blog-management-create');
    Route::middleware(['RoleControl:1|2'])->post('/blog-management/create-p', [Blog_management::class, 'create_p'])->name('blog-management-create-p');
    Route::middleware(['RoleControl:1|2'])->get('/blog-management/edit/{id}', [Blog_management::class, 'edit'])->name('blog-management-edit');
    Route::middleware(['RoleControl:1|2'])->post('/blog-management/edit-p/{id}', [Blog_management::class, 'edit_p'])->name('blog-management-edit-p');
    Route::middleware(['RoleControl:1|2'])->post('/blog-management/delete-p', [Blog_management::class, 'delete_p'])->name('blog-management-delete-p');

});

/** Tema ve Kullanıcı Arayüzü */

Route::get('/{cat?}', [Home::class, 'index'])->name('blog-home');
Route::get('/blog/{id}', [Home::class, 'blog_detail'])->name('blog-detail');
Route::post('/visitorControl/', [Home::class, 'visitor_control'])->name('visitorControl');
