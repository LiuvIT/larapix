<?php

namespace Liuv\Larapix\Contracts\Features;

use Liuv\Larapix\ValueObjects\Payment\Pix;
use Liuv\Larapix\ValueObjects\Payment\QrCode;

interface PaymentsContract
{
    public function initPixPayment(Pix $pix): array;

    public function initQrCodePayment(QrCode $qrCode): array;

    public function confirmPayment(string $paymentCorrelationId): array;
}
