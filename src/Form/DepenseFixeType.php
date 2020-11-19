<?php

namespace App\Form;

use App\Entity\DepenseFixe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseFixeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleDepenseFixe')
            ->add('montantDepenseFixe')
            ->add('dateCompte')
            ->add('typeDepense')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DepenseFixe::class,
        ]);
    }
}
