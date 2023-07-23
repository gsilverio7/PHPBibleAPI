<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

Router::error(function(Request $request, \Exception $exception) {
    Router::response()->json([
        'error' => $exception->getMessage(),
        'code'  => $exception->getCode(),
    ]);
});

Router::get('/', function() {
    require_once(__DIR__ . '/../public/documentation.php');
});

Router::get('/openapi', function() {
    require_once(__DIR__ . '/../api/openapi.json');
});

Router::setDefaultNamespace('API\Controllers');
Router::get('/api/{lang}/{version}/{book}/{chapter}/{verses?}', 'BibleController@getVerses')
    ->where([ 'chapter' => '[0-9]+', 'verses' => '.*' ]);
Router::get('/api/info', 'BibleController@showInfo');

Router::start();