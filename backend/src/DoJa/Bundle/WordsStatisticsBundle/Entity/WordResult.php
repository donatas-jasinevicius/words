<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Entity;

use DoJa\Bundle\WordsBundle\Entity\Word;

class WordResult
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Word
     */
    protected $word;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $correctCount;

    /**
     * @var int
     */
    protected $incorrectCount;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Word
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param Word $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getCorrectCount()
    {
        return $this->correctCount;
    }

    /**
     * @param int $correctCount
     */
    public function setCorrectCount($correctCount)
    {
        $this->correctCount = $correctCount;
    }

    /**
     * @return int
     */
    public function getIncorrectCount()
    {
        return $this->incorrectCount;
    }

    /**
     * @param int $incorrectCount
     */
    public function setIncorrectCount($incorrectCount)
    {
        $this->incorrectCount = $incorrectCount;
    }
}