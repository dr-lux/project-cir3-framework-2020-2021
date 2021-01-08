<?php

namespace App\Form;

use App\Entity\DefaultParam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DefaultParamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meanBreath')
            ->add('speedFalling')
            ->add('speedRisingBeforeBearing')
            ->add('speedRisingBetweenBearing')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DefaultParam::class,
        ]);
    }
}
