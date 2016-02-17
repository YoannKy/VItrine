<?php

namespace Application\Entity;

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
     * @var \Application\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Application\Entity\Products
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;



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
     * Set orderList
     *
     * @param string $orderList
     *
     * @return Wishlists
     */
    public function setOrderList($orderList)
    {
        $this->orderList = $orderList;

        return $this;
    }

    /**
     * Get orderList
     *
     * @return string
     */
    public function getOrderList()
    {
        return $this->orderList;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\Users $user
     *
     * @return Wishlists
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
     * Set product
     *
     * @param \Application\Entity\Products $product
     *
     * @return Wishlists
     */
    public function setProduct(\Application\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Application\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }
}
