<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort_order;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category_url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EavProductCategories", mappedBy="category_id", orphanRemoval=true)
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

    public function getSortOrder(): ?int
    {
        return $this->sort_order;
    }

    public function setSortOrder(?int $sort_order): self
    {
        $this->sort_order = $sort_order;

        return $this;
    }

    public function getCategoryUrl(): ?string
    {
        return $this->category_url;
    }

    public function setCategoryUrl(string $category_url): self
    {
        $this->category_url = $category_url;

        return $this;
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
            $eavProductCategory->setCategoryId($this);
        }

        return $this;
    }

    public function removeEavProductCategory(EavProductCategories $eavProductCategory): self
    {
        if ($this->eavProductCategories->contains($eavProductCategory)) {
            $this->eavProductCategories->removeElement($eavProductCategory);
            // set the owning side to null (unless already changed)
            if ($eavProductCategory->getCategoryId() === $this) {
                $eavProductCategory->setCategoryId(null);
            }
        }

        return $this;
    }
}
