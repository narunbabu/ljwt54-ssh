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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Use App\Article;

Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');
Route::get('states', 'SthaliController@indexst');
Route::get('districts/{state_code}', 'SthaliController@showd');
// Route::get('districts', 'SthaliController@indexd');
Route::get('sds/{dist_code}', 'SthaliController@showsds');

Route::get('vils/{sub_dist_code}', 'SthaliController@show_vils');
Route::get('vildet/{vil_code}', 'SthaliController@show_village');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
    Route::get('articles', 'ArticleController@index');
    

    Route::get('articles/{id}', 'ArticleController@show');
     

    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{id}', 'ArticleController@update');
    Route::delete('articles/{id}', 'ArticleController@delete');
    // Route::get('articles', function() {
    //     // If the Content-Type and Accept headers are set to 'application/json', 
    //     // this will return a JSON structure. This will be cleaned up later.
    //     return Article::all();
    //  });
     
    //  Route::get('articles/{id}', function($id) {
    //     return Article::find($id);
    //  });
     
    //  Route::post('articles', function(Request $request) {
    //     return Article::create($request->all);
    //  });
     
    //  Route::put('articles/{id}', function(Request $request, $id) {
    //     $article = Article::findOrFail($id);
    //     $article->update($request->all());
     
    //     return $article;
    //  });
     
    //  Route::delete('articles/{id}', function($id) {
    //     Article::find($id)->delete();
     
    //     return 204;
    //  });
});




