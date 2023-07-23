<?php

use PHPUnit\Framework\TestCase;
use BibleAPI\Controllers\BibleController;

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

    public function testMultipleVerses(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '1,3,5');
        
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
                ],
                [
                    'verse' => 3,
                    'text' => 'Disse Deus: haja luz. E houve luz.'
                ],
                [
                    'verse' => 5,
                    'text' => 'E Deus chamou à luz dia, e às trevas noite. E foi a tarde e a manhã, o dia primeiro.'
                ]
            ]
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testVerseInterval(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '1-3');
        
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
                ],
                [
                    'verse' => 2,
                    'text' => 'A terra era sem forma e vazia; e havia trevas sobre a face do abismo, mas o Espírito de Deus pairava sobre a face das águas.'
                ],
                [
                    'verse' => 3,
                    'text' => 'Disse Deus: haja luz. E houve luz.'
                ]
            ]
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testMultipleVerseIntervals(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '1-3,6-8');
        
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
                ],
                [
                    'verse' => 2,
                    'text' => 'A terra era sem forma e vazia; e havia trevas sobre a face do abismo, mas o Espírito de Deus pairava sobre a face das águas.'
                ],
                [
                    'verse' => 3,
                    'text' => 'Disse Deus: haja luz. E houve luz.'
                ],
                [
                    'verse' => 6,
                    'text' => 'E disse Deus: haja um firmamento no meio das águas, e haja separação entre águas e águas.'
                ],
                [
                    'verse' => 7,
                    'text' => 'Fez, pois, Deus o firmamento, e separou as águas que estavam debaixo do firmamento das que estavam por cima do firmamento. E assim foi.'
                ],
                [
                    'verse' => 8,
                    'text' => 'Chamou Deus ao firmamento céu. E foi a tarde e a manhã, o dia segundo.'
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

    public function testWrongLanguage(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('xxyz', 'aa', 'gn', 1);
        
        $expectedResponse = [
            'error' => 'We do not have this language available.',
            'code' => 400
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertEquals(400, http_response_code());        
        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testWrongVersion(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'xxyz', 'gn', 1);
        
        $expectedResponse = [
            'error' => 'We do not have the version you requested.',
            'code' => 400
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertEquals(400, http_response_code());        
        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }
    
    public function testWrongBook(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'zz', 1);
        
        $expectedResponse = [
            'error' => 'The book informed does not exist.',
            'code' => 400
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertEquals(400, http_response_code());        
        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testWrongChapter(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 199);
        
        $expectedResponse = [
            'error' => 'The book you requested does not contain this chapter.',
            'code' => 400
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertEquals(400, http_response_code());        
        $this->assertJsonStringEqualsJsonString($expectedResponse, $response);
    }

    public function testWrongVerse(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '199');
        
        $expectedResponse = [
            'error' => 'The chapter you requested does not contain these verses.',
            'code' => 400
        ];
        $expectedResponse = json_encode($expectedResponse, JSON_UNESCAPED_UNICODE);

        $this->assertEquals(400, http_response_code());        
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