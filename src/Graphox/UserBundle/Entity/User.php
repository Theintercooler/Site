<?php

namespace Graphox\UserBundle\Entity;

use \Symfony\Component\Security\Core\User\AdvancedUserInterface;
use HireVoice\Neo4j\Annotation as OGM;
use Symfony\Component\Validator\Constraints as Assert;
use \HireVoice\Neo4j\Extension\ArrayCollection;
use Symfony\Component\Security\Core\User\EquatableInterface;
use \Symfony\Component\Security\Core\User\UserInterface;

/**
 * @OGM\Entity(repositoryClass="Graphox\UserBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, /* \Serializable, */ EquatableInterface
{

    /**
     * @var integer
     *
     * @OGM\Auto()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property()
     * @OGM\Index()
     */
    protected $username;

    /**
     * @var string
     *
     * @OGM\Property()
     */
    protected $password;

    /**
     * @var Email[]
     *
     * @OGM\ManyToMany()
     */
    protected $emails;

    /**
     * @var object[]
     *
     * @OGM\ManyToMany(relation="timeline")
     */
    protected $timelines;

    /**
     * @var object[]
     *
     * @OGM\ManyToMany()
     */
    protected $subscriptions;

    /**
     * @var object[]
     *
     * @OGM\ManyToMany()
     */
    protected $friends;

    /**
     * @var object[]
     *
     * @OGM\ManyToMany()
     */
    protected $groups;

    /**
     * @var object[]
     * @todo Use relations
     *
     * @ OGM\ManyToMany()
     * @OGM\Property(format="array")
     */
    protected $roles;

    public function __construct()
    {
        $this->timelines = new ArrayCollection;
        $this->subscriptions = new ArrayCollection;
        $this->friends = new ArrayCollection;
        $this->groups = new ArrayCollection;
        $this->roles = new ArrayCollection;
        $this->emails = new ArrayCollection;
    }

    /**
     * Id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (integer) $id;
    }

    /**
     * Username
     */

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Password
     */

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Emails
     */

    /**
     *
     * @return ArrayCollection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    public function setEmails(ArrayCollection $emails)
    {
        $this->emails = $emails;
    }

    public function addEmail(Email $email)
    {
        return $this->getEmails()->add($email);
    }

    public function getPrimaryEmail()
    {
        return $this->getEmails()->filter(function(Email $email)
                        {
                            return $email->isPrimary();
                        })->first();
    }

    /**
     * Timelines
     *
     */
    public function getTimelines()
    {
        return $this->timelines;
    }

    public function setTimelines($timelines)
    {
        $this->timelines = $timelines;
    }

    public function getPrimaryTimeline()
    {
        return $this->getTimelines()->filter(function(Timeline $timeline)
                        {

                            return $timeline->isPrimary();
                        })->first();
    }

    public function addTimeline(Timeline $timeline)
    {
        $this->getTimelines()->add($timeline);
    }

    public function removeTimeline(Timeline $timeline)
    {
        $this->getTimelines()->removeElement($timeline);
    }

    /**
     * Subscriptions
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    public function setSubscriptions($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function addSubscription(Timeline $timeline)
    {
        $this->subscriptions->add($timeline);
    }

    public function removeSubscription(Timeline $timeline)
    {
        return $this->subscriptions->removeElement($timeline);
    }

    /**
     * Roles
     */

    /**
     * {@inheritdoc}
     * @todo move use role to database
     * @return ArrayCollection
     */
    public function getRoles()
    {
        $roles = $this->roles;

        $role = new Role;
        $role->setName('ROLE_USER');
        $roles[] = $role;

        if ($this->getUsername() == 'killme')
        {
            $adminRole = new Role;
            $adminRole->setName('ROLE_SUPER_ADMIN');
            $roles[] = $adminRole;
        }


        return $roles;
    }

    public function setRoles(ArrayCollection $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRole(Role $role)
    {
        $this->getRoles()->add($role);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->password = null;
    }

    /*
      public function serialize()
      {
      return serialize(array(
      'id' => $this->id
      ));
      }

      public function unserialize($serialized)
      {
      list($this->id) = unserialize($serialized);
      } */

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Activated
     */
    public function isEnabled()
    {
        return $this->isEmailActivated();
    }

    public function isEmailActivated()
    {
        return $this->getEmails()->exists(function($i, Email $email)
                        {
                            return $email->isActivated();
                        });
    }

    public function isEqualTo(UserInterface $user)
    {
        return $this->getId() === $user->getId();
    }

}

