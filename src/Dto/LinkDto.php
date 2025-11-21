<?php

namespace App\Dto;

class LinkDto
{
    public function __construct(
        public readonly string $link,
    )
    {
    }

}
