<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

class QrCodeService
{
    public function generateBillQrCode(string $billId, float $amount, string $description = ''): string
    {
        // Формируем данные для QR кода
        $paymentData = [
            'bill_id' => $billId,
            'amount' => $amount,
            'currency' => 'RUB',
            'description' => $description,
            'timestamp' => time()
        ];

        // Или URL для оплаты (измените на ваш домен)
        $paymentUrl = "https://api.paybudy.tw1.su/pay/bill/{$billId}";

        // Генерируем QR код
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($paymentUrl)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->build();

        // Возвращаем строку base64 для изображения
        return base64_encode($result->getString());
    }

    public function generateQrCodeImageResponse(string $billId, float $amount): \Symfony\Component\HttpFoundation\Response
    {
        $qrCodeString = $this->generateBillQrCode($billId, $amount);

        $response = new \Symfony\Component\HttpFoundation\Response(
            base64_decode($qrCodeString)
        );

        $response->headers->set('Content-Type', 'image/png');
        $response->headers->set('Content-Disposition', 'inline; filename="bill_' . $billId . '.png"');

        return $response;
    }
}
