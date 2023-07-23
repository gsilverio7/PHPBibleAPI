<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

Router::error(function(Request $request, \Exception $exception) {
    switch ($exception->getCode()) {
        case 404:
            $errorMessage = 'Resource not found. Check the URL requested is correct.';
            break;
        case 500:
            $errorMessage = 'Something went wrong in our side. We will try to fix as soon as possible.';
            break;
        default:
            $errorMessage = $exception->getMessage();
            break;
    }
    Router::response()->json([
        'error' => $errorMessage,
        'code'  => $exception->getCode(),
    ]);
});

Router::get('/', function() {
    require_once(__DIR__ . '/../api/documentation.php');
});

Router::get('/openapi', function() {
    require_once(__DIR__ . '/../api/openapi.json');
});

Router::setDefaultNamespace('API\Controllers');
Router::get('/api/{lang}/{version}/{book}/{chapter}/{verses?}', 'BibleController@getVerses')
    ->where([ 'chapter' => '[0-9]+', 'verses' => '.*' ]);
Router::get('/api/info', 'BibleController@showInfo');

Router::start();