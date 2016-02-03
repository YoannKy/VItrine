<?php

namespace Backoffice\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wishlists
 *
 * @ORM\Table(name="Wishlists", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Wishlists
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
     * @ORM\Column(name="order_list", type="string", length=60, nullable=false)
     */
    private $orderList;

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
     * @var \Backoffice\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Backoffice\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;


}

