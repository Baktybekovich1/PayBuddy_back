<?php

namespace App\Controller;

use App\Services\QrCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class QrController extends AbstractController
{
    public function __construct()
    {
    }
    #[Route('/bills/{id}/qrcode', name: 'bill_qrcode')]
    public function generateQrCode(string $id, QrCodeService $qrCodeService): Response
    {
        // Здесь вы можете получить данные счета из базы данных
        // Для примера используем фиксированные значения
        $amount = 1000.00; // Получите реальную сумму из базы
        $description = 'Оплата счета #' . $id;

        return $qrCodeService->generateQrCodeImageResponse($id, $amount);
    }

    #[Route('/bills/{id}/qrcode-page', name: 'bill_qrcode_page')]
    public function showQrCodePage(string $id, QrCodeService $qrCodeService): Response
    {
        $amount = 1000.00;
        $description = 'Оплата счета #' . $id;

        // Генерируем base64 для встраивания в HTML
        $qrCodeBase64 = $qrCodeService->generateBillQrCode($id, $amount, $description);

        return $this->render('bill_qrcode.html.twig', [
            'billId' => $id,
            'amount' => $amount,
            'qrCodeImage' => $qrCodeBase64,
        ]);
    }


}
