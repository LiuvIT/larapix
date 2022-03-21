<?php

namespace Liuv\Tests\ValueObjects\Payment;

use Liuv\Larapix\Exceptions\PaymentMethodNotAcceptedException;
use Liuv\Larapix\ValueObjects\Payment\Pix;
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
