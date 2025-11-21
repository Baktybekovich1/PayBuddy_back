<?php

namespace App\Dto;

class ProductDto
{
    public function __construct(
        public int $productId,
        public string $productName,
        public string $productPrice,
        public string $productCount,
        public string $productCost
    )
    {
    }

}
