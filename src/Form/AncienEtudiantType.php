<?php

namespace App\Form;

use App\Entity\AncienEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncienEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('anneeSortie')
            ->add('posteOccuper')
            ->add('user')
            ->add('Filiere')
            ->add('diplome')
            ->add('contrat')
            ->add('statut')
            //->add('statistique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AncienEtudiant::class,
        ]);
    }
}
  