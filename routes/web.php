<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AboutAwardController;
use App\Http\Controllers\AboutEventController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AboutClientController;
use App\Http\Controllers\AboutPeopleController;
use App\Http\Controllers\Store3dBoothController;
use App\Http\Controllers\StoreFloristController;
use App\Http\Controllers\ContactCourseController;
use App\Http\Controllers\ContactInvestController;
use App\Http\Controllers\ContactPartnerController;
use App\Http\Controllers\ContactServiceController;
use App\Http\Controllers\StoreFurnitureController;
use App\Http\Controllers\ContactDonationController;
use App\Http\Controllers\StoreDecorationController;
use App\Http\Controllers\ContactFreelanceController;
use App\Http\Controllers\Store3dFurnitureController;
use App\Http\Controllers\ServiceBoothDesignController;
use App\Http\Controllers\ServiceArchitectureController;
use App\Http\Controllers\Store3dArchitectureController;
use App\Http\Controllers\ServiceVirtualOfficeController;
use App\Http\Controllers\ServiceInteriorDesignController;
use App\Http\Controllers\ServiceInteriorPublicController;
use App\Http\Controllers\ServiceWeddingDecorationController;
use App\Http\Controllers\NewsController;

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
    return 'Welcome to the home';
});

Route::get('/admin', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('homes', HomeController::class);

        // Route::resource('all-news', NewsController::class);

        Route::get('all-news', [NewsController::class, 'index'])->name(
            'all-news.index'
        );
        Route::post('all-news', [NewsController::class, 'store'])->name(
            'all-news.store'
        );
        Route::get('all-news/create', [NewsController::class, 'create'])->name(
            'all-news.create'
        );
        Route::get('all-news/{news}', [NewsController::class, 'show'])->name(
            'all-news.show'
        );
        Route::get('all-news/{news}/edit', [
            NewsController::class,
            'edit',
        ])->name('all-news.edit');
        Route::put('all-news/{news}', [NewsController::class, 'update'])->name(
            'all-news.update'
        );
        Route::delete('all-news/{news}', [
            NewsController::class,
            'destroy',
        ])->name('all-news.destroy');


        Route::resource('about-awards', AboutAwardController::class);
        Route::resource('about-clients', AboutClientController::class);
        Route::resource('about-events', AboutEventController::class);

        // Route::resource('all-about-people', AboutPeopleController::class);


        Route::get('all-about-people', [
            AboutPeopleController::class,
            'index',
        ])->name('all-about-people.index');
        Route::post('all-about-people', [
            AboutPeopleController::class,
            'store',
        ])->name('all-about-people.store');
        Route::get('all-about-people/create', [
            AboutPeopleController::class,
            'create',
        ])->name('all-about-people.create');
        Route::get('all-about-people/{aboutPeople}', [
            AboutPeopleController::class,
            'show',
        ])->name('all-about-people.show');
        Route::get('all-about-people/{aboutPeople}/edit', [
            AboutPeopleController::class,
            'edit',
        ])->name('all-about-people.edit');
        Route::put('all-about-people/{aboutPeople}', [
            AboutPeopleController::class,
            'update',
        ])->name('all-about-people.update');
        Route::delete('all-about-people/{aboutPeople}', [
            AboutPeopleController::class,
            'destroy',
        ])->name('all-about-people.destroy');

        Route::resource('contact-courses', ContactCourseController::class);
        Route::resource('contact-donations', ContactDonationController::class);
        Route::resource(
            'contact-freelances',
            ContactFreelanceController::class
        );
        Route::resource('contact-invests', ContactInvestController::class);
        Route::resource('contact-partners', ContactPartnerController::class);
        Route::resource('contact-services', ContactServiceController::class);
        Route::resource(
            'service-architectures',
            ServiceArchitectureController::class
        );
        Route::resource(
            'service-booth-designs',
            ServiceBoothDesignController::class
        );
        Route::resource(
            'service-interior-designs',
            ServiceInteriorDesignController::class
        );
        Route::resource(
            'service-interior-publics',
            ServiceInteriorPublicController::class
        );
        Route::resource(
            'service-virtual-offices',
            ServiceVirtualOfficeController::class
        );
        Route::resource(
            'service-wedding-decorations',
            ServiceWeddingDecorationController::class
        );
        Route::resource(
            'store3d-architectures',
            Store3dArchitectureController::class
        );
        Route::resource('store3d-booths', Store3dBoothController::class);
        Route::resource(
            'store3d-furnitures',
            Store3dFurnitureController::class
        );
        Route::resource('store-decorations', StoreDecorationController::class);
        Route::resource('store-florists', StoreFloristController::class);
        Route::resource('store-furnitures', StoreFurnitureController::class);
    });
