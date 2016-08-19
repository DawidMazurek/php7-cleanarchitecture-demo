<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\factory;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;

/**
 * Class PaymentsFactory
 * @package DawidMazurek\CleanArchitectureDemo\payments\factory
 */
class PaymentsFactory
{
    /**
     * @return Payment
     */
    public function create(): Payment
    {
        return new Payment();
    }
}
