<?php

namespace Backoffice\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="Address")
 * @ORM\Entity
 */
class Address
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
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=20, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=60, nullable=false)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip_code", type="integer", nullable=false)
     */
    private $zipCode;


}

