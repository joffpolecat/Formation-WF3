<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('title', null, array(
                'label' => 'Titre'
            ))

            -> add('categories', null, array( // EntityType
                'label' => 'category.category',
                'choice_label' => 'name',
                'expanded' => true,
                'expanded' => true,
                'query_builder' => function(EntityRepository $er)
                {
                    return $er  -> createQueryBuilder('c')
                                -> orderBy('c.name', 'ASC');
                }
            ))

            -> add('image', ImageType::class)

            -> add('deleteImage', CheckboxType::class, array(
                // 'mapped' => false,
                'required' => false
            ))

            -> add('content', null, array(
                'label' => 'Contenu',
                'attr' => array(
                    'class' => 'tinymce'
                )
            ))
        ;
    }
}