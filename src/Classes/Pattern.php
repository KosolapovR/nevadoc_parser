<?php


namespace App\Classes;


class Pattern
{
    private string $pattern;
    private string $productName;
    private ?string $seller;

    public function __construct(string $pattern, string $productName, string $seller = null){

        $this->pattern = $pattern;
        $this->productName = $productName;
        $this->seller = $seller;
    }

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
}