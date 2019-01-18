<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('rooms')
            ->add('floor')
            ->add('price')
            ->add('surface')
            ->add('heat')
            ->add('city')
            ->add('address')
            ->add('zipCode')
            ->add('sold')
            ->add('imageFile', FileType::class,[
                'required' => false
            ])
            ->add('options', EntityType::class,[
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple'=> true
            ])
//            ->add('created_at')
          //  ->add('expiresAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
