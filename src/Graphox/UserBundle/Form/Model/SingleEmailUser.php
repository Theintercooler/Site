<?php

namespace Graphox\
UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Graphox\UserBundle\Entity\Email;

/**
 * During registration the user is only allowed to enter one email adress.
 */
class SingleEmailUser
{

    /**
     * @Assert\NotBlank()
     */
    protected $username;

    /**
     * @Assert\Valid()
     * @Assert\Type(type="Graphox\UserBundle\Entity\Email")
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     */
    protected $password;

    public function setUsername($name)
    {
        $this->username = $name;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = (string) $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

}
