<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' =>'AdminController@index']);
Route::post('/', ['uses' => 'AdminController@signIn']);

Route::get('administrator', ['as' => 'administrator', 'uses' =>'AdminController@index']);

//Administrator Route
Route::group(['prefix' => 'administrator'], function(){
    Route::get('/', ['as' => 'login_page', 'uses' => 'AdminController@index']);
    Route::post('/', ['as' => 'login_post','uses' => 'AdminController@signIn']);

    Route::group(['middleware' => 'superAdminAuth'], function(){
        Route::get('dashboard', ['as'=> 'dashboard', 'uses' => 'AdminController@dashboard']);


        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', ['as' => 'all_categories', 'uses' => 'CategoryController@index']);
            Route::get('all/data', ['as' => 'all_categories_data', 'uses' => 'CategoryController@indexData']);
            Route::get('create', ['as' => 'create_category', 'uses' => 'CategoryController@create']);
            Route::post('create', 'CategoryController@store');
            Route::get('{id}/edit', ['as' => 'edit_category', 'uses' => 'CategoryController@edit']);
            Route::post('{id}/edit', 'CategoryController@update');
            Route::post('delete', ['as' => 'delete_category', 'uses' => 'CategoryController@destroy']);
        });

        Route::group(['prefix' => 'brands'], function() {
            Route::get('/', ['as' => 'all_brands', 'uses' => 'BrandController@index']);
            Route::get('all/data', ['as' => 'all_brands_data', 'uses' => 'BrandController@indexData']);
            Route::get('create', ['as' => 'create_brand', 'uses' => 'BrandController@create']);

            Route::post('create', 'BrandController@store');
            Route::get('{id}/edit', ['as' => 'edit_brand', 'uses' => 'BrandController@edit']);
            Route::post('{id}/edit', 'BrandController@update');
            Route::post('delete', ['as' => 'delete_brand', 'uses' => 'BrandController@destroy']);
        });



        Route::group(['prefix' => 'products'], function() {
            Route::get('/', ['as' => 'all_products', 'uses' => 'ProductController@index']);
            Route::get('all/data', ['as' => 'all_products_data', 'uses' => 'ProductController@indexData']);
            Route::get('create', ['as' => 'create_product', 'uses' => 'ProductController@create']);

            Route::post('create', 'ProductController@store');
            Route::get('{id}/view', ['as' => 'view_product', 'uses' => 'ProductController@show']);
            Route::get('{id}/edit', ['as' => 'edit_product', 'uses' => 'ProductController@edit']);
            Route::post('{id}/edit', 'ProductController@update');
            Route::post('delete', ['as' => 'delete_product', 'uses' => 'ProductController@destroy']);

            Route::get('add-product-attribute', ['as' => 'add_product_attribute', 'uses' => 'ProductController@addProductAttribute']);
            Route::post('delete-product-attribute', ['as' => 'delete_product_attr', 'uses' => 'ProductController@deleteProductAttribute']);
        });


        Route::group(['prefix' => 'stock'], function() {
            Route::get('/', ['as' => 'stock_index', 'uses' => 'StockController@index']);
            Route::get('all/data', ['as' => 'all_stock_data', 'uses' => 'StockController@indexData']);
            Route::get('create', ['as' => 'create_stock', 'uses' => 'StockController@create']);
            Route::post('create', 'StockController@store');
            Route::get('{id}/edit', ['as' => 'edit_stock', 'uses' => 'StockController@edit']);
            Route::post('{id}/edit', 'StockController@update');

            Route::get('{id}/view', ['as' => 'view_stock', 'uses' => 'StockController@show']);
            Route::get('transfer-to-stock', ['as' => 'transfer_stock', 'uses' => 'StockController@transferToShop']);
            Route::post('transfer-to-stock', ['as' => 'transfer_stock', 'uses' => 'StockController@store']);
            Route::post('delete-stock', ['as' => 'delete_stock', 'uses' => 'StockController@destroy']);

        });


        Route::group(['prefix' => 'shop'], function() {
            Route::get('/', ['as' => 'all_shops', 'uses' => 'ShopController@index']);
            Route::get('all-data', ['as' => 'all_shops_data', 'uses' => 'ShopController@indexData']);
            Route::get('create', ['as' => 'add_shop_admin', 'uses' => 'ShopController@create']);
            Route::post('create', ['as' => 'add_shop_admin', 'uses' => 'ShopController@store']);
            Route::get('{id}/view', ['as' => 'admin_shop_view', 'uses' => 'ShopController@show']);
            Route::post('{id}/change-status', ['as' => 'changeShopStatus', 'uses' => 'ShopController@changeStatus']);

            Route::get('{id}/products', ['as' => 'admin_shop_products', 'uses' => 'ShopController@shopProducts']);
            Route::get('{id}/products/data', ['as' => 'shop_all_products_data', 'uses' => 'ShopController@shopProductsData']);
            Route::get('{id}/stocks', ['as' => 'admin_shop_stocks', 'uses' => 'ShopController@shopStocks']);
            Route::get('{id}/stocks/data', ['as' => 'shop_all_stocks_data', 'uses' => 'ShopController@shopStocksData']);


            Route::group(['prefix' => 'sales'], function() {
                Route::get('/', ['as' => 'admin_all_sales', 'uses' => 'InvoiceController@shopSales']);

                Route::get('create', ['as' => 'admin_new_sales', 'uses' => 'ShopController@newSales']);
                Route::post('create', 'ShopController@newSalesPost');

                Route::get('shop-sales-index', ['as' => 'admin_sales_index', 'uses' => 'InvoiceController@shopSalesData']);
                Route::get('{id}/view-invoice', ['as' => 'admin_view_sales_invoice', 'uses' => 'InvoiceController@show']);
                Route::get('{id}/view-invoice/print', ['as' => 'admin_print_sales_invoice', 'uses' => 'InvoiceController@invoicePrint']);
                Route::get('{id}/view-invoice/pdf', ['as' => 'admin_pdf_sales_invoice', 'uses' => 'InvoiceController@invoicePDF']);
            });

        });







        Route::group(['prefix' => 'agents'], function() {
            Route::get('/', ['as' => 'all_agents', 'uses' => 'UserController@index']);
            Route::get('agents-data', ['as' => 'all_agents_data', 'uses' => 'UserController@indexData']);
            Route::get('create', ['as' => 'admin_agent_create', 'uses' => 'UserController@create']);
            Route::post('create', ['as' => 'admin_agent_create', 'uses' => 'UserController@store']);

            Route::get('edit/{id}', ['as' => 'edit_agent', 'uses' => 'UserController@edit']);
            Route::post('edit/{id}', ['as' => 'edit_agent', 'uses' => 'UserController@update']);
            Route::post('delete', ['as' => 'delete_user', 'uses' => 'UserController@destroy']);

        });

        //Messages  from Agent
        Route::group(['prefix' => 'messages'], function() {
            Route::get('/', ['as' => 'admin_inbox', 'uses' => 'MessageController@index']);
            Route::get('sent', ['as' => 'admin_sent_message', 'uses' => 'MessageController@sent']);
            Route::get('read/{id}', ['as' => 'admin_message_read', 'uses' => 'MessageController@show']);
            Route::post('read/{id}', ['as' => 'admin_message_read', 'uses' => 'MessageController@reply']);
            Route::get('compose', ['as' => 'admin_message_compose', 'uses' => 'MessageController@create']);
            Route::post('compose', 'MessageController@store');
            Route::get('message-inbox-user', ['as' => 'message_inbox_admin', 'uses' => 'MessageController@messageInboxData']);
            Route::get('message-sent-admin', ['as' => 'message_sent_admin_data', 'uses' => 'MessageController@messageSentData']);
        });

        Route::group(['prefix' => 'settings'], function() {
            Route::get('/', ['as' => 'common_settings', 'uses' => 'SettingsController@index']);
            Route::post('/', ['as' => 'settings_update', 'uses' => 'SettingsController@update']);
        });

        Route::get('profile', ['as'=> 'admin_profile', 'uses' => 'UserController@adminProfile']);
        Route::get('profile/edit', ['as'=> 'admin_profile_edit', 'uses' => 'UserController@adminProfileEdit']);
        Route::post('profile/edit', 'UserController@profileEditPost');

        Route::get('logout', ['as'=> 'logout', 'uses' => 'AdminController@logout']);
    });
});


