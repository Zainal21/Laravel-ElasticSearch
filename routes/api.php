<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch\ClientBuilder;
use App\Http\Controllers\ArticleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article', [ArticleController::class, 'search_post']);


Route::get('/elastic-info', function () {
    $host_elastic = env('ELASTIC_HOST', 'localhost');
    $port_elastic = env('ELASTIC_PORT', '9200');
    $username_elastic = env('ELASTIC_USERNAME', 'elastic');
    $password_elastic = env('ELASTIC_PASSWORD', 'root');
    $connection_elastic = $host_elastic . ':'.$port_elastic;
    $client = ClientBuilder::create()
        ->setHosts([$connection_elastic])
        ->setBasicAuthentication($username_elastic,$password_elastic)
        ->build();
    $response = $client->info();
    return response()->json(json_decode((string)$response->getBody()));  
});

Route::get('/elastic-params-index', function () {
    $host_elastic = env('ELASTIC_HOST', 'localhost');
    $port_elastic = env('ELASTIC_PORT', '9200');
    $username_elastic = env('ELASTIC_USERNAME', 'elastic');
    $password_elastic = env('ELASTIC_PASSWORD', 'root');
    $connection_elastic = $host_elastic . ':'.$port_elastic;
    $client = ClientBuilder::create()
        ->setHosts([$connection_elastic])
        ->setBasicAuthentication($username_elastic,$password_elastic)
        ->build();
    $params = [
        'index' => 'my-index',
        'client' => [
            'future' => 'lazy'
        ],
        'body' => [
            'foo' => 'bar'
            ]
        ];
    $response = $client->index($params);
    return response()->json(json_decode((string)$response->getBody()));  
});
