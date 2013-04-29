<?php

namespace Graphox\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username');
        $builder->add('email', new EmailType);
        $builder->add('password', 'repeated',
                array(
            'first_name' => 'password',
            'second_name' => 'confirm',
            'type' => 'password',
            'second_options' => array(
                'label' => 'Repeat password'
            )
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Graphox\UserBundle\Form\Model\SingleEmailUser'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}

