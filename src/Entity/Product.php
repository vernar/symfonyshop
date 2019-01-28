<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $create_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $special_price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sku;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attributeset;


     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $url_key;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $enable;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EavProductCategories", mappedBy="product_id", orphanRemoval=true)
     */
    private $eavProductCategories;

    public function __construct()
    {
        $this->eavProductCategories = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSpecialPrice(): ?float
    {
        return $this->special_price;
    }

    public function setSpecialPrice(?float $special_price): self
    {
        $this->special_price = $special_price;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getAttributeset(): ?int
    {
        return $this->attributeset;
    }

    public function setAttributeset(?int $attributeset): self
    {
        $this->attributeset = $attributeset;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlKey()
    {
        return $this->url_key;
    }

    /**
     * @param mixed $url_key
     */
    public function setUrlKey($url_key): self
    {
        $this->url_key = $url_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @param mixed $eavProductCategories
     */
    public function setEavProductCategories(Category $categoryId)
    {
        $this->categoryId = $categoryId;
    }


    /**
     * @return Collection|EavProductCategories[]
     */
    public function getEavProductCategories(): Collection
    {
        return $this->eavProductCategories;
    }

    public function addEavProductCategory(EavProductCategories $eavProductCategory): self
    {
        if (!$this->eavProductCategories->contains($eavProductCategory)) {
            $this->eavProductCategories[] = $eavProductCategory;
            $eavProductCategory->setProductId($this);
        }

        return $this;
    }

    public function removeEavProductCategory(EavProductCategories $eavProductCategory): self
    {
        if ($this->eavProductCategories->contains($eavProductCategory)) {
            $this->eavProductCategories->removeElement($eavProductCategory);
            // set the owning side to null (unless already changed)
            if ($eavProductCategory->getProductId() === $this) {
                $eavProductCategory->setProductId(null);
            }
        }

        return $this;
    }

}
