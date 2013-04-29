<?php

namespace Graphox\BlogBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;

/**
 * @OGM\Entity(repositoryClass="Graphox\BlogBundle\Entity\EnquiryRepository")
 */
class Enquiry
{

    /**
     * The id
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * The name the othe user
     * @var string
     *
     * @OGM\Index()
     * @OGM\Property()
     */
    protected $name;

    /**
     * The email adress of the user
     * @var string
     *
     * @OGM\Index()
     * @OGM\Property()
     */
    protected $email;

    /**
     * The subject of the enquiry.
     * @var string
     *
     * @OGM\Index()
     * @OGM\Property()
     */
    protected $subject;

    /**
     * The subject of the body
     * @var string
     *
     * @OGM\Property()
     */
    protected $body;

    /**
     * Time this object was created
     * @var \DateTime
     *
     * @OGM\Property(format="date")
     */
    protected $createDate;

    public function __construct()
    {
        $this->createDate = new \DateTime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

}

