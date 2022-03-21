<?php

namespace Liuv\Larapix\Contracts;

use Liuv\Larapix\Contracts\Features\ChargesContract;
use Liuv\Larapix\Contracts\Features\PaymentsContract;
use Liuv\Larapix\Contracts\Features\RefundsContract;

interface LarapixContract
{
    public function charges(): ChargesContract;

    public function refunds(): RefundsContract;

    public function payments(): PaymentsContract;
}