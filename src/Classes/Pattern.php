<?php


namespace App\Classes;


class Pattern
{
    private string $pattern;
    private string $productName;
    private ?string $seller;
    private ?string $size;
    private ?string $color;
    private ?string $material;
    private ?string $sleeve;
    private ?string $print;

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return string|null
     */
    public function getSeller(): ?string
    {
        return $this->seller;
    }

    /**
     * @param string $productName
     * @return Pattern
     */
    public function setProductName(string $productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * @param string|null $seller
     * @return Pattern
     */
    public function setSeller(?string $seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @param string $pattern
     * @return Pattern
     */
    public function setPattern(string $pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @param string|null $print
     * @return Pattern
     */
    public function setPrint(?string $print): Pattern
    {
        $this->print = $print;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     * @return Pattern
     */
    public function setSize(?string $size): Pattern
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return Pattern
     */
    public function setColor(?string $color): Pattern
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaterial(): ?string
    {
        return $this->material;
    }

    /**
     * @param string|null $material
     * @return Pattern
     */
    public function setMaterial(?string $material): Pattern
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSleeve(): ?string
    {
        return $this->sleeve;
    }

    /**
     * @param string|null $sleeve
     * @return Pattern
     */
    public function setSleeve(?string $sleeve): Pattern
    {
        $this->sleeve = $sleeve;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrint(): ?string
    {
        return $this->print;
    }
}