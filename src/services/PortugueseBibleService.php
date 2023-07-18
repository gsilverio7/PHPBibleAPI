<?php

namespace API\Services;

class PortugueseBibleService extends BibleService
{
    protected $language = 'Português';
    protected $languageAbv = 'pt';
    protected $versions = [
        'aa' => 'Almeida Atualizada',
        'acf' => 'Almeida Corrigida Fiel',
        'nvi' => 'Nova Versão Internacional'
    ];
    protected $chapters = [
        'Gn' => 'Gênesis',
        'Ex' => 'Êxodo',
        'Lv' => 'Levítico',
        'Nm' => 'Números',
    ];
}