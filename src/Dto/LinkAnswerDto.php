<?php

namespace App\Dto;

class LinkAnswerDto
{
    public function __construct(
        public int    $id,
        public string $date,
        public string $time,
        public string $cashierName,
        public string $locationName,
        public string $address,
        public string $sum,
        public array  $products

    )
    {
    }

}
