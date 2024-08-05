<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Comedien;
use App\Entity\Spectacle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('nbCategorie', IntegerType::class)
            ->add('categories', EntityType::class,
                [
                    'class' => Categorie::class,
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true
                ])
            ->add('comediens', EntityType::class,
                [
                'class' => Comedien::class,
                'choice_label' => 'prenom',
                'multiple' => true,
                'expanded' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Spectacle::class,
        ]);
    }
}
