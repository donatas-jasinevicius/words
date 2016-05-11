<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Form;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Form\Transformer\EntityToIdObjectTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WordResultFormType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $wordsListTransformer = new EntityToIdObjectTransformer($this->entityManager, "WordsBundle:Word");
        $builder->add($builder->create('word', TextType::class)->addModelTransformer($wordsListTransformer));
        $builder->add('correct_count', NumberType::class);
        $builder->add('incorrect_count', NumberType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoJa\Bundle\WordsStatisticsBundle\Entity\WordResult'
        ));
    }
}