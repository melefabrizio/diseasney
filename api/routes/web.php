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
$router->get('/movie/{id}','MoviesController@one');
$router->get('/movie/{id}/ratings','MoviesController@movieRatings');

$router->get('/user/{id}','UsersController@one');
$router->get('/user/{id}/ratings','UsersController@userRatings');



$router->post(
    'auth/login',
    [
        'uses' => 'AuthController@authenticate'
    ]
);

$router->group(
    ['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
