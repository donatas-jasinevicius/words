<?php

namespace DoJa\Bundle\WordsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WordFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id');
        $builder->add('original');
        $builder->add('translations', CollectionType::class, array(
            'entry_type' => TranslationFormType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DoJa\Bundle\WordsBundle\Entity\Word',
        ));
    }
}