<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Service;

use Doctrine\ORM\EntityManager;
use DoJa\Bundle\WordsStatisticsBundle\Entity\WordsListResults;

class WordsListResultsManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function saveWordsList(WordsListResults $wordsListResults)
    {
        foreach ($wordsListResults->getWordsResults() as $wordResult) {
            $this->entityManager->persist($wordResult);
        }

        return $wordsListResults;
    }
}
