<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use API\Controllers\BibleController;

final class BibleControllerTest extends TestCase
{
    public function testSingleVerse(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->getVerses('pt', 'aa', 'gn', 1, '1');
        $this->assertSame("[
            'info' => [
                'language' => 'Português',
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
        ]", $response);
    }

    public function testShowInfo(): void
    {
        $bibleController = new BibleController;
        $response = $bibleController->showInfo();
        $this->assertSame("[
            'pt' => [
                'language' => 'Português',
                'versions' => [
                    'aa' => 'Almeida Atualizada',
                    'acf' => 'Almeida Corrigida e Fiel',
                    'nvi' => 'Nova Versão Internacional'
                ]
            ],
            'en' => [
                'language' => 'English',
                'versions' => [
                    'bbe' => 'Basic Bible English',
                    'kjv' => 'King James Version'
                ]
            ]
        ]", $response);        
    }
}