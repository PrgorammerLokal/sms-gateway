<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Nexmo\Laravel\Facade\Nexmo;

// use Nexmo\Laravel\Facade\Nexmo;

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
// route post
$router->group(['prefix' => 'posts', 'middleware' => ['auth', 'permission:create posts']], function () use ($router) {
    $router->get('all', 'PostController@index');
});
// route auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');
    $router->post('logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);
});

// route send message
$router->get('/sms', function () use ($router) {
    $basic  = new \Vonage\Client\Credentials\Basic("69ea4fde", "2HjRImYotrb1DPAp");
    $client = new \Vonage\Client($basic);
    $response = $client->sms()->send(
        new \Vonage\SMS\Message\SMS("6281230830096", 'Programmer Lokal', 'Send SMS form Lumen')
    );

    $message = $response->current();

    if ($message->getStatus() == 0) {
        return response()->json([
            'status' => true,
            'message' => 'The message was sent successfully',
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => "The message failed with status: " . $message->getStatus() . "\n"
        ], 400);
    }
});
