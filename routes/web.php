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
    $client = ClientBuilder::create()
    ->setHosts(['localhost:9200'])
    ->setBasicAuthentication('elastic', 'wVfxie=VMbWZK9nmKZZw')
    ->build();
    $response = $client->info();
});
