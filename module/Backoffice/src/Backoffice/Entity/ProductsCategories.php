<?php

namespace Backoffice\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsCategories
 *
 * @ORM\Table(name="Products_categories", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductsCategories
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
     * @var \Backoffice\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Backoffice\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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

