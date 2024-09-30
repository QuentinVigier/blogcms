<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Label;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
        ])
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('image', FileType::class)
            ->add('isPublished', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('category', CategoryType::class, [
                'label' => 'Créer une nouvelle Catégorie ?',
            ])
            ->add('labels', EntityType::class, [
                'class' => Label::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'id',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
