<?php

namespace DoJa\Bundle\WordsBundle\Entity;

class Translation
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
     * @var string
     */
    protected $translation;

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
    public function setWord(Word $word)
    {
        $this->word = $word;
    }

    /**
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param string $translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
    }
}