<?php

namespace Liuv\Tests\ValueObjects\Payment;

use Liuv\Larapix\Payments\Exceptions\PaymentMethodNotAcceptedException;
use Liuv\Larapix\Payments\Pix;
use PHPUnit\Framework\TestCase;

class PixTest extends TestCase
{
    public function test_selected_pix_type_should_be_listed()
    {
        $this->expectException(PaymentMethodNotAcceptedException::class);
        new Pix(
            'test',
            'hey@danielheart.dev',
            'unknown',
            1000
        );
    }
}
