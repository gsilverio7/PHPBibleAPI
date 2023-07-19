<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use API\Controllers\BibleController;

final class BibleTest extends TestCase
{
    public function testSingleVerse(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '1');
        
        $expectedResponse = [
            'info' => [
                'language' => 'Português',
                'version' => 'Almeida Atualizada',
                'book' => 'Gênesis',
                'chapter' => 1
            ],
            'verses' => [
                [
                    'verse' => 1,
                    'text' => 'No princípio criou Deus os céus e a terra.'
                ]
            ]
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testEntireChapter(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'sl', 117);
        
        $expectedResponse = [
            'info' => [
                'language' => 'Português',
                'version' => 'Almeida Atualizada',
                'book' => 'Salmos',
                'chapter' => 117
            ],
            'verses' => [
                [
                    'verse' => 1,
                    'text' => 'Louvai ao Senhor todas as nações, exaltai-o todos os povos.'
                ],
                [
                    'verse' => 2,
                    'text' => 'Porque a sua benignidade é grande para conosco, e a verdade do Senhor dura para sempre. Louvai ao Senhor.'
                ]
            ]
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testShowInfo(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->showInfo();

        $responseArr = (array) json_decode($response);
        $pt = (array) $responseArr['pt'];
        
        $this->assertSame('Português', $pt['language']);
        $this->assertArrayHasKey('aa', (array) $pt['versions']);      
        $this->assertArrayHasKey('acf', (array) $pt['versions']); 
        $this->assertArrayHasKey('nvi', (array) $pt['versions']);   
    }
}