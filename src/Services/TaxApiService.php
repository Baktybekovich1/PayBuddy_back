<?php

namespace App\Services;

use App\Dto\LinkAnswerDto;

class TaxApiService
{
    public function __construct()
    {
    }

    public function TaxApi($data)
    {
//        $answer = new LinkAnswerDto(
//            $data['id'],
//            $date[]
//        )
        $dt = "2025-11-21T12:46:35Z";

        $dateTime = new \DateTime($dt);

        $date = $dateTime->format('Y-m-d');     // 2025-11-21
        $time = $dateTime->format('H:i:s');
        return $date;
    }

}
