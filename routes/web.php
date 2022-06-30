<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/test-elastic-response', function () {
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
