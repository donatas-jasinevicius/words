<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Form;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Form\Transformer\EntityToIdObjectTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WordsListResultsFormType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $wordsListTransformer = new EntityToIdObjectTransformer($this->entityManager, "WordsBundle:WordsList");

        $builder->add($builder->create('words_list', TextType::class)->addModelTransformer($wordsListTransformer));
        $builder->add('words_results', CollectionType::class, array(
            'entry_type' => WordResultFormType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoJa\Bundle\WordsStatisticsBundle\Entity\WordsListResults'
        ));
    }
}