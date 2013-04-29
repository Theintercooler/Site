<?php

namespace Graphox\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AcceptType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('accept', 'checkbox');
    }

    public function getName()
    {
        return 'accept';
    }

}

