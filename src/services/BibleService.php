<?php

abstract class BibleController
{
    protected $lang = 'LanguageName';
    protected $versions = [
        'bv' => [
            'name' => 'Bible Version',
            'src' => ''
        ],
        'abv' => [
            'name' => 'Another Bible Version',
            'src' => ''
        ]
    ];
    protected $chapters = array(); 

    public function getVerses($version, $chapter, $verses)
    {
        
    }

    public function getLanguage()
    {
        return $this->lang;
    }

    public function getVersions()
    {
        return $this->versions;
    }
}