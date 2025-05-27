<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\frontend\CustomerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


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


Route::get('/login', function () {
	return view('frontend.auth.login');
});

Route::get('/', function () {
	return view('frontend.auth.login');
	// /return redirect()->route('backend.home');
});
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::get('/otp-verify/{id}', 'App\Http\Controllers\frontend\CustomerController@otpVerify')->name('otpVerify');
Route::post('/verified', 'App\Http\Controllers\frontend\CustomerController@verifiedOtp')->name('verifiedOtp');
Route::get('/', 'App\Http\Controllers\frontend\CustomerController@loadLogin')->name('loadLogin');
Route::post('/login', 'App\Http\Controllers\frontend\CustomerController@userLogin')->name('userLogin');
Route::post('/dashboard', 'App\Http\Controllers\CustomerController@loadDashboard')->name('loadDashboard');


Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('customer/signup', [CustomerController::class, 'create'])->name('customer-create');
Route::POST('/customer/store', [App\Http\Controllers\frontend\CustomerController::class,'store'])->name('customer-store');



Route::get('complete-profile/{id}', [CustomerController::class, 'complete_profile_create'])->name('complete-profile-create');
Route::POST('/complete-profile/store/{id}', [App\Http\Controllers\frontend\CustomerController::class,'complete_profile_store'])->name('complete-profile-store');


