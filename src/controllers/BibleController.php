<?php

namespace API\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

class BibleController 
{
    private $services;

    public function __construct() {
        $this->services['pt'] = new \API\Services\Localization\PortugueseBibleService;
        $this->services['en'] = new \API\Services\Localization\EnglishBibleService;
    }
    
    public function getVerses(string $lang, string $version, string $book, int $chapter, string $verses = '')
    {
        return $this->services[$lang]->getVerses($version, $book, $chapter, $verses);
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
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}