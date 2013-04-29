<?php

namespace Graphox\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use HireVoice\Neo4j\Annotation as OGM;

/**
 * @OGM\Entity()
 */
class Email
{

    /**
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     *
     * @var string
     *
     * @OGM\Property()
     * @Assert\Email()
     */
    protected $email;

    /**
     *
     *
     * @OGM\Property()
     * @OGM\Index()
     */
    protected $activationKey;

    /**
     *
     * @OGM\Property()
     * @OGM\Index()
     */
    protected $isActivated;

    /**
     *
     * @OGM\Property()
     * @OGM\Index()
     */
    protected $receiveNewsLetter;

    /**
     *
     * @OGM\Property()
     * @OGM\Index()
     */
    protected $isPrimary;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = (string) $email;
    }

    public function getActivationKey()
    {
        return $this->activationKey;
    }

    public function setActivationKey($key)
    {
        $this->activationKey = $key;
    }

    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;
    }

    public function setActivated()
    {
        $this->setIsActivated(true);
        $this->setActivationKey(null);
    }

    public function setNotActivated($key)
    {
        $this->setIsActivated(false);
        $this->setActivationKey($key);
    }

    public function getIsActivated()
    {
        return $this->isActivated;
    }

    public function isActivated()
    {
        return $this->getIsActivated();
    }

    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = (bool) $isPrimary;
    }

    public function isPrimary()
    {
        return $this->getIsPrimary();
    }

    public function setPrimary()
    {
        $this->setIsPrimary(true);
    }

    public function setNotPrimary()
    {
        $this->setIsPrimary(false);
    }

}
