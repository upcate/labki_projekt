<?php

namespace App\Form\Type;

use App\Entity\AdCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
          'name',
          TextType::class,
            [
                'label'=>'label.name',
                'required'=>true,
                'attr'=>['max_length'=> 64],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class'=>AdCategory::class]);
    }

    public function getBlockPrefix(): string
    {
        return 'adCategory';
    }

}