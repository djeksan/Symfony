<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserType
 *
 * @ORM\Table(name="user_type")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\UserTypeRepository")
 */
class UserType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_type", type="string", length=255)
     */
    private $userType;

    /**
     * @var string
     *
     * @ORM\Column(name="user_desc", type="string", length=255)
     */
    private $userDesc;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userType
     *
     * @param string $userType
     *
     * @return UserType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set userDesc
     *
     * @param string $userDesc
     *
     * @return UserType
     */
    public function setUserDesc($userDesc)
    {
        $this->userDesc = $userDesc;

        return $this;
    }

    /**
     * Get userDesc
     *
     * @return string
     */
    public function getUserDesc()
    {
        return $this->userDesc;
    }
}

