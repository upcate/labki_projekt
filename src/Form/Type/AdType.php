<?php

namespace App\Form\Type;

use App\Entity\Ad;
use App\Entity\AdCategory;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
          'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => 'true',
                'attr' => ['max_length' => 255]
            ]);
        $builder->add(
          'username',
            TextType::class,
            [
                'label' => 'label.username',
                'required' => 'true',
                'attr' => ['max_length' => 255]
            ]);
        $builder->add(
          'email',
          EmailType::class,
          [
              'label' => 'label.email',
              'required' => 'true',
              'attr' => ['max_length' => 255]
          ]);
        $builder->add(
          'phone',
          TextType::class,
          [
              'label' => 'label.phone',
              'required' => 'true',
              'attr' => ['max_length' => 255]
          ]);
        $builder->add(
          'text',
          TextType::class,
          [
              'label' => 'label.text',
              'required' => 'true',
              'attr' => ['max_length' => 255]
          ]);
        $builder->add(
          'adCategory',
          EntityType::class,
          [
              'class' => AdCategory::class,
              'choice_label' => function($adCategory): string {
                return $adCategory->getName();
              },
              'label' => 'label.category',
              'placeholder' => 'label.none',
              'required' => 'true',
          ]);
        $builder->add(
          'is_visible',
          HiddenType::class,
          [
              'empty_data' => 0
          ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Ad::class]);
    }

    public function getBlockPrefix(): string
    {
        return 'ad';
    }

}