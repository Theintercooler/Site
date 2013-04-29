<?php

namespace Graphox\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Graphox\UserBundle\Form\Model\SingleEmailUser as User;

class Registration
{

    /**
     * @Assert\Type(type="Graphox\UserBundle\Form\Model\SingleEmailUser")
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }

}

