<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierHandlerRepository")
 */
class SupplierHandler
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $code;

    /**
     * @ORM\Column(type="text")
     */
    private $options;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Supplier", inversedBy="handlers")
     */
    private $supplier;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return Collection|Supplier[]
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier[] = $supplier;
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        if ($this->supplier->contains($supplier)) {
            $this->supplier->removeElement($supplier);
        }

        return $this;
    }

    /**
     * Получить объект обработчика
     */
    // public function getObject(HandlerCollection $hc) - а может надо так?
    public function getObject() {
        $config = json_decode($this-getOptions());

        $handler = HandlerCollection::instance()->find($this->getCode());
        if(!$handler)
            return null;

        $handler->setConfig($config);
        return $handler;
    }

    /**
     * Созранить объект обработчика
     */
    public function setObject(Handler $handler): self {
        $config = json_encode($handler->getConfig()->getData());
        
        $this->setCode($handler->getId());
        $this->setOptions($config);

        return $this;
    }
}
