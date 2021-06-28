<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label'=>'prénom'])
            ->add('lastname', TextType::class, ['label' => 'nom'])
            ->add('phone', TextType::class, ['label' => 'numéro de téléphone'])
            ->add('email', TextType::class, ['label' => 'adresse e-mail'])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'début de séjour'
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'fin de séjour'
            ])
            ->add('message', TextareaType::class, ['label' => 'message'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
            ]);
    }
}
