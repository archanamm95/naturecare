<?php 

/*
|--------------------------------------------------------------------------
| Terms view 
|--------------------------------------------------------------------------
|
|  Route for terms view
|
 */
// Route::get('legal/terms', ['as' => 'legal.terms', 'uses' =>'\Aslambpract\Laralegal\Controllers\LaraLegalTermsController@viewterms']);


// Route::get('demo/test', function () {
//     return 'Test';
// });

// Route::get('demo/hello', function () {
//     return Demo::hello();
// });


Route::get('legal/terms', 'AslamBpract\LaraLegals\Http\Controllers\LaraLegalsTermsController@view_terms');
