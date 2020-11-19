<?php

namespace App\Form;

use App\Entity\DepenseAnnexe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseAnnexeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleDepenseAnnexe')
            ->add('montantDepenseAnnexe')
            ->add('dateCompte')
            ->add('dateDebDepenseAnnexe')
            ->add('dateFinDepenseAnnexe')
            ->add('typeDepense')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DepenseAnnexe::class,
        ]);
    }
}
