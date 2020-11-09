<?php

namespace App\Form;

use App\Entity\PieceIdentite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceIdentiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices' => [
                    'Cin' => 'CIN',
                    'Passport' => 'PASSPORT'
                ]
            ))
            ->add('identifiant')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('personne')
            ->add('edit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PieceIdentite::class,
        ]);
    }
}
