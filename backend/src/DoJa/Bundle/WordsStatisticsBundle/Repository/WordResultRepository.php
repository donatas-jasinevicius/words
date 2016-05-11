<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DoJa\Bundle\WordsBundle\Entity\Word;
use DoJa\Bundle\WordsStatisticsBundle\Entity\WordResult;

class WordResultRepository extends EntityRepository
{
    /**
     * @param Word[] $words
     *
     * @return WordResult[]
     */
    public function findByWords($words)
    {
        return $this->createQueryBuilder('ws')
            ->andWhere('ws.word IN (:words)')
            ->setParameters([
                'words' => $words
            ])
            ->getQuery()
            ->getResult()
        ;
    }
}