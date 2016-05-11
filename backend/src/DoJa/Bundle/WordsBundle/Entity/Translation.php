<?php

namespace DoJa\Bundle\WordsBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Translation
{
    /**
     * @var int
     */
    protected $id;

    //todo: sudet validacija visur
    /**
     * @var Word
     */
    protected $word;

    /**
     * @var string
     * @Assert\NotBlank()
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