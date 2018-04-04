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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List articles
Route::get("articles","ArticleController@index");

//List single articles
Route::get("article/{id}","ArticleController@show");

//Create New article
Route::post("article","ArticleController@store");

//Update article
Route::put("article","ArticleController@store");

//Delete article
Route::delete("article/{id}","ArticleController@destroy");



	
Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id'     => '3',
        'redirect_uri'  => 'http://127.0.0.1:8000/oauth/callback',
        'response_type' => 'code',
        'scope'         => '',
    ]);
 
    return redirect('http://127.0.0.1:8000/oauth/authorize?' . $query);
});


	
Route::get('/oauth/callback', function () {
 
    $http = new GuzzleHttp\Client;
 
    if (request('code')) {
        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type'    => 'authorization_code',
                'client_id'     => '3',
                'client_secret' => '7Mux8bKt2XAOMAXMZ3RGEvgJMGdcegeKHjFCih73',
                'redirect_uri'  => 'http://127.0.0.1:8000/oauth/callback',
                'code'          => request('code'),
            ],
        ]);
 
        return json_decode((string)$response->getBody(), TRUE);
    } else {
        return response()->json(['error' => request('error')]);
    }
});

