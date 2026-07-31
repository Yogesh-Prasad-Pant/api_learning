<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategoryRequestController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PayoutRequestController;

use App\Http\Controllers\Customer\CustomerAddressController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\CheckoutController;

use App\Http\Controllers\Payment\EsewaPaymentController;

    Route::prefix('customer')->group(function () {

        Route::post('/register', [CustomerAuthController::class, 'register']);
        Route::middleware('throttle:5,1')->group(function () {
            Route::post('/login', [CustomerAuthController::class, 'login']);
            Route::post('/forgot-password', [CustomerAuthController::class, 'forgotPassword']);
        });
        Route::post('/reset-password', [CustomerAuthController::class, 'resetPassword']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [CustomerAuthController::class, 'logout']);
            Route::get('/profile', [CustomerController::class, 'profile']);
            Route::post('/profile', [CustomerController::class, 'updateProfile']);
            Route::post('/deactivate', [CustomerController::class, 'deactivateAccount']);
           
            Route::prefix('addresses')->group(function () {
                Route::get('/', [CustomerAddressController::class, 'index']);
                Route::post('/', [CustomerAddressController::class, 'store']);
                Route::put('/{customerAddress}', [CustomerAddressController::class, 'update']);
                Route::patch('/default/{customerAddress}', [CustomerAddressController::class, 'setDefault']);
                Route::delete('/{customerAddress}', [CustomerAddressController::class, 'destroy']);
                Route::get('/show/{customerAddress}', [CustomerAddressController::class, 'show']);

            });
            
            Route::prefix('orders')->group(function () {
                Route::get('/', [CustomerOrderController::class, 'index']);
                Route::post('/', [CustomerOrderController::class, 'store']);
                Route::get('/{id}',[CustomerOrderController::class, 'show']);
                Route::post('/{id}/cancel', [CustomerOrderController::class, 'requestCancel']);
                Route::post('/{id}/confirm-received', [CustomerOrderController::class, 'confirmReceived']);
            });
        });
        Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'index']);         // Get cart items (grouped by shop)
            Route::post('/', [CartController::class, 'store']);        // Add item to cart (with stock validation)
            Route::put('/{id}', [CartController::class, 'update']);    // Update item quantity by cart_item_id
            Route::delete('/{id}', [CartController::class, 'destroy']); // Remove specific item
            Route::delete('/', [CartController::class, 'clear']);      // Clear entire cart
        });
    });

    Route::prefix('admin')->group(function (){

        // public route for register admin and login
            Route::middleware('throttle:5,1')->group(function ()
            {
                Route::post('/register-request',[AdminAuthController::class, 'registerRequest']);
                Route::post('/login', [AdminAuthController::class, 'login']);
            });
        // password forget/reset route
            Route::middleware('throttle:3,1')->group(function()
            {
                Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
                Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
            });
        // protected routes for viewing  searching and updating profile and  logout
            Route::middleware('auth:admin')->group(function ()
            {
                Route::post('/logout',[AdminAuthController::class, 'logout']);
                Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
                Route::put('/update',[AdminAuthController::class, 'updateProfile']);
                Route::post('/update-image',[AdminAuthController::class, 'updateImage']);
                Route::delete('/delete',[AdminManagementController::class, 'deleteAdmin']);
                Route::post('/upload-kyc', [AdminAuthController::class, 'uploadKyc']);
                
                Route::get('/shops', [ShopController::class, 'index']);
                Route::post('/shops', [ShopController::class, 'store']);
                Route::middleware(['assign_shop'])->group(function (){
                    Route::prefix('dashboard')->group(function(){
                        Route::get('/stats', [DashboardController::class, 'getStats']);
                        Route::get('/chart', [DashboardController::class, 'getChartData']);
                        Route::get('/orders', [DashboardController::class, 'getRecentOrders']);
                        Route::get('/toggle-status',[DashboardController::class, 'toggleShopStatus']);
                    });
                    Route::prefix('shop')->group(function () {   
                        Route::get('/all', [ShopController::class, 'index']);
                        Route::get('/profile', [ShopController::class, 'show']);         
                        Route::put('/profile', [ShopController::class, 'update']);        
                        Route::post('/profile/branding', [ShopController::class, 'updateBranding']);  
                        Route::delete('/profile', [ShopController::class, 'destroy']);
                        Route::delete('/profile/force',[ShopController::class, 'forceDelete']);

                        Route::get('/payout-requests', [PayoutRequestController::class, 'index']);
                        Route::post('/payout-requests', [PayoutRequestController::class, 'store']);

                        Route::prefix('category-requests')->group(function (){
                            Route::get('/my-requests', [CategoryRequestController::class, 'myShopRequest'])->name('shop.category-requests.my-requests');
                            Route::post('/',[CategoryRequestController::class, 'store'])->name('shop.category-requests.store');
                            Route::put('/{id}', [CategoryRequestController::class, 'update'])->name('shop.category-requests.update');
                            Route::delete('/{id}', [CategoryRequestController::class, 'destroy'])->name('shop.category-requests.destroy');
                        });
                        Route::prefix('orders')->group(function () {
                            Route::get('/', [AdminOrderController::class, 'index']);
                            Route::get('/{id}', [AdminOrderController::class, 'show']);
                            Route::patch('/{id}/status', [AdminOrderController::class, 'updateStatus']);

                            Route::post('/{id}/approve-cancellation', [AdminOrderController::class, 'approveCancellation']);
                            Route::post('/{id}/reject-cancellation', [AdminOrderController::class, 'rejectCancellation']);
                        });
                    });
                    Route::prefix('products')->group(function(){
                        Route::post('/store',[ProductController::class, 'store']);
                        Route::get('/all',[ProductController::class, 'index']);
                        Route::get('/single/{product_id}', [ProductController::class, 'getProduct']);

                        Route::put('/local/{id}', [ProductController::class, 'updateShopProduct']);
                        Route::post('/local/image/{product_id}', [ProductController::class, 'updateProductImage']);
                        Route::delete('/local/{product_id}', [ProductController::class, 'deleteShopProduct']);
                        Route::delete('/local/force-delete/{product_id}',[ProductController::class, 'forceDeleteShopProduct']);

                        Route::put('/global/{product_id}', [ProductController::class, 'updateGlobalProduct']);
                        Route::post('/global/image/{product_id}', [ProductController::class, 'updateCatalogImage']);
                        Route::delete('/global/{product_id}', [ProductController::class, 'deleteGlobalProduct']);
                        Route::delete('/global/force-delete/{product_id}',[ProductController::class, 'forceDeleteGlobalProduct']);
                    });
                });
                Route::prefix('dashboard')->group(function(){
                    Route::get('/index', [DashboardController::class, 'index']);
                });
            });
        // Routes that only super_admin can access
            Route::middleware(['auth:admin','super_admin'])->group(function()
            {
                Route::get('/super/dashboard', [DashboardController::class, 'superIndex']);
                Route::get('/list',[AdminManagementController::class, 'index'])->name('admin.index');
                Route::get('/kyc/view/{id}/{type}', [AdminManagementController::class, 'viewDocument'])->name('admin.kyc.view');
                Route::post('/kyc/change-status/{id}', [AdminManagementController::class, 'changeKycStatus'])->name('admin.kyc.status');
                Route::post('/change-status/{id}',[AdminManagementController::class, 'changeStatus']);
                Route::delete('/delete/{id}',[AdminManagementController::class, 'deleteAdmin'])->name('admin.delete');
                Route::delete('/force-delete/{id}',[AdminManagementController::class, 'forceDeleteAdmin']);
                Route::post('/restore/{id}',[AdminManagementController::class, 'restoreAdmin']);

                Route::patch('/payout-requests/{id}/status', [PayoutRequestController::class, 'updateStatus']);

                Route::prefix('category-requests')->group(function (){
                    Route::get('/',[CategoryRequestController::class, 'index'])->name('admin.category-requests.index');
                    Route::post('/approve/{id}', [CategoryRequestController::class, 'approve'])->name('admin.category-requests.approve');
                    Route::post('/reject/{id}', [CategoryRequestController::class, 'reject'])->name('admin.category-requests.reject');
                });
                Route::prefix('categories')->group(function (){
                    Route::get('/', [CategoryController::class, 'index']);
                    Route::post('/', [CategoryController::class, 'store']);
                    Route::get('/{category}', [CategoryController::class, 'show']);
                    Route::post('/{category}', [CategoryController::class, 'update']); //for image
                    Route::delete('/{category}', [CategoryController::class, 'destroy']);
                });
            });

    });
    Route::prefix('payments/esewa')->group(function () {
        Route::post('/initiate', [EsewaPaymentController::class, 'initiate']);
        Route::get('/success', [EsewaPaymentController::class, 'success']);
        Route::get('/failure', [EsewaPaymentController::class, 'failure']);
    });
    Route::get('/categories', [CategoryController::class, 'getCategories']);

    


// Route::get('/user', function (Request $request) {
//         return $request->user();
//     })->middleware('auth:sanctum');



