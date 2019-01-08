<?php

namespace App\Form;

use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class,[
                'required' =>false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'prix max'
                ]
            ])
            ->add('minRoom', IntegerType::class,[
                'required' =>false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'peices minimum'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' =>'get',
            'csrf_protection'=> false
        ]);
    }
}