Route::get('/access-denied', [App\Http\Controllers\frontend\CustomerController::class,'accessDenied'])->name('accessDenied');
Route::get('/contact-us', [App\Http\Controllers\frontend\CustomerController::class,'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\frontend\AboutUsController::class,'about_us'])->name('about_us');
Route::get('/about-us/update', [App\Http\Controllers\frontend\AboutUsController::class,'edit'])->name('edit');
Route::PATCH('/about-us/update/{id}', [App\Http\Controllers\frontend\AboutUsController::class, 'update'])->name('update');


Route::get('/about-us', [App\Http\Controllers\frontend\CustomerController::class,'about'])->name('about');
Route::get('/terms-condition', [App\Http\Controllers\frontend\CustomerController::class,'termCondition'])->name('termCondition');
Route::POST('/contact/store', [App\Http\Controllers\frontend\CustomerController::class,'contactStore'])->name('contactStore');

Auth::routes();
Route::group(['middleware' => ['auth', 'isAgent']], function () {
	Route::get('/home', [BackendController::class, 'index'])->name('agent.home');

		Route::get('customers', [App\Http\Controllers\backend\CustomerManagementController::class, 'index'])->name('customers');
		Route::get('agent/process-manage/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'agent_index'])->name('process.manage');
		//ProcessManagement

		Route::get('process-manage', [App\Http\Controllers\backend\ProcessManagementController::class, 'index'])->name('process.manage');
		//Route::get('process-manage/delete/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'destroy'])->name('draft-product-delete');
		Route::get('process-manage-view/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'view'])->name('admin.process-manage.view');
		Route::PATCH('/process-manage/update/{id}',[App\Http\Controllers\backend\ProcessManagementController::class, 'update'])->name('process-manage.update');
		Route::get('/process-manage/delete/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'destroy'])->name('delete');
		
		Route::get('agent/with-price/{id}',[App\Http\Controllers\backend\PDFController::class,'withPrice'])->name('withPrice');
		Route::get('agent/without-price/{id}',[App\Http\Controllers\backend\PDFController::class,'withoutPrice'])->name('withoutPrice');
		Route::get('agent/sticker/{id}',[App\Http\Controllers\backend\PDFController::class,'sticker'])->name('sticker');

});
Route::group(['middleware' => ['auth', 'isCustomer']], function () {

Route::get('/dashboard', [App\Http\Controllers\frontend\DashboardController::class,'index'])->name('dashboard');
Route::get('/create-shipping-information/{id}', [App\Http\Controllers\frontend\TrackingStatusController::class,'create_shipping_information']);
Route::Post('/store-shipping-information/{id}', [App\Http\Controllers\frontend\TrackingStatusController::class,'store_shipping_information']);
Route::get('/customer-draft', [App\Http\Controllers\frontend\DraftController::class,'customerDraft'])->name('customerDraft');
Route::POST('/customer-draft/store', [App\Http\Controllers\frontend\DraftController::class,'store'])->name('store');
Route::get('/door-style/{id}', [App\Http\Controllers\frontend\DraftController::class,'doorStyle'])->name('doorStyle');
Route::post('/add-draft', [App\Http\Controllers\frontend\DraftController::class,'CustomerDraftStyle'])->name('addDraft');
Route::get('/door-style/change/{draft_style_id}', [App\Http\Controllers\frontend\DraftController::class,'change_draft_style_get'])->name('change_draft_style_get');
Route::post('/add-draft/change/{id}/{draft_style_id}', [App\Http\Controllers\frontend\DraftController::class,'change_draft_style_post'])->name('change_draft_style_post');
Route::POST('/modification/store', [App\Http\Controllers\backend\ModificationController::class,'store'])->name('modificationmaster.store');
Route::get('/public/img/texExemptForm/{filename}', [App\Http\Controllers\backend\CustomerManagementController::class,'downloadFile'])->name('download.file');
Route::get('download', [App\Http\Controllers\backend\CustomerManagementController::class, 'download'])->name('download');

Route::Post('use-coupon/{id}', [App\Http\Controllers\frontend\DraftController::class, 'use_coupon'])->name('use_coupon');
Route::get('/remove-coupon/{id}', [App\Http\Controllers\frontend\DraftController::class,'remove_coupon'])->name('remove_coupon');


//PDF Generate
Route::get('/with-price/{customer_draft_Id}',[App\Http\Controllers\frontend\PDFController::class,'withPrice'])->name('withPrice');
Route::get('/without-price/{customer_draft_Id}',[App\Http\Controllers\frontend\PDFController::class,'withoutPrice'])->name('withoutPrice');

Route::get('/reset_password/edit/', '\App\Http\Controllers\frontend\ResetPasswordController@edit')->name('edit');
				//Route::get('/reset_password/changePassword/', 'App\Http\Controllers\ResetPasswordController@changePassword')->name('reset_password.update');
Route::PATCH('change-password/', '\App\Http\Controllers\frontend\ResetPasswordController@changePassword')->name('change-password');
//Customer Edit Profile Module

Route::get('/customer_edit_profile/edit/', '\App\Http\Controllers\frontend\CustomerEditProfileController@edit')->name('edit');
Route::get('/customer_edit_profile/view/', '\App\Http\Controllers\frontend\CustomerEditProfileController@view')->name('view');

Route::PATCH('/customer_edit_profile/update/{id}', '\App\Http\Controllers\frontend\CustomerEditProfileController@update')->name('customer_edit_profile.update');

//Route::get('/draft/autocomplete', '\App\Http\Controllers\backend\DraftController@autocomplete')->name('draft.autocomplete');
Route::POST('/draft-product/store/{customer_draft_id}',[App\Http\Controllers\frontend\DraftController::class,'draft_product_store'])->name('draft-product-store');
Route::get('/delete-draft-style/{draft_style_id}',[App\Http\Controllers\frontend\DraftController::class,'delete_draft_style'])->name('delete-draft-style');
Route::get('/new-draft/{customer_draft_Id}',[App\Http\Controllers\frontend\DraftController::class,'showProduct'])->name('new-draft');
Route::get('/get-draft-products',[App\Http\Controllers\frontend\DraftController::class,'get_draft_products'])->name('get-draft-products');
Route::get('/store-draft-product',[App\Http\Controllers\frontend\DraftController::class,'store_draft_product'])->name('store-draft-product');
Route::get('/get-products-by-sku-and-door-style',[App\Http\Controllers\frontend\DraftController::class,'getProductsBySku'])->name('new-draft');
Route::get('/get-cutdepth-by-product',[App\Http\Controllers\frontend\DraftController::class,'getcutdepthByProduct'])->name('get-cutdepth-by-product');
Route::get('/get-modifications-by-product',[App\Http\Controllers\frontend\DraftController::class,'getModificationsByProduct'])->name('get-modifications-by-product');
Route::get('/add-modification-to-draft-product',[App\Http\Controllers\frontend\DraftController::class,'addModificationToDraftProduct'])->name('add-modification-to-draft-product');
Route::get('/delete-modification-from-draft-product',[App\Http\Controllers\frontend\DraftController::class,'deleteModificationFromDraftProduct']);
Route::get('/get-modification-values',[App\Http\Controllers\frontend\DraftController::class,'getModificationValues']);
Route::get('/edit-modification-info',[App\Http\Controllers\frontend\DraftController::class,'editModificationInfo']);
Route::get('/get-accessories-by-product',[App\Http\Controllers\frontend\DraftController::class,'getaccessoriesByProduct'])->name('get-accessories-by-product');
Route::get('/add-accessorie-to-draft-product',[App\Http\Controllers\frontend\DraftController::class,'addaccessorieToDraftProduct'])->name('add-accessorie-to-draft-product');
Route::get('/delete-accessorie-from-draft-product',[App\Http\Controllers\frontend\DraftController::class,'deleteAccessorieFromDraftProduct']);
Route::get('/designer_update',[App\Http\Controllers\frontend\DraftController::class,'designer_update'])->name('designer_update');
Route::get('/po_number_update',[App\Http\Controllers\frontend\DraftController::class,'po_number_update'])->name('po_number_update');
Route::get('/customer_note_update',[App\Http\Controllers\frontend\DraftController::class,'customer_note_update'])->name('customer_note_update');
Route::get('/quantity-update',[App\Http\Controllers\frontend\DraftController::class,'quantity_update'])->name('quantity-update');
Route::get('/quantity-plus',[App\Http\Controllers\frontend\DraftController::class,'quantity_plus'])->name('quantity-plus');
Route::get('/quantity-minus',[App\Http\Controllers\frontend\DraftController::class,'quantity_minus'])->name('quantity-minus');
Route::get('/updateSelectedCutDepth',[App\Http\Controllers\frontend\DraftController::class,'updateSelectedCutDepth'])->name('updateSelectedCutDepth');
Route::get('/updateIsCutDepth',[App\Http\Controllers\frontend\DraftController::class,'updateIsCutDepth'])->name('updateIsCutDepth');
Route::get('/add-hinge',[App\Http\Controllers\frontend\DraftController::class,'add_hinge'])->name('add-hinge');
Route::get('/add-finish-side',[App\Http\Controllers\frontend\DraftController::class,'add_finish_side'])->name('add-finish-side');
Route::get('/update-servie-configuration',[App\Http\Controllers\frontend\DraftController::class,'updateServieConfiguration']);
Route::get('/update-configuration',[App\Http\Controllers\frontend\DraftController::class,'updateConfiguration']);
Route::get('/draft-product/{draft_style_id}',[App\Http\Controllers\frontend\CustomerController::class,'draft_product'])->name('draft-product');
// Route::get('/add-cart/{customer_draft_Id}',[App\Http\Controllers\frontend\DraftController::class,'addCart'])->name('add-cart');
Route::get('/add-cart/{customer_draft_Id}',[App\Http\Controllers\frontend\TrackingStatusController::class,'addCart'])->name('add-cart');
Route::get('/door-price',[App\Http\Controllers\frontend\TrackingStatusController::class,'doorPrice'])->name('doorPrice');

Route::get('/mail',[App\Http\Controllers\frontend\TrackingStatusController::class,'mail'])->name('mail');
Route::get('/invoice',[App\Http\Controllers\frontend\TrackingStatusController::class,'invoice'])->name('invoice');
Route::get('/draft-product/delete/{id}', '\App\Http\Controllers\frontend\DraftController@draft_product_destroy')->name('draft-product-delete');
Route::get('/draft/delete/{id}', '\App\Http\Controllers\frontend\DraftController@draft_destroy')->name('draft-delete');
Route::get('checkout-form',[App\Http\Controllers\frontend\TrackingStatusController::class,'checkout_form'])->name('checkout_form');
Route::post('store-checkout-form',[App\Http\Controllers\frontend\TrackingStatusController::class,'store_checkout_form'])->name('store_checkout_form');
Route::get('refresh-draft/{status}/{id}/{price}/{original_price}', '\App\Http\Controllers\frontend\DraftController@refresh_draft')->name('refresh_draft');
Route::get('save-draft/{status}/{id}/{price}/{original_price}', '\App\Http\Controllers\frontend\DraftController@save_draft')->name('save_draft');
Route::get('save-stay-draft/{status}/{id}/{price}/{original_price}', '\App\Http\Controllers\frontend\DraftController@save_stay_draft')->name('save_stay_draft');
Route::get('credit-card/authentication/{customer_draft_Id}',[App\Http\Controllers\frontend\DraftController::class,'credit_card_authentication'])->name('credit-card-authentication');
Route::POST('store_credit_card/{customer_draft_Id}',[App\Http\Controllers\frontend\DraftController::class,'store_credit_card'])->name('credit-card-authentication');
Route::get('payment/{customer_draft_Id}',[App\Http\Controllers\frontend\DraftController::class,'order'])->name('payment');
	
Route::get('/card-payment/{id}', [App\Http\Controllers\frontend\DraftController::class,'card_payment'])->name('card-payment');
Route::get('/bank-payment', [App\Http\Controllers\frontend\DraftController::class,'bank_payment'])->name('bank-payment');
Route::get('/success/{id}/{payment_id?}', [App\Http\Controllers\frontend\DraftController::class,'success'])->name('success');

Route::get('/payment-quickbooks', [App\Http\Controllers\frontend\QuickBooksController::class, 'showPaymentForm'])->name('payment-form');
Route::get('/initiate-payment/{id}', [App\Http\Controllers\frontend\QuickBooksController::class, 'initiatePayment'])->name('initiate-payment');
Route::get('/oauth/callback', [App\Http\Controllers\frontend\QuickBooksController::class, 'paymentCallback'])->name('payment-callback');
Route::post('/add-bank-account', [App\Http\Controllers\frontend\QuickBooksController::class, 'addBankAccount']);
Route::post('/create-invoice2', [App\Http\Controllers\frontend\QuickBooksController::class, 'createInvoice2']);

//CreditCard

Route::get('/payment', [App\Http\Controllers\frontend\CreditcardController::class,'index'])->name('index');
Route::get('/card/create', [App\Http\Controllers\frontend\CreditcardController::class,'create'])->name('create');
Route::POST('/payment/store', [App\Http\Controllers\frontend\CreditcardController::class,'store'])->name('store');
Route::get('/payment/delete/{id}', [App\Http\Controllers\frontend\CreditcardController::class,'destroy'])->name('delete');
Route::get('/payment/edit/{id}', [App\Http\Controllers\frontend\CreditcardController::class,'edit'])->name('edit');
Route::PATCH('/payment/update/{id}', [App\Http\Controllers\frontend\CreditcardController::class,'update'])->name('update');


//Tracking Status

Route::get('/tracking-status', [App\Http\Controllers\frontend\TrackingStatusController::class,'index'])->name('index');
Route::get('/tracking-status/view/{id}', [App\Http\Controllers\frontend\TrackingStatusController::class,'view'])->name('view');
Route::POST('/tracking-status/fetch-style', [App\Http\Controllers\frontend\TrackingStatusController::class,'fetchStyles'])->name('fetchStyles');
// Route::get('/door-style/change/{draft_style_id}/{customer_draft_Id}', [App\Http\Controllers\frontend\TrackingStatusController::class,'change_draft_style'])->name('change_draft_style');
// Route::post('/add-draft/change/{id}/{draft_style_id}', [App\Http\Controllers\frontend\TrackingStatusController::class,'post_change_draft_style'])->name('post_change_draft_style');


//Report

Route::get('/report', [App\Http\Controllers\frontend\ReportController::class,'index'])->name('index');
Route::any('/order-history', [App\Http\Controllers\frontend\ReportController::class,'orderHistory'])->name('orderHistory');
Route::get('/sales-orders/{id}', [App\Http\Controllers\frontend\ReportController::class,'salesOrders'])->name('salesOrders');
Route::get('/inventory-levels', [App\Http\Controllers\frontend\ReportController::class,'inventoryLevels'])->name('inventoryLevels');
Route::get('/sales-test', [App\Http\Controllers\frontend\ReportController::class,'salesTest'])->name('salesTest');



//Specbook
Route::get('/specbook', [App\Http\Controllers\frontend\SpecbookController::class,'index'])->name('index');
Route::POST('/specbook', [App\Http\Controllers\frontend\SpecbookController::class,'compare_draft'])->name('compare_draft');
Route::get('/get-category-products', [App\Http\Controllers\frontend\SpecbookController::class,'getProducts'])->name('getProducts');


//RMA's

Route::get('/rma-s', [App\Http\Controllers\frontend\RMAController::class,'index'])->name('index');
Route::get('/replace/{id}', [App\Http\Controllers\frontend\RMAController::class,'view'])->name('view');
Route::POST('/replace-order', [App\Http\Controllers\frontend\RMAController::class,'replaceOrder'])->name('replace-order');

});


 Auth::routes();
    Route::group(['middleware' => ['auth','isAdmin']], function () {
				Route::prefix('admin')->group(function () {
					Route::get('home', [BackendController::class, 'index'])->name('admin.home');

				// Products
	
				// Route::get('product-add', [App\Http\Controllers\backend\ProductController::class, 'create'])->name('admin.product-add');
				// Route::Post('/product-store', [App\Http\Controllers\backend\ProductController::class, 'store'])->name('admin.product-store');
				// Route::get('product/edit/{id}', [App\Http\Controllers\backend\ProductController::class, 'edit'])->name('admin.product.edit');
				// Route::get('/product/delete/{id}',[App\Http\Controllers\backend\ProductController::class, 'destroy'])->name('admin.delete');
				// Route::PATCH('/product/update/{id}',[App\Http\Controllers\backend\ProductController::class, 'update'])->name('admin.update');

				// Route::get('product-list', [App\Http\Controllers\backend\ProductController::class, 'index'])->name('admin.product-list');
				// Route::get('product-grid', [BackendController::class, 'productGrid'])->name('admin.product-grid');
				// Route::get('product-detail', [BackendController::class, 'productDetail'])->name('admin.product-detail');
				// Route::get('product-cart', [BackendController::class, 'productCart'])->name('admin.product-cart');
				// Route::get('checkout', [BackendController::class, 'checkout'])->name('admin.checkout');


				// Items

				Route::get('item-list', [App\Http\Controllers\backend\ItemController::class, 'index'])->name('admin.item-list');
				Route::get('item-view/{id}', [App\Http\Controllers\backend\ItemController::class, 'view'])->name('admin.item.view');
				Route::get('item-add', [App\Http\Controllers\backend\ItemController::class, 'create'])->name('admin.item-add');
				Route::Post('/item-store', [App\Http\Controllers\backend\ItemController::class, 'store'])->name('admin.item-store');
				Route::get('item-edit/{id}', [App\Http\Controllers\backend\ItemController::class, 'edit'])->name('admin.item.edit');
				Route::get('/item/delete/{id}',[App\Http\Controllers\backend\ItemController::class, 'destroy'])->name('item.delete');
				Route::PATCH('/item/update/{id}',[App\Http\Controllers\backend\ItemController::class, 'update'])->name('item.update');
				Route::get('item-duplicate/{id}', [App\Http\Controllers\backend\ItemController::class, 'duplicate'])->name('admin.item.duplicate');
				Route::Post('/item/duplicate/{id}',[App\Http\Controllers\backend\ItemController::class, 'store_duplicate'])->name('item.duplicate');
				Route::get('door-price/create', [App\Http\Controllers\backend\DoorPriceController::class, 'create'])->name('create');
				Route::Post('/doorprice-store', [App\Http\Controllers\backend\DoorPriceController::class, 'store'])->name('store');
				Route::get('edit-unassembled-discount', [App\Http\Controllers\backend\ItemController::class, 'edit_unassembled_discount'])->name('admin.edit.unassembled.discount');
				Route::PATCH('update-unassembled-discount',[App\Http\Controllers\backend\ItemController::class, 'update_unassembled_discount'])->name('admin.update.unassembled.discount');

    	     	//Modification

				Route::get('modification/create',[App\Http\Controllers\backend\ModificationController::class, 'create'])->name('modification-create');
				Route::POST('/modification/store', [App\Http\Controllers\backend\ModificationController::class,'store'])->name('modificationmaster.store');
				Route::get('modification/index',[App\Http\Controllers\backend\ModificationController::class, 'index'])->name('modification-index');
				Route::get('/modification/delete/{id}', [App\Http\Controllers\backend\ModificationController::class, 'destroy'])->name('delete');
  

				//Customer group

				Route::get('/customer-group/index', '\App\Http\Controllers\backend\CustomerGroupController@index')->name('index');
				Route::get('/customer-group/create', '\App\Http\Controllers\backend\CustomerGroupController@create')->name('create');
				Route::POST('/customer-group/store', '\App\Http\Controllers\backend\CustomerGroupController@store')->name('store');
				Route::get('/customer-group/edit/{id}', '\App\Http\Controllers\backend\CustomerGroupController@edit')->name('edit');
				Route::PATCH('/customer-group/update/{id}', '\App\Http\Controllers\backend\CustomerGroupController@update')->name('update');
				Route::get('/customer-group/delete/{id}', '\App\Http\Controllers\backend\CustomerGroupController@destroy')->name('delete');



				//Customer Grouping
				
				Route::get('/customer-grouping/index', '\App\Http\Controllers\backend\CustomerGroupingController@index')->name('index');
				Route::get('/customer-grouping/edit/{id}', '\App\Http\Controllers\backend\CustomerGroupingController@edit')->name('edit');
				Route::PATCH('/customer-grouping/update/{id}', '\App\Http\Controllers\backend\CustomerGroupingController@update')->name('update');
				Route::POST('/customer-grouping/fetch-customers', '\App\Http\Controllers\backend\CustomerGroupingController@fetchCustomers')->name('fetchCustomers');

				//Pay Later Group 
				
				Route::get('/pay-later-group/index', '\App\Http\Controllers\backend\PayLaterGroupController@index')->name('index');
				Route::get('/pay-later-group/edit/{id}', '\App\Http\Controllers\backend\PayLaterGroupController@edit')->name('edit');
				Route::PATCH('/pay-later-group/update/{id}', '\App\Http\Controllers\backend\PayLaterGroupController@update')->name('update');
				
				Route::get('/shipping-cost/index', '\App\Http\Controllers\backend\ShippingCostController@index')->name('index');
				Route::get('/shipping-cost/edit/{id}', '\App\Http\Controllers\backend\ShippingCostController@edit')->name('edit');
				Route::PATCH('/shipping-cost/update/{id}', '\App\Http\Controllers\backend\ShippingCostController@update')->name('update');

				Route::get('/default-shipping-cost/edit', '\App\Http\Controllers\backend\ShippingCostController@edit_default_shipping_cost')->name('edit_default_shipping_cost');
				Route::PATCH('/default-shipping-cost/update', '\App\Http\Controllers\backend\ShippingCostController@update_default_shipping_cost')->name('update_default_shipping_cost');
				
        
				//Tax group

				Route::get('/tax-group/index', '\App\Http\Controllers\backend\TaxGroupController@index')->name('index');
				Route::get('/tax-group/create', '\App\Http\Controllers\backend\TaxGroupController@create')->name('create');
				Route::POST('/tax-group/store', '\App\Http\Controllers\backend\TaxGroupController@store')->name('store');
				Route::get('/tax-group/edit/{id}', '\App\Http\Controllers\backend\TaxGroupController@edit')->name('edit');
				Route::PATCH('/tax-group/update/{id}', '\App\Http\Controllers\backend\TaxGroupController@update')->name('update');
				Route::get('/tax-group/delete/{id}', '\App\Http\Controllers\backend\TaxGroupController@destroy')->name('delete');


              


				//Tax Grouping
				Route::get('/tax-grouping/edit/{id}', '\App\Http\Controllers\backend\TaxGroupController@TaxGredit')->name('edit');
				Route::get('/tax-grouping/index', '\App\Http\Controllers\backend\TaxGroupController@TaxGroupingIndex')->name('index');
				Route::PATCH('/tax-grouping/update/{id}', '\App\Http\Controllers\backend\TaxGroupController@TaxGroupingupdate')->name('TaxGroupingupdate');
                
   			 //Add Modification

				Route::get('addmodification/index', [App\Http\Controllers\backend\AddmodificationController::class, 'index'])->name('addmodification-index');
				Route::get('/addmodification/create', [App\Http\Controllers\backend\AddmodificationController::class, 'create'])->name('addmodification-create');
				Route::POST('/backend/addmodification/store', [App\Http\Controllers\backend\AddmodificationController::class,'store'])->name('addmodification.store');
				Route::get('/addmodification/delete/{id}', [App\Http\Controllers\backend\AddmodificationController::class, 'destroy'])->name('delete');
				Route::get('/addmodification/edit/{id}', [App\Http\Controllers\backend\AddmodificationController::class, 'edit'])->name('addmodification-edit');
				Route::PATCH('/addmodification-update/{id}', [App\Http\Controllers\backend\AddmodificationController::class,'update'])->name('addmodification-update');
		

				//Add Accessories

				Route::get('accessories/index', [App\Http\Controllers\backend\AccessoriesController::class, 'index'])->name('accessories-index');
				Route::get('/accessories/create', [App\Http\Controllers\backend\AccessoriesController::class, 'create'])->name('accessories-create');
				Route::POST('/backend/accessories/store', [App\Http\Controllers\backend\AccessoriesController::class,'store'])->name('accessories.store');
				Route::get('/accessories/delete/{id}', [App\Http\Controllers\backend\AccessoriesController::class, 'destroy'])->name('delete');
				Route::get('/accessories/edit/{id}', [App\Http\Controllers\backend\AccessoriesController::class, 'edit'])->name('accessories-edit');
				Route::PATCH('/accessories-update/{id}', [App\Http\Controllers\backend\AccessoriesController::class,'update'])->name('accessories-update');


				// Category

				Route::get('categories-list', [App\Http\Controllers\backend\CategoryController::class, 'index'])->name('admin.categories-list');
				Route::get('categories-add', [App\Http\Controllers\backend\CategoryController::class, 'create'])->name('admin.categories-add');
				Route::POST('/categories-store', [App\Http\Controllers\backend\CategoryController::class,'store'])->name('admin.categories-store');
				Route::get('/categorie/delete/{id}', '\App\Http\Controllers\backend\CategoryController@destroy')->name('delete');
				Route::get('categorie/edit/{id}', [App\Http\Controllers\backend\CategoryController::class, 'edit'])->name('categories-edit');
				Route::PATCH('categories-update/{id}', [App\Http\Controllers\backend\CategoryController::class,'update'])->name('admin.categories-update');


				// Door style

				Route::get('door-style-list', [App\Http\Controllers\backend\DoorStyleController::class, 'index'])->name('admin.door-style-list');
				Route::get('door-style-add', [App\Http\Controllers\backend\DoorStyleController::class, 'create'])->name('admin.door-style-add');
				Route::POST('door-style-store', [App\Http\Controllers\backend\DoorStyleController::class,'store'])->name('admin.door-style-store');
				Route::get('door-style/delete/{id}', '\App\Http\Controllers\backend\DoorStyleController@destroy')->name('delete');
				Route::get('door-style-edit/{id}', [App\Http\Controllers\backend\DoorStyleController::class, 'edit'])->name('door-style-edit');
				Route::PATCH('door-style-update/{id}', [App\Http\Controllers\backend\DoorStyleController::class,'update'])->name('admin.door-style-update');
				
				// Agent

				Route::get('agent-list', [App\Http\Controllers\backend\AgentController::class, 'index'])->name('admin.agent-list');
				Route::get('agent-add', [App\Http\Controllers\backend\AgentController::class, 'create'])->name('admin.agent-add');
				Route::POST('agent-store', [App\Http\Controllers\backend\AgentController::class,'store'])->name('admin.agent-store');
				Route::get('agent/delete/{id}', '\App\Http\Controllers\backend\AgentController@destroy')->name('delete');
				Route::get('agent-edit/{id}', [App\Http\Controllers\backend\AgentController::class, 'edit'])->name('agent-edit');
				Route::PATCH('agent-update/{id}', [App\Http\Controllers\backend\AgentController::class,'update'])->name('admin.agent-update');
				Route::get('agent-view/{id}', [App\Http\Controllers\backend\AgentController::class, 'view'])->name('agent-view');
				Route::get('agent-assign-index', [App\Http\Controllers\backend\AgentController::class, 'agent_assign_index'])->name('admin.agent-assign-index');
				Route::get('agent-assign/{id}', [App\Http\Controllers\backend\AgentController::class, 'agent_assign_form'])->name('admin.agent_assign');
				Route::PATCH('agent-assign-update/{id}', [App\Http\Controllers\backend\AgentController::class,'agent_assign_update'])->name('admin.agent-assign-update');
	

				//Coupon

				Route::get('coupon-list', [App\Http\Controllers\backend\CouponController::class, 'index'])->name('admin.coupon-list');
				Route::get('coupon-add', [App\Http\Controllers\backend\CouponController::class, 'create'])->name('admin.coupon-add');
				Route::POST('coupon-store', [App\Http\Controllers\backend\CouponController::class,'store'])->name('admin.coupon-store');
				Route::get('coupon/delete/{id}', '\App\Http\Controllers\backend\CouponController@destroy')->name('delete');
				Route::get('coupon-edit/{id}', [App\Http\Controllers\backend\CouponController::class, 'edit'])->name('coupon-edit');
				Route::PATCH('coupon-update/{id}', [App\Http\Controllers\backend\CouponController::class,'update'])->name('admin.coupon-update');
				Route::get('coupon-view/{id}', [App\Http\Controllers\backend\CouponController::class, 'view'])->name('coupon-view');
				

				// Order

				Route::get('order-list', [BackendController::class, 'orderList'])->name('admin.order-list');
				Route::get('order-details', [BackendController::class, 'orderDetails'])->name('admin.order-details');
				Route::get('order-invoices', [BackendController::class, 'orderInvoices'])->name('admin.order-invoices');


				// Customer
				Route::get('customers-ip-index', [App\Http\Controllers\backend\CustomerManagementController::class, 'user_ip_index'])->name('admin.customers.ip.index');
				Route::get('customers-login-date', [App\Http\Controllers\backend\CustomerManagementController::class, 'login_date_index'])->name('admin.customers.login.date');
				Route::get('customers', [App\Http\Controllers\backend\CustomerManagementController::class, 'index'])->name('admin.customers');
				Route::get('/customer/delete/{id}', '\App\Http\Controllers\backend\CustomerManagementController@destroy')->name('delete');
				Route::get('customer-create', '\App\Http\Controllers\backend\CustomerManagementController@create')->name('create');
				Route::get('customer-detail', [BackendController::class, 'customerDetails'])->name('admin.customer-detail');
				Route::POST('/customer/store', [App\Http\Controllers\backend\CustomerManagementController::class,'store'])->name('customer-store');
				Route::get('customer-edit/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'edit'])->name('customer.edit');
				Route::PATCH('/customer-update/{id}', [App\Http\Controllers\backend\CustomerManagementController::class,'update'])->name('customer.update');
				Route::get('customer-view/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'view'])->name('customer.view');
				Route::get('customer-approval-view/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'approval_view'])->name('customer.approval_view');
				Route::get('approvals', [App\Http\Controllers\backend\CustomerManagementController::class, 'approvals'])->name('approvals');
				Route::get('customer/approve/{id}/{note}/{pay_later}/{agent_id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'approve'])->name('approve');
				Route::get('customer/reject/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'reject'])->name('reject');
				Route::get('customer/active/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'active'])->name('active');
				Route::get('customer/inactive/{id}', [App\Http\Controllers\backend\CustomerManagementController::class, 'inactive'])->name('inactive');
		

				//ProcessManagement

				Route::get('process-manage', [App\Http\Controllers\backend\ProcessManagementController::class, 'index'])->name('admin.process.manage');
				//Route::get('process-manage/delete/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'destroy'])->name('draft-product-delete');
				Route::get('process-manage-view/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'view'])->name('admin.process-manage.view');
				Route::PATCH('/process-manage/update/{id}',[App\Http\Controllers\backend\ProcessManagementController::class, 'update'])->name('process-manage.update');
				Route::get('/process-manage/delete/{id}', [App\Http\Controllers\backend\ProcessManagementController::class, 'destroy'])->name('delete');

				//PDF
				
            Route::get('order-pdf', [App\Http\Controllers\backend\ReportController::class, 'orderPdf'])->name('orderPdf');
            Route::get('/with-price/{id}',[App\Http\Controllers\backend\PDFController::class,'withPrice'])->name('withPrice');
            Route::get('/without-price/{id}',[App\Http\Controllers\backend\PDFController::class,'withoutPrice'])->name('withoutPrice');
			Route::get('/sticker/{id}',[App\Http\Controllers\backend\PDFController::class,'sticker'])->name('sticker');


            //Report 

            Route::get('/report', [App\Http\Controllers\backend\ReportController::class,'index'])->name('index');       
            Route::any('/order-history', [App\Http\Controllers\backend\ReportController::class,'orderHistory'])->name('orderHistory');
            Route::get('/sales-performance/{id}', [App\Http\Controllers\backend\ReportController::class,'salesPerformance'])->name('salesPerformance');
            Route::get('/customer-list', [App\Http\Controllers\backend\ReportController::class,'customerList'])->name('customerList');
				

				//Change Password 

				Route::get('/reset_password', [App\Http\Controllers\backend\ResetPasswordController::class,'edit'])->name('edit');  
				Route::PATCH('/update_password', [App\Http\Controllers\backend\ResetPasswordController::class,'update'])->name('update');  


				// Specbook Pdf

				Route::get('/specbook-pdf', '\App\Http\Controllers\backend\SpecbookPdfController@index')->name('index');
				Route::get('/specbook-pdf/create', '\App\Http\Controllers\backend\SpecbookPdfController@create')->name('create');
				Route::POST('/specbook-pdf/store', '\App\Http\Controllers\backend\SpecbookPdfController@store')->name('store');
				Route::get('/specbook-pdf/edit/{id}', '\App\Http\Controllers\backend\SpecbookPdfController@edit')->name('edit');
				Route::PATCH('/specbook-pdf/update/{id}', '\App\Http\Controllers\backend\SpecbookPdfController@update')->name('update');


			});
		
});

Route::get('/account_manager/profile/', '\App\Http\Controllers\frontend\AgentController@view')->name('view');

Route::get('/logout', function () {
    Auth::logout();

    return redirect('/'); 
})->name('logout');
