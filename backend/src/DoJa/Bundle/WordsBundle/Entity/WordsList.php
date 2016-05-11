<?php

namespace DoJa\Bundle\WordsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

class WordsList
{
    /**
     * @var int
     * @JMS\Groups({"main", "all"})
     */
    protected $id;

    /**
     * todo: move to xml
     * @var string
     * @Assert\NotBlank()
     * @JMS\Groups({"all"})
     */
    protected $name;

    /**
     * @var Word[]
     * @Assert\Valid()
     * @JMS\Groups({"all"})
     */
    protected $words;

    public function __construct()
    {
        $this->words = new ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Word[]
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @param Word $word
     *
     * @return Word
     */
    public function addWord(Word $word)
    {
        $word->setWordsList($this);

        if (!$this->words->contains($word)) {
            $this->words->add($word);
        }
    }

    /**
     * @param Word $word
     *
     * @return Word
     */
    public function removeWord(Word $word)
    {
        return $this->words->removeElement($word);
    }

    /**
     * @param Word[] $words
     */
    public function setWords($words)
    {
        $this->words->clear();

        foreach ($words as $word) {
            $this->addWord($word);
        }
    }
}