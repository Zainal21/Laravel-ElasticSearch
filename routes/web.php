<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use Elastic\Elasticsearch\ClientBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article', [ArticleController::class, 'search_post']);


Route::get('/test-elastic', function () {
    $host_elastic = env('ELASTIC_HOST', 'localhost');
    $port_elastic = env('ELASTIC_PORT', '9200');
    $username_elastic = env('ELASTIC_USERNAME', 'elastic');
    $password_elastic = env('ELASTIC_PASSWORD', 'root');
    $connection_elastic = $host_elastic . ':'.$port_elastic;
    $client = ClientBuilder::create()
        ->setHosts([$connection_elastic])
        ->setBasicAuthentication($username_elastic,$password_elastic)
        ->build();
    // $response = $client->info();
    // return response()->json(json_decode((string)$response->getBody()));  
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
