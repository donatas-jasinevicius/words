<?php

namespace DoJa\Bundle\WordsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class Word
{
    /**
     * @var int
     * @JMS\Groups({"main", "all"})
     */
    protected $id;

    /**
     * @var WordsList
     * @JMS\Groups({"all"})
     */
    protected $wordsList;

    /**
     * @var string
     * @JMS\Groups({"all"})
     */
    protected $original;

    /**
     * @var Translation[]
     * @JMS\Groups({"all"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * @return WordsList
     */
    public function getWordsList()
    {
        return $this->wordsList;
    }

    /**
     * @param WordsList $wordsList
     */
    public function setWordsList(WordsList $wordsList)
    {
        $this->wordsList = $wordsList;
    }

    /**
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * @param string $original
     */
    public function setOriginal($original)
    {
        $this->original = $original;
    }

    /**
     * @return array
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param Translation[] $translations
     */
    public function setTranslations($translations)
    {
        $this->translations->clear();

        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
    }

    /**
     * @param Translation $translation
     */
    public function addTranslation(Translation $translation)
    {
        $translation->setWord($this);

        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
        }
    }

    /**
     * @param Translation $translation
     */
    public function removeTranslation(Translation $translation)
    {
        $this->translations->removeElement($translation);
    }
}