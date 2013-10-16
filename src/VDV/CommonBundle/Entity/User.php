<?php

namespace VDV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Entity(repositoryClass="VDV\CommonBundle\Entity\UserGroup")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firstname", type="string", length=255)
	 */
	private $firstname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lastname", type="string", length=255)
	 */
	private $lastname;

	/**
	 * @var UserGroup
	 *
	 * @ORM\ManyToOne(targetEntity="UserGroup")
	 * @ORM\JoinColumn(name="user_group_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $userGroup;


	public function __toString()
	{
		return ($this->firstname) ? $this->firstname . ' ' . $this->lastname : 'New User';
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set userGroup
     *
     * @param \VDV\CommonBundle\Entity\UserGroup $userGroup
     * @return User
     */
    public function setUserGroup(\VDV\CommonBundle\Entity\UserGroup $userGroup = null)
    {
        $this->userGroup = $userGroup;

        return $this;
    }

    /**
     * Get userGroup
     *
     * @return \VDV\CommonBundle\Entity\UserGroup
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }
}

/**
 * UserGroup
 */
class UserGroup extends EntityRepository {

    public function getAdmin()
    {
        return $this->getEntityManager()
            ->createQuery('select * from users where users_groups_id = 1')
            ->getResults;
    }
}