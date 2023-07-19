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
    return 'Hello world';
});

Router::setDefaultNamespace('API\Controllers');
Router::get('/{lang}/{version}/{book}/{chapter}/{verses?}', 'BibleController@getVerses')
    ->where([ 'chapter' => '[0-9]+', 'verses' => '.*' ]);
Router::get('/info', 'BibleController@showInfo');

Router::start();