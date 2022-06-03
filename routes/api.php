<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('wallet-view', 'Api\RegisterController@wallet_view');
    Route::post('profileUpdate', 'Api\RegisterController@profileUpdate');
    Route::post('passwordUpdate', 'Api\RegisterController@passwordUpdate');
});

Route::post('register', 'Api\RegisterController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('oc_register', 'Api\RegisterController@OCRegister');
Route::post('oc_checkout', 'Api\RegisterController@OcCheckout');
Route::get('check-sponsor/{username}','Api\RegisterController@OcCheck_Username');
Route::get('check-user/{username}','Api\RegisterController@checkUserExist');
Route::get('check-email-exist/{email}','Api\RegisterController@checkEmailExist');
Route::get('update-order/{order_id}/{tracking_id}/{courier}','Api\OrderController@updateOrder');
Route::get('user-type/{username}','Api\RegisterController@user_type');
Route::post('oc-influencerregister', 'Api\InfluencerController@ocInfluencerRegister');
Route::post('oc-influencercheckout', 'Api\InfluencerController@ocInfluencerCheckout');
Route::post('profile-update','Api\RegisterController@updateProfile');
Route::get('user-type-criteria','Api\RegisterController@userTypeCriteria');





