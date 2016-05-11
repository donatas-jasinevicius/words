<?php

namespace DoJa\Bundle\WordsBundle\Service;

use Doctrine\ORM\EntityManager;
use DoJa\Bundle\WordsBundle\Entity\WordsList;

class WordsListManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function saveWordsList(WordsList $wordsList)
    {
        $this->entityManager->persist($wordsList);

        return $wordsList;
    }

    public function deleteWordsList(WordsList $wordsList)
    {
        $this->entityManager->remove($wordsList);

        return $wordsList;
    }
}