<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/movies','MoviesController@all');
$router->get('/movies/{id}','MoviesController@one');
$router->get('/movies/{id}/ratings','MoviesController@movieRatings');

$router->get('/users/{id}','UsersController@one');
$router->get('/users/{id}/ratings','UsersController@userRatings');



$router->post(
    'auth/login',
    [
        'uses' => 'AuthController@authenticate'
    ]
);

$router->post('/auth/register','AuthController@register');

$router->group(
    ['middleware' => 'jwt.auth'],
    function() use ($router) {

        $router->post('/movies/{id}/ratings','MoviesController@storeRating');

        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
