<?php

namespace Liuv\Larapix\Payments\Contracts;

use Liuv\Larapix\Payments\Pix;
use Liuv\Larapix\Payments\QrCode;

interface PaymentsContract
{
    public function initPixPayment(Pix $pix): array;

    public function initQrCodePayment(QrCode $qrCode): array;

    public function confirmPayment(string $paymentCorrelationId): array;
}
