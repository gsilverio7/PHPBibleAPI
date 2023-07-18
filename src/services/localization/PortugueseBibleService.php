<?php

namespace API\Services\Localization;

use API\Services\BibleService;

class PortugueseBibleService extends BibleService
{
    protected $language = 'Português';
    protected $languageAbv = 'pt';
    protected $versions = [
        'aa' => 'Almeida Atualizada',
        'acf' => 'Almeida Corrigida Fiel',
        'nvi' => 'Nova Versão Internacional'
    ];
    protected $books = [
        'Gênesis',
        'Êxodo',
        'Levítico',
        'Números',
        'Deuteronômio',
        'Josué',
        'Juízes',
        'Rute',
        '1 Samuel',
        '2 Samuel',
        '1 Reis',
        '2 Reis',
        '1 Crônicas',
        '2 Crônicas',
        'Esdras',
        'Neemias',
        'Ester',
        'Jó',
        'Salmos',
        'Provérbios',
        'Eclesiastes',
        'Cantares',
        'Isaías',
        'Jeremias',
        'Lamentações',
        'Ezequiel',
        'Daniel',
        'Oseias',
        'Joel',
        'Amós',
        'Obadias',
        'Jonas',
        'Miqueias',
        'Naum',
        'Habacuque',
        'Sofonias',
        'Ageu',
        'Zacarias',
        'Malaquias',
        'Mateus',
        'Marcos',
        'Lucas',
        'João',
        'Atos dos Apóstolos',
        'Romanos',
        '1 Coríntios',
        '2 Coríntios',
        'Gálatas',
        'Efésios',
        'Filipenses',
        'Colossenses',
        '1 Tessalonicenses',
        '2 Tessalonicenses',
        '1 Timóteo',
        '2 Timóteo',
        'Tito',
        'Filemom',
        'Hebreus',
        'Tiago',
        '1 Pedro',
        '2 Pedro',
        '1 João',
        '2 João',
        '3 João',
        'Judas',
        'Apocalipse'
    ];
}