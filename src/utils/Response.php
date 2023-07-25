<?php

namespace BibleAPI\Utils;

class Response
{
    public static function json($response, int $statusCode = 200): string
    {
        if (! headers_sent()) {
            header('Content-Type: application/json');
            //cache-control recommended for vercel deployment
            header('Cache-Control: max-age=0, s-maxage=86400');
        }

        http_response_code($statusCode);       
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}