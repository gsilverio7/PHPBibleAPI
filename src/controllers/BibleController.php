<?php

namespace API\Controllers;

use API\Utils\Response;

class BibleController 
{
    private $services;

    public function __construct() {
        $this->services['pt'] = new \API\Services\Localization\PortugueseBibleService;
        $this->services['en'] = new \API\Services\Localization\EnglishBibleService;
    }
    
    public function getVerses(string $lang, string $version, string $book, int $chapter, string $verses = '')
    {
        if (array_key_exists($lang, $this->services)) {
            return $this->services[$lang]->getVerses($version, $book, $chapter, $verses);
        }

        $response = [
            'error' => 'We do not have this language available.',
            'code' => 400
        ];  
        return Response::json($response, 400);
    }
    
    public function showInfo()
    {
        $response = [];
        foreach ($this->services as $key => $service) {
            $response[$key] = [
                'language' => $service->getLanguage(),
                'versions' => $service->getVersions()
            ];
        }
        return Response::json($response);
    }
}