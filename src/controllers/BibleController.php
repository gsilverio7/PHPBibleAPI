<?php

namespace BibleAPI\Controllers;

use BibleAPI\Utils\Response;

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
        $this->services['pt'] = new \BibleAPI\Services\Localization\PortugueseBibleService;
        $this->services['en'] = new \BibleAPI\Services\Localization\EnglishBibleService;
    }
    
    /**
     * @OA\Get(
     *     path="/api/{lang}/{version}/{book}/{chapter}/{verses}",
     *     summary="Get bible verses",
     *     tags={"default"},
     *     @OA\Parameter(
     *         description="Bible Language Abbreviation. E.g. 'en' for English.",
     *         in="path",
     *         name="lang",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Version Abbreviation. E.g. 'kjv' for King James Version.",
     *         in="path",
     *         name="version",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Book Abbreviation. E.g. 'gn' for Genesis.",
     *         in="path",
     *         name="book",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Chapter Number.",
     *         in="path",
     *         name="chapter",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         description="Bible Verses. Can be a single number for a single verse, or an interval. E.g. '1-3' for verses 1, 2 and 3. '1,5' for verses 1 and 5. Or even '1-3,5' for verses 1, 2, 3 and 5. You can also retrieve the whole chapter by not giving this parameter.",
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