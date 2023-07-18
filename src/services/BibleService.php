<?php

namespace API\Services;

use JsonMachine\Items;

abstract class BibleService
{
    protected $language = 'LanguageName';
    protected $languageAbv = 'ln';
    protected $versions = [
        'bv' => 'Bible Version',
        'abv' => 'Another Bible Version'
    ];
    protected $chapters = [
        'Genesis',
        'Exodus',
        //...
    ];     
    

    public function getVerses(string $version, string $book, int $chapter, string $verses)
    {
        $bible = Items::fromFile(dirname(__FILE__, 2) . '/bibles' . '/' . $this->languageAbv . '/' . $version . '.json');
        
        $selectedBook = null;
        foreach ($bible as $bibleBook) {
            if ($bibleBook->abbrev == $book) {
                $selectedBook = $bibleBook;
                break;
            }
        }
        
        if (is_null($selectedBook)) {
            return 'couldnt find that book';
        }

        $selectedBookChapters = $selectedBook->chapters;
        $selectedBookChaptersLength = count($selectedBookChapters);

        if ($chapter > $selectedBookChaptersLength) {
            return 'that book doesnt have this chapter';
        }

        $i = 0;
        foreach ($selectedBookChapters as $bookChapter) {
            if ($i === $chapter - 1) {
                $selectedChapter = $bookChapter;
                break;
            }
            $i++;
        }
        var_dump($selectedChapter);
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