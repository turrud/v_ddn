<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\AboutAwardController;
use App\Http\Controllers\Api\AboutEventController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\AboutClientController;
use App\Http\Controllers\Api\AboutPeopleController;
use App\Http\Controllers\Api\Store3dBoothController;
use App\Http\Controllers\Api\StoreFloristController;
use App\Http\Controllers\Api\ContactCourseController;
use App\Http\Controllers\Api\ContactInvestController;
use App\Http\Controllers\Api\ContactPartnerController;
use App\Http\Controllers\Api\ContactServiceController;
use App\Http\Controllers\Api\StoreFurnitureController;
use App\Http\Controllers\Api\ContactDonationController;
use App\Http\Controllers\Api\StoreDecorationController;
use App\Http\Controllers\Api\ContactFreelanceController;
use App\Http\Controllers\Api\Store3dFurnitureController;
use App\Http\Controllers\Api\ServiceBoothDesignController;
use App\Http\Controllers\Api\ServiceArchitectureController;
use App\Http\Controllers\Api\Store3dArchitectureController;
use App\Http\Controllers\Api\ServiceVirtualOfficeController;
use App\Http\Controllers\Api\ServiceInteriorDesignController;
use App\Http\Controllers\Api\ServiceInteriorPublicController;
use App\Http\Controllers\Api\ServiceWeddingDecorationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('homes', HomeController::class);
        
        Route::apiResource('all-news', NewsController::class);

        Route::apiResource('about-awards', AboutAwardController::class);

        Route::apiResource('about-clients', AboutClientController::class);

        Route::apiResource('about-events', AboutEventController::class);

        Route::apiResource('all-about-people', AboutPeopleController::class);

        Route::apiResource('contact-courses', ContactCourseController::class);

        Route::apiResource(
            'contact-donations',
            ContactDonationController::class
        );

        Route::apiResource(
            'contact-freelances',
            ContactFreelanceController::class
        );

        Route::apiResource('contact-invests', ContactInvestController::class);

        Route::apiResource('contact-partners', ContactPartnerController::class);

        Route::apiResource('contact-services', ContactServiceController::class);

        Route::apiResource(
            'service-architectures',
            ServiceArchitectureController::class
        );

        Route::apiResource(
            'service-booth-designs',
            ServiceBoothDesignController::class
        );

        Route::apiResource(
            'service-interior-designs',
            ServiceInteriorDesignController::class
        );

        Route::apiResource(
            'service-interior-publics',
            ServiceInteriorPublicController::class
        );

        Route::apiResource(
            'service-virtual-offices',
            ServiceVirtualOfficeController::class
        );

        Route::apiResource(
            'service-wedding-decorations',
            ServiceWeddingDecorationController::class
        );

        Route::apiResource(
            'store3d-architectures',
            Store3dArchitectureController::class
        );

        Route::apiResource('store3d-booths', Store3dBoothController::class);

        Route::apiResource(
            'store3d-furnitures',
            Store3dFurnitureController::class
        );

        Route::apiResource(
            'store-decorations',
            StoreDecorationController::class
        );

        Route::apiResource('store-florists', StoreFloristController::class);

        Route::apiResource('store-furnitures', StoreFurnitureController::class);
    });