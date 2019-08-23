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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $artikul;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $preview;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $externalId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Supplier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropertyValue", mappedBy="product", orphanRemoval=true)
     */
    private $properties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductPrice", mappedBy="product", orphanRemoval=true)
     */
    private $prices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductFile", mappedBy="product", orphanRemoval=true)
     */
    private $files;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ExternalFile", cascade={"persist", "remove"})
     */
    private $image;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->properties = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->files = new ArrayCollection();
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

    public function getArtikul(): ?string
    {
        return $this->artikul;
    }

    public function setArtikul(?string $artikul): self
    {
        $this->artikul = $artikul;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(?string $preview): self
    {
        $this->preview = $preview;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|PropertyValue[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(PropertyValue $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setProduct($this);
        }

        return $this;
    }

    public function removeProperty(PropertyValue $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getProduct() === $this) {
                $property->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductPrice[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(ProductPrice $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setProduct($this);
        }

        return $this;
    }

    public function removePrice(ProductPrice $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getProduct() === $this) {
                $price->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductFile[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(ProductFile $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setProduct($this);
        }

        return $this;
    }

    public function removeFile(ProductFile $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
            // set the owning side to null (unless already changed)
            if ($file->getProduct() === $this) {
                $file->setProduct(null);
            }
        }

        return $this;
    }

    public function getImage(): ?ExternalFile
    {
        return $this->image;
    }

    public function setImage(?ExternalFile $image): self
    {
        $this->image = $image;

        return $this;
    }
	
    /**
     * получить список файлов только типа $type
     */
    public function getFilesByType($type) {
    /**
     * тут конечно можно взять getFiles(), а потом пробежаться
     * c помощью array_filter(...), но если прикрепленных файлов будет 100, а необходимо 
     * выбрать 10, то резко снижается КПД. Значит надо взять только те файлы, что необходимо,
     * а значит надо иметь ссылку на ProductFileRepository.
     * Значит ее надо либо внедрить, либо передавать по ссылке 
     * 
     * public function getFilesByType(ProductFileRepository $pfr, $type)
     * 
     */
    }
}
