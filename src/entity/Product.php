<?php

class Product
{
    private ?int $id;
    private string $type;
    private string $name;
    private string $description;
    private string $imageFileName;
    private float $price;

    public function __construct(?int $id, string $type, string $name, string $description, float $price, string $imageFileName = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->imageFileName = $imageFileName;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImageFileName()
    {
        return $this->imageFileName;
    }

    public function setImageFileName(string $imageFileName)
    {
        $this->imageFileName = $imageFileName;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->getPrice(), 2);
    }

    public function getFixedImageFileName(): string
    {
        return 'img/' . $this->getImageFileName();
    }
}
