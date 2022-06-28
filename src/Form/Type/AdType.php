<?php

/**
 * AdType.
 */

namespace App\Form\Type;

use App\Entity\Ad;
use App\Entity\AdCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdType.
 */
class AdType extends AbstractType
{
    /**
     * Build Form.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => 'true',
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'username',
            TextType::class,
            [
                'label' => 'label.username',
                'required' => 'true',
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'email',
            EmailType::class,
            [
              'label' => 'label.email',
              'required' => 'true',
              'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'phone',
            TextType::class,
            [
              'label' => 'label.phone',
              'required' => 'true',
              'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'text',
            TextType::class,
            [
              'label' => 'label.text',
              'required' => 'true',
              'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'adCategory',
            EntityType::class,
            [
              'class' => AdCategory::class,
              'choice_label' => function ($adCategory): string {
                  return $adCategory->getName();
              },
              'label' => 'label.category',
              'placeholder' => 'label.none',
              'required' => 'true',
            ]
        );
    }

    /**
     * Configure options.
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Ad::class]);
    }

    /**
     * Get block prefix.
     *
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'ad';
    }
}
