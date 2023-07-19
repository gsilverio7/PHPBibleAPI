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
        try {
            $biblePath = dirname(__FILE__, 2) . '/bibles' . '/' . $this->languageAbv . '/' . $version . '.json';

            if(! file_exists($biblePath)) {
                throw new \Exception('We do not have the version you requested.', 400);
            }

            $bible = Items::fromFile($biblePath);
        
            $selectedBook = null;
            $selectedBookIndex = 0;
            foreach ($bible as $bibleBook) {
                if ($bibleBook->abbrev == $book) {
                    $selectedBook = $bibleBook;
                    break;
                }
                $selectedBookIndex++;
            }
            
            if (is_null($selectedBook)) {
                throw new \Exception('The book informed does not exist.', 400);
            }
    
            $selectedBookChapters = $selectedBook->chapters;
            $selectedBookChaptersLength = count($selectedBookChapters);
    
            if ($chapter > $selectedBookChaptersLength) {
                throw new \Exception('The book you requested does not contain this chapter.', 400);
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
                throw new \Exception('The chapter you requested does not contain these verses.', 400);
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

        } catch (\Exception $e) {
            http_response_code($e->getCode());
            $response = [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ];
            
            return json_encode($response, JSON_UNESCAPED_UNICODE);
        }
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
            $groupLimits = explode('-', $group);

            $start = intval($groupLimits[0]);
            if ($start == 0) {
                break;
            }

            $end = intval($groupLimits[count($groupLimits) - 1]);
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