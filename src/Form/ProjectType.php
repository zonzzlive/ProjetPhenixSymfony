<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Status;
use App\Repository\StatusRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('endedAt')
            ->add('createdAt')
            ->add('code')
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'nameStatus',
            ])
        ;
    }

    public function __toString()
    {
        return $this->Status;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
