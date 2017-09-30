<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'USER_EMAIL',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'USER_PASSWORD',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('remember_me', CheckboxType::class, ['label' => 'USER_REMEMBER_ME'])
            ->add('login', SubmitType::class, ['label' => 'USER_LOGIN']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_token_id' => 'authenticate',
            'translation_domain' => 'user',
        ]);
    }
}