Route::group(['prefix' => 'admin'], function(){
    Route::get('/', ['uses' =>'UserController@signIn']);
    Route::post('/', 'UserController@signInPost');

    Route::group(['middleware' => 'userAdminAuth'], function(){
        Route::get('dashboard', ['as'=> 'user_dashboard', 'uses' => 'UserController@dashboard']);

        //Messages  from Agent
        Route::group(['prefix' => 'messages'], function() {
            Route::get('/', ['as' => 'agent_inbox', 'uses' => 'MessageController@index']);
            Route::get('sent', ['as' => 'agent_sent_message', 'uses' => 'MessageController@sent']);
            Route::get('read/{id}', ['as' => 'message_read', 'uses' => 'MessageController@show']);
            Route::post('read/{id}', ['as' => 'message_read', 'uses' => 'MessageController@reply']);
            Route::get('compose', ['as' => 'message_compose', 'uses' => 'MessageController@create']);
            Route::post('compose', ['as' => 'message_compose', 'uses' => 'MessageController@store']);
            Route::get('message-inbox-user', ['as' => 'message_inbox_user', 'uses' => 'MessageController@messageInboxData']);
            Route::get('message-sent-user', ['as' => 'message_sent_user_data', 'uses' => 'MessageController@messageSentData']);
        });

        Route::group(['prefix' => 'shop'], function() {
            Route::get('/', ['as' => 'user_shops', 'uses' => 'ShopController@userShops']);
            Route::get('view', ['as' => 'merchant_shop_view', 'uses' => 'ShopController@showMerchant']);
            Route::get('{id}/view', ['as' => 'user_shop_view', 'uses' => 'ShopController@showUser']);
            Route::get('agents', ['as' => 'user_agent_list', 'uses' => 'ShopController@allAgents']);
            Route::get('agents/data', ['as' => 'user_agent_list_data', 'uses' => 'UserController@indexData']);

            Route::get('agents/create', ['as' => 'user_agent_create', 'uses' => 'ShopController@agentCreate']);
            Route::post('agents/create', 'UserController@store');

            Route::get('agents/{id}/profile', ['as' => 'agent_profile_in_merchant', 'uses' => 'ShopController@agentProfile']);

            Route::group(['prefix' => 'products'], function() {
                Route::get('/', ['as' => 'all_shop_products', 'uses' => 'ProductController@indexShop']);
                Route::get('all/data', ['as' => 'all_shop_products_data', 'uses' => 'ProductController@indexShopData']);
            });


            Route::group(['prefix' => 'sales'], function() {
                Route::get('/', ['as' => 'user_all_sales', 'uses' => 'InvoiceController@shopSales']);
                Route::get('shop-sales-index', ['as' => 'shop_sales_index', 'uses' => 'InvoiceController@shopSalesData']);
                Route::get('{id}/view-invoice', ['as' => 'view_sales_invoice', 'uses' => 'InvoiceController@show']);
                Route::get('{id}/view-invoice/print', ['as' => 'print_sales_invoice', 'uses' => 'InvoiceController@invoicePrint']);
                Route::get('{id}/view-invoice/pdf', ['as' => 'pdf_sales_invoice', 'uses' => 'InvoiceController@invoicePDF']);
                Route::get('create', ['as' => 'user_new_sales', 'uses' => 'ShopController@newSales']);
                Route::post('create', 'ShopController@newSalesPost');
            });


            Route::group(['prefix' => 'exports'], function() {
                Route::get('agents/csv', ['as' => 'export_agents_csv', 'uses' => 'ExportController@agentsCSVByMerchant']);
                Route::get('agents/xls', ['as' => 'export_agents_xls', 'uses' => 'ExportController@agentsXlsByMerchant']);
                Route::get('agents/xlsx', ['as' => 'export_agents_xlsx', 'uses' => 'ExportController@agentsXlsxByMerchant']);
                Route::get('agents/pdf', ['as' => 'export_agents_pdf', 'uses' => 'ExportController@agentsPdfByMerchant']);
            });

            Route::get('settings', ['as' => 'shop_settings', 'uses' => 'ShopController@settings']);
            Route::post('settings', [ 'uses' => 'ShopController@settingsUpdate']);
        });


        Route::group(['prefix' => 'repair-product'], function() {
            Route::get('/', ['as' => 'all_repair_product', 'uses' => 'RepairProductController@index']);
            Route::get('repair-product-data', ['as' => 'repair_product_data', 'uses' => 'RepairProductController@repairInvoiceData']);

            Route::get('completed', ['as' => 'completed_repair_product', 'uses' => 'RepairProductController@completedRepairProduct']);
            Route::get('completed-repair-product-data', ['as' => 'completed_repair_product_data', 'uses' => 'RepairProductController@completedRepairInvoiceData']);

            Route::get('{id}/view-invoice', ['as' => 'view_repair_invoice', 'uses' => 'RepairProductController@show']);
            Route::get('{id}/view-invoice/print', ['as' => 'print_repair_invoice', 'uses' => 'RepairProductController@invoicePrint']);
            Route::get('{id}/view-invoice/pdf', ['as' => 'pdf_repair_invoice', 'uses' => 'RepairProductController@invoicePDF']);
            Route::get('create', ['as' => 'new_repair_product', 'uses' => 'RepairProductController@create']);
            Route::post('create', 'RepairProductController@store');
            Route::post('change-invoice-status', ['as' => 'change_repair_invoice_status', 'uses' => 'RepairProductController@changeRepairInvoiceStatus']);
            Route::post('save-engineer-note-in-item', ['as' => 'save_engineer_note_in_item', 'uses' => 'RepairProductController@saveEngineerNoteInItem']);
        });


        Route::group(['prefix' => 'stock'], function() {
            Route::get('/', ['as' => 'user_stock_index', 'uses' => 'StockController@index']);
            Route::get('all/data', ['as' => 'user_all_stock_data', 'uses' => 'StockController@indexData']);
        });



        Route::group(['prefix' => 'merchants'], function() {
            Route::get('/', ['as' => 'my_merchants', 'uses' => 'ShopController@myMerchants']);
            Route::get('merchant-data', ['as' => 'my_merchants_data', 'uses' => 'ShopController@myMerchantsData']);
        });



        Route::group(['prefix' => 'account'], function() {
            Route::get('change-password', ['as' => 'change_password', 'uses' => 'AdminController@changePassword']);
            Route::post('change-password', 'AdminController@changePasswordPost');
        });


        Route::get('profile', ['as'=> 'user_profile', 'uses' => 'UserController@profile']);
        Route::get('profile/edit', ['as'=> 'user_profile_edit', 'uses' => 'UserController@profileEdit']);
        Route::post('profile/edit', ['as'=> 'user_profile_edit', 'uses' => 'UserController@profileEditPost']);

        Route::get('logout', ['as'=> 'user_logout', 'uses' => 'UserController@logout']);
    });
});

