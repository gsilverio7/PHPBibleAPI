<?php

namespace API\Services;

class PortugueseBibleService extends BibleService
{
    protected $lang = 'Português';
    protected $chapters = [
        'Gn' => 'Gênesis',
        'Ex' => 'Êxodo',
        'Lv' => 'Levítico',
        'Nm' => 'Números',
    ];
}