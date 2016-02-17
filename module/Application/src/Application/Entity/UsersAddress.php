<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersAddress
 *
 * @ORM\Table(name="Users_address", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="address_id", columns={"address_id"})})
 * @ORM\Entity
 */
class UsersAddress
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Application\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Application\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;



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
     * Set user
     *
     * @param \Application\Entity\Users $user
     *
     * @return UsersAddress
     */
    public function setUser(\Application\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set address
     *
     * @param \Application\Entity\Address $address
     *
     * @return UsersAddress
     */
    public function setAddress(\Application\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Application\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }
}
