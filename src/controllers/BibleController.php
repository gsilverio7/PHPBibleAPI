<?php

namespace API\Controllers;

use API\Utils\Response;

class BibleController 
{
    /**
     * @OA\Info(
     *  title="Bible API", 
     *  description="RESTful Bible API with multiple language and version support. Created with PHP without any major framework.",
     *  version="1.0"
     * )
     */

    private $services;

    public function __construct() {
        $this->services['pt'] = new \API\Services\Localization\PortugueseBibleService;
        $this->services['en'] = new \API\Services\Localization\EnglishBibleService;
    }
    
    /**
     * @OA\Get(
     *     path="/api/{lang}/{version}/{book}/{chapter}/{verses}",
     *     summary="Get bible verses",
     *     tags={"default"},
     *     @OA\Parameter(
     *         description="Bible Language",
     *         in="path",
     *         name="lang",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Version",
     *         in="path",
     *         name="version",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Book",
     *         in="path",
     *         name="book",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Chapter",
     *         in="path",
     *         name="chapter",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Verses",
     *         in="path",
     *         name="verses",
     *         required=false,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                      "info": {
     *                          "language": "Portuguese", 
     *                          "version": "Almeida Atualizada", 
     *                          "book": "Gênesis", 
     *                          "chapter": 1
     *                      }, 
     *                      "verses": {
     *                          "verse": 1, 
     *                          "text": "No princípio criou Deus os céus e a terra."
     *                      }
     *                  }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad params request"
     *     )
     * )
     */
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
    
    /**
     * @OA\Get(
     *     path="/api/info",
     *     summary="Get info about current languages and versions available.",
     *     tags={"default"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "pt": {
     *                         "language": "Portuguese", 
     *                         "versions": {
     *                                "aa": "Almeida Atualizada", 
     *                                "acf": "Almeida Corrigida Fiel", 
     *                                "nvi": "Nova Versão Internacional"
     *                          }
     *                     }, 
     *                     "en": {
     *                          "language": "English", 
     *                          "versions": {
     *                                 "bbe": "Basic Bible English",
     *                                 "kjv": "King James Version"
     *                          }
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     */
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