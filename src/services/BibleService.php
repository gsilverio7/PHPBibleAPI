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
    protected $books = [
        'Genesis',
        'Exodus',
        //...
    ];     
    

    public function getVerses(string $version, string $book, int $chapter, string $verses)
    {
        $bible = Items::fromFile(dirname(__FILE__, 2) . '/bibles' . '/' . $this->languageAbv . '/' . $version . '.json');
        
        $selectedBook = null;
        $selectedBookIndex = 1;
        foreach ($bible as $bibleBook) {
            if ($bibleBook->abbrev == $book) {
                $selectedBook = $bibleBook;
                break;
            }
            $selectedBookIndex++;
        }
        
        if (is_null($selectedBook)) {
            return 'couldnt find that book';
        }

        $selectedBookChapters = $selectedBook->chapters;
        $selectedBookChaptersLength = count($selectedBookChapters);

        if ($chapter > $selectedBookChaptersLength) {
            return 'that book doesnt have this chapter';
        }

        $i = 1;
        foreach ($selectedBookChapters as $bookChapter) {
            if ($i === $chapter) {
                $selectedChapter = $bookChapter;
                break;
            }
            $i++;
        }

        $selectedVerses = [];        
        $versesFilter = $this->createFilter($verses);
        
        $i = 1;
        foreach ($selectedChapter as $selectedChapterVerse) {
            if (in_array($i, $versesFilter) || empty($versesFilter)) {
                array_push(
                    $selectedVerses,
                    [
                        'verse' => $i,
                        'text' => $selectedChapterVerse
                    ] 
                );
            }

            $i++;
        }

        if (empty($selectedVerses)) {
            return 'that book doesnt have these verses';
        }

        $response = [
            'info' => [
                'language' => $this->language,
                'version' => $this->versions[$version] ?? $version,
                'book' => $this->books[$selectedBookIndex] ?? $book,
                'chapter' => $chapter
            ],
            'verses' => $selectedVerses
        ];

        return json_encode($response, JSON_UNESCAPED_UNICODE);

        //verificar funcionamento correto dos filtros
        //verificar retorno correto do texto dos versiculos (backslashes nvi)
        //se nao informar versiculos retornar todo o livro
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getVersions()
    {
        return $this->versions;
    }

    private function createFilter(string $verses): array 
    {
        $filters = [];
        if (empty($verses)) {
            return $filters;
        }

        $groups = explode(',', $verses);
        foreach ($groups as $group) {
            $start = intval(substr($group, 0));
            if ($start == 0) {
                break;
            }

            $end = intval(substr($group, strlen($group) - 1));
            if ($end == 0) {
                break;
            }

            foreach (range($start, $end) as $number) {
                array_push($filters, $number);
            }
        }

        return array_unique($filters);
    }
}