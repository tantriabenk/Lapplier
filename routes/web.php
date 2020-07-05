<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get( '/' , function () {
    return view( 'auth.login' );
});

Auth::routes();
Route::match( ["GET", "POST"], "/register" , function(){
    return redirect( "/login" );
})->name( 'register' );

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::group( ['middleware'=>['auth'] ], function(){

    /**
     * =======================================================
     * Master Route
     * =======================================================
     */
    Route::group( [ 'prefix' => 'master' ], function(){
        // Manage Users
        Route::resource( "users", "UserController" );

        // Manage Merek
        Route::get( '/merks/trash', 'MerkController@trash' )->name( 'merks.trash' );
        Route::get( '/merks/{id}/restore', 'MerkController@restore' )->name( 'merks.restore' );
        Route::resource( 'merks', 'MerkController' );

        // Manage Customers
        Route::get( '/customers/trash', 'CustomerController@trash' )->name( 'customers.trash' );
        Route::get( '/customers/{id}/restore', 'CustomerController@restore' )->name( 'customers.restore' );
        Route::resource( "customers", "CustomerController" );

        // Manage Products
        Route::post( '/products/get_detail', 'ProductController@get_detail' )->name( 'product.get_detail' );
        Route::get( '/products/trash', 'ProductController@trash' )->name( 'products.trash' );
        Route::get( '/products/{id}/restore', 'ProductController@restore' )->name( 'products.restore' );
        Route::resource("products", "ProductController");

        // Manage Suppliers
        Route::get( '/suppliers/trash', 'SupplierController@trash' )->name( 'suppliers.trash' );
        Route::get( '/suppliers/{id}/restore', 'SupplierController@restore' )->name( 'suppliers.restore' );
        Route::resource( "suppliers", "SupplierController" );
    });


    /**
     * =======================================================
     * Transactions Route
     * =======================================================
     */
    Route::group( [ 'prefix' => 'transactions' ], function(){

        // Selling Transactions
        Route::post( '/sellings/add_row', 'SellingController@add_row' )->name( 'sellings.add_row' );
        Route::post( '/sellings/add_order', 'SellingController@add_order' )->name( 'sellings.add_order' );
        Route::resource( "sellings", "SellingController" );

        // Purchase Transactions
        Route::post( '/purchases/add_row', 'PurchaseController@add_row' )->name( 'purchases.add_row' );
        Route::post( '/purchases/add_order', 'PurchaseController@add_order' )->name( 'purchases.add_order' );
        Route::resource( "purchases", "PurchaseController" );

    });


    /**
     * =======================================================
     * Report Route
     * =======================================================
     */
    Route::group( [ 'prefix' => 'reports' ], function(){

        // Selling Report (Penjualan)
        Route::post( '/sellings/export_to_pdf', 'SellingReportController@export_to_pdf' )->name( 'reports.sellings.export_to_pdf' );
        Route::post( '/sellings/export', 'SellingReportController@export' )->name( 'reports.sellings.export' );
        Route::resource( "sellings", "SellingReportController", ['names' => 'reports.sellings'] );

        // Purchase Report (Pembelian)
        Route::post( '/purchases/export_to_pdf', 'PurchaseReportController@export_to_pdf' )->name( 'reports.purchases.export_to_pdf' );
        Route::post( '/purchases/export', 'PurchaseReportController@export' )->name( 'reports.purchases.export' );
        Route::resource( "purchases", "PurchaseReportController", ['names' => 'reports.purchases'] );

        // Income Statement (Laporan Laba Rugi)
        Route::post( '/income_statement/export_to_pdf', 'IncomeStatementController@export_to_pdf' )->name( 'reports.income.export_to_pdf' );
        Route::post( '/income_statement/export', 'IncomeStatementController@export' )->name( 'reports.income.export' );
        Route::resource( "income_statement", "IncomeStatementController", ['names' => 'reports.income'] );

    });


    /**
     * =======================================================
     * Spending Route
     * =======================================================
     */
    Route::post( '/spendings/add_order', 'SpendingController@add_order' )->name( 'spendings.add_order' );
    Route::resource( "spendings", "SpendingController", ['names' => 'spendings'] );

});