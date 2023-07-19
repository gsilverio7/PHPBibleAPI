<?php

namespace API\Utils;

class Response
{
    public static function json($response, int $statusCode = 200): string
    {
        http_response_code($statusCode);       
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}