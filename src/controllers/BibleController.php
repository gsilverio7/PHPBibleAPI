<?php

namespace API\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

class BibleController 
{
    public function __construct(

    ) {

    }

    public function getVerses(string $lang, string $version, string $book, int $chapter, string $verses)
    {
        $response = [
            'info' => [
                'Language' => 'Português',
                'version' => 'Almeida Atualizada',
                'book' => 'Gênesis',
                'chapter' => 23
            ],
            'verses' => [
                [
                    'number' => 1,
                    'text' => 'No princípio criou Deus os céus e a terra.'
                ]
            ]
        ];
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    
    public function showInfo()
    {
        $response = [

        ];
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}