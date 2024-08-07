<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Comedien;
use App\Entity\Spectacle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComedienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comedien::class,
        ]);
    }
}
