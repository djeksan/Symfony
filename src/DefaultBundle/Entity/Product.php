<?php

namespace DefaultBundle\Entity;

use DefaultBundle\DefaultBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Assert\Length(min="2", max="10", minMessage="sorry  min 2", maxMessage="sorry max 10")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\Length(min="5",max="255",minMessage=" min 5 simbol",maxMessage=" max 255 simbols")
     *
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_full", type="text", nullable=true)
     */
    private $descriptionFull;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="brand", type="integer", nullable=true)
     */
    private $brand;

    /**
     * @var Category
     *
     *
     * @ORM\ManyToOne(targetEntity="DefaultBundle\Entity\Category",inversedBy="product")
     * @ORM\JoinColumn(name="id_category",referencedColumnName="id",onDelete="CASCADE")
     *
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="price_action", type="float", nullable=true)
     */
    private $priceAction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="balance_stock", type="integer", nullable=true)
     */
    private $balanceStock;


    /**
    * @var ArrayCollection
     *
     *@ORM\OneToMany(targetEntity="DefaultBundle\Entity\ProductPhoto", mappedBy="products", cascade={"all"})
     */

    private $photos;




    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string",length=255, nullable=true)
     */
    private $icon;




    public function __construct()
    {

        $date = new \DateTime("now");
        $this->setCreated($date);
        $this->photos=new  ArrayCollection();

       
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descriptionFull
     *
     * @param string $descriptionFull
     *
     * @return Product
     */
    public function setDescriptionFull($descriptionFull)
    {
        $this->descriptionFull = $descriptionFull;

        return $this;
    }

    /**
     * Get descriptionFull
     *
     * @return string
     */
    public function getDescriptionFull()
    {
        return $this->descriptionFull;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     *
     * @param Category $category
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     *
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceAction
     *
     * @param float $priceAction
     *
     * @return Product
     */
    public function setPriceAction($priceAction)
    {
        $this->priceAction = $priceAction;

        return $this;
    }

    /**
     * Get priceAction
     *
     * @return float
     */
    public function getPriceAction()
    {
        return $this->priceAction;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set balanceStock
     *
     * @param integer $balanceStock
     *
     * @return Product
     */
    public function setBalanceStock($balanceStock)
    {
        $this->balanceStock = $balanceStock;

        return $this;
    }

    /**
     * Get balanceStock
     *
     * @return int
     */
    public function getBalanceStock()
    {
        return $this->balanceStock;
    }

    /**
     * Add photo
     *
     * @param \DefaultBundle\Entity\ProductPhoto $photo
     *
     * @return Product
     */
    public function addPhoto(\DefaultBundle\Entity\ProductPhoto $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }



    /**
     * Remove photo
     *
     * @param \DefaultBundle\Entity\ProductPhoto $photo
     */
    public function removePhoto(\DefaultBundle\Entity\ProductPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
