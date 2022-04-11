<?php

namespace Liuv\Larapix\Core;

use Liuv\Larapix\Charges\Contracts\ChargeContract;
use Liuv\Larapix\Payments\Contracts\PaymentsContract;
use Liuv\Larapix\Refunds\Contracts\RefundsContract;

interface LarapixContract
{
    public function charges(): ChargeContract;

    public function refunds(): RefundsContract;

    public function payments(): PaymentsContract;
}
