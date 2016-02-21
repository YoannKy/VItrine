<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="Categories")
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

     /**
     * @ORM\ManyToMany(targetEntity="Products")
     * @ORM\JoinTable(name="Products_categories",
     *      joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    private $products;
    

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
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Add product
     *
     * @param \Application\Entity\Products $product
     * @return Category
     */
    public function addProduct(\Application\Entity\Products $product)
    {
        $this->product[] = $product;
    
        return $this;
    }
    
    /**
    * Get product
    *
    * @return \Application\Entity\Products
    */
    public function getProducts()
    {
        return $this->products;
    }
    
    /**
     * Remove product
     *
     * @param \Store\FrontendBundle\Entity\Product $product
     */
    public function removeProduct(\Application\Entity\Products $product)
    {
        $this->product->removeElement($product);
    }
}   
