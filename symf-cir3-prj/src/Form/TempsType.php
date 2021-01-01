<?php

namespace App\Form;

use App\Entity\Temps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TempsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('temps')
            ->add('palier15')
            ->add('palier12')
            ->add('palier9')
            ->add('palier6')
            ->add('palier3')
            ->add('est_a')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Temps::class,
        ]);
    }
}
