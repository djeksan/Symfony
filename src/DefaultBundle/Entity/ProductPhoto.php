<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPhoto
 *
 * @ORM\Table(name="product_photo")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\ProductPhotoRepository")
 */
class ProductPhoto
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, unique=true)
     */
    private $filename;


    /**
     * @var string
     *
     * @ORM\Column(name="smal_file_name", type="string", length=255)
     */
    private $smalfileName;


    /**
     * @var  Product
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Product", inversedBy="photos")
     * @ORM\JoinColumn(name="id_product"), referencedColumnName="id",onDelete="CASCADE"
     *
     */
private $products;

    /**
     * @return string
     */
    public function getSmalfileName()
    {
        return $this->smalfileName;
    }

    /**
     * @param string $smalfileName
     */
    public function setSmalfileName($smalfileName)
    {
        $this->smalfileName = $smalfileName;
    }


    
    
    
    

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
     * Set title
     *
     * @param string $title
     *
     * @return ProductPhoto
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return ProductPhoto
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set product
     *
     * @param \DefaultBundle\Entity\Product $products
     *
     * @return ProductPhoto
     */
    public function setProducts(\DefaultBundle\Entity\Product $products = null)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get product
     *
     * @return \DefaultBundle\Entity\Product
     */
    public function getProducts()
    {
        return $this->products;
    }
}