Route::post('add-modal-product', ['as' => 'add_modal_product', 'uses'=> 'ShopController@addModalProduct' ]);
Route::get('get-cart-content-product', ['as' => 'get_cart_content_ajax', 'uses'=> 'ShopController@getCartContentProduct' ]);
Route::post('remove-cart-row-product', ['as' => 'remove_cart_row_product', 'uses'=> 'ShopController@removeCartRowProduct' ]);
Route::post('update-cart-row-product', ['as' => 'update_cart_row_product', 'uses'=> 'ShopController@updateCartRowProduct' ]);




Route::get('shop-signup', ['as' => 'shop_signup', 'uses' =>'ShopController@create']);
Route::post('shop-signup', 'ShopController@store');

Route::get('sign-up', ['as' => 'user_signup', 'uses' =>'UserController@create']);
Route::post('sign-up', 'UserController@store');



Route::get('sign-in', ['as' => 'sign_in', 'uses' =>'UserController@signIn']);
Route::post('sign-in', 'UserController@signInPost');

Route::group(['prefix' => 'shop'], function(){
    Route::get('/', ['as' => 'shop', 'uses' =>'HomeController@shop']);
    Route::get('{slug}', ['as' => 'shop_single', 'uses' =>'HomeController@shopSingle']);

    Route::get('{slug}/sign-up', ['as' => 'join_referral_shop', 'uses' =>'UserController@create']);
    Route::post('{slug}/sign-up', 'UserController@store');
    Route::post('{slug}/sign-in', ['as' => 'sign_in_referral_shop', 'uses' =>'UserController@signInPost']);
    Route::post('{slug}/join', ['as' => 'join_referral_program', 'uses' =>'UserController@joinShop']);

});

Route::group(['prefix' => 'invoices'], function(){
    Route::get('agents/{id}', ['as' => 'agent_invoice', 'uses' =>'InvoiceController@show']);
});

Route::group(['prefix' => 'ajax'], function(){
    Route::post('post-shop-rating', ['as' => 'post_shop_rating_api', 'uses' =>'AjaxController@postShopRating']);
    Route::post('get-shop-payment-method', ['as' => 'get_shop_payment_method', 'uses' =>'AjaxController@getShopPaymentMethod']);
});


