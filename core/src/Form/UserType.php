<?php

namespace App\Form;

use App\Entity\{User, Category};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType; 
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [

            ])
            ->add('lastname', TextType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [

            ])
            ->add('phone', TextType::class, [
                'required' => false,
            ])
            ->add('country', CountryType::class, [

            ])
            ->add('about', TextareaType::class, [
                'required' => false,
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Profile Image',
                'required' => false,
            ])
            ->add('password', PasswordType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('birthdate', BirthdayType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('category', EntityType::class, [
                'class'=> Category::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('workplace', TextType::class, [
                'required' => false,
            ])
            ->add('facebook', TextType::class, [
                'required' => false,
            ])
            ->add('linkedin', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}