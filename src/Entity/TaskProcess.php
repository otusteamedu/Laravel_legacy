<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskProcessRepository")
 */
class TaskProcess
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $workerIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $currentIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $sessStartAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $workStartAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $workUpdateAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bError;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="text")
     */
    private $workerState;

    public function __construct() {
        $this->id = '';
        $this->workerIndex = 0;
        $this->currentIndex = 0;
        $this->sessStartAt = 0;
        $this->workStartAt = 0;
        $this->workUpdateAt = 0;
        $this->bError = false;
        $this->message = '';
        $this->workerState = '';
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getWorkerIndex(): ?int
    {
        return $this->workerIndex;
    }

    public function setWorkerIndex(int $workerIndex): self
    {
        $this->workerIndex = $workerIndex;

        return $this;
    }

    public function getCurrentIndex(): ?int
    {
        return $this->currentIndex;
    }

    public function setCurrentIndex(int $currentIndex): self
    {
        $this->currentIndex = $currentIndex;

        return $this;
    }

    public function getSessStartAt(): ?int
    {
        return $this->sessStartAt;
    }

    public function setSessStartAt(int $sessStartAt): self
    {
        $this->sessStartAt = $sessStartAt;

        return $this;
    }

    public function getWorkStartAt(): ?int
    {
        return $this->workStartAt;
    }

    public function setWorkStartAt(int $workStartAt): self
    {
        $this->workStartAt = $workStartAt;

        return $this;
    }

    public function getWorkUpdateAt(): ?int
    {
        return $this->workUpdateAt;
    }

    public function setWorkUpdateAt(int $workUpdateAt): self
    {
        $this->workUpdateAt = $workUpdateAt;

        return $this;
    }

    public function getBError(): ?bool
    {
        return $this->bError;
    }

    public function setBError(bool $bError): self
    {
        $this->bError = $bError;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getWorkerState(): ?string
    {
        return $this->workerState;
    }

    public function setWorkerState($workerState): self
    {
        $this->workerState = $workerState;

        return $this;
    }
}
