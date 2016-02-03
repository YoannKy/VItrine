<?php

namespace Backoffice\Entity;

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
     * @var \Backoffice\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Backoffice\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Backoffice\Entity\Address
     *
     * @ORM\ManyToOne(targetEntity="Backoffice\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;


}

