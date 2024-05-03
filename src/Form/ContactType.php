<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom*',
                'label_attr' => ['class' => "block mb-2 text-m font-semibold"],
                'attr' => ['class' => "shadow-sm bg-gray-50 border border-gray-300 text-m rounded-lg focus:ring-gray-900 focus:ring-gray-900 block w-full p-2.5",
                            'placeholder' => "Votre prénom ici"
                        ],
                'required' => true
            ])
            ->add('nom', TextType::class, [
                'label' => 'Votre nom*',
                'label_attr' => ['class' => "block mb-2 text-m font-medium font-semibold"],
                'attr' => ['class' => "shadow-sm bg-gray-50 border border-gray-300 text-m rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5",
                            'placeholder' => "Votre nom ici"
                    ],
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email*',
                'label_attr' => ['class' => "block mb-2 text-m font-semibold"],
                'attr' => ['class' => "shadow-sm bg-gray-50 border border-gray-300 text-m rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5",
                            'placeholder' => 'votre@email.com'
                        ],
                'constraints' => [
                            new NotBlank([
                                'message' => "J'ai besoin de votre email pour vous répondre"
                            ])
                        ],
                'required' => true,
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'Choississez un sujet de contact*',
                'label_attr' => ['class' => "block mb-2 text-m font-semibold"],
                'attr' => ['class' => "bg-gray-50 border border-gray-300 text-m rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"],
                'choices'  => [
                    "Conception d'identité visuelle" => "Conception d'identité visuelle",
                    "Logo" => "Logo",
                    "Flyers" => "Flyers",
                    "Cartes de visites" => "Cartes de visites",
                    "Packagings" => "Packagings",
                    "Autre" => "Autre",
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message*',
                'label_attr' => ['class' => "block mb-2 text-m font-semibold"],
                'attr' => ['class' => "block p-2.5 w-full h-28 text-m text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500",
                            'placeholder' => 'Votre message ici'
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => "J'ai besoin de connaitre votre projet"
                    ])
                ],
                'required' => true,
            ])
            // ->add('submit', SubmitType::class, [
            //     'attr' => ['class' => "text-white bg-gray-900 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-m px-5 py-2.5 mr-2 mb-2"]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
