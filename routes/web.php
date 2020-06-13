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
    return redirect("/login");
})->name( 'register' );

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::group( ['middleware'=>['auth'] ], function(){
    Route::group( ['prefix' => 'master'], function(){
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
    });

    Route::group( ['prefix' => 'transactions'], function(){
        // Selling Transactions
        Route::post( '/sellings/add_row', 'SellingController@add_row' )->name( 'sellings.add_row' );
        Route::post( '/sellings/add_order', 'SellingController@add_order' )->name( 'sellings.add_order' );
        Route::resource( "sellings", "SellingController" );
    });
});