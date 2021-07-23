<?php

namespace App\Form;

use App\Entity\Materiels;
use App\Entity\Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCourt')
            ->add('marque')
            ->add('prixPublic')
            ->add('referenceFabricant')
            ->add('commentaire')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiels::class,
        ]);
    }
}
