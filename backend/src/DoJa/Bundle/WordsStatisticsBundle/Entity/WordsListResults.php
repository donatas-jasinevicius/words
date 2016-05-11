<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Entity;

use DoJa\Bundle\WordsBundle\Entity\WordsList;

class WordsListResults
{
    /**
     * @var WordsList
     */
    protected $wordsList;

    /**
     * @var WordResult[]
     */
    protected $wordsResults;

    /**
     * @return WordsList
     */
    public function getWordsList()
    {
        return $this->wordsList;
    }

    /**
     * @param WordsList $wordsList
     *
     * @return WordsListResults
     */
    public function setWordsList($wordsList)
    {
        $this->wordsList = $wordsList;

        return $this;
    }

    /**
     * @return WordResult[]
     */
    public function getWordsResults()
    {
        return $this->wordsResults;
    }

    /**
     * @param WordResult[] $wordsResults
     *
     * @return WordsListResults
     */
    public function setWordsResults($wordsResults)
    {
        $this->wordsResults = [];

        foreach ($wordsResults as $wordResult) {
            $this->addWordResult($wordResult);
        }

        return $this;
    }

    /**
     * @param WordResult $wordResult
     *
     * @return WordsListResults
     */
    public function addWordResult(WordResult $wordResult)
    {
        if (!in_array($wordResult, $this->wordsResults)) {
            $this->wordsResults[] = $wordResult;
        }

        return $this;
    }
    /**
     * @param WordResult $wordResult
     *
     * @return WordsListResults
     */
    public function removeWordResult(WordResult $wordResult)
    {
        $key = array_search($wordResult, $this->wordsResults);
        if ($key !== false) {
            unset($this->wordsResults[$key]);
        }
    }
}