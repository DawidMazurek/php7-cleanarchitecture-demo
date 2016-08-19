<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\entity;

use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;

/**
 * Class Payment
 * @package DawidMazurek\CleanArchitectureDemo\payments\entity
 */
class Payment
{
    /**
     * @var PaymentId
     */
    private $paymentId;

    /**
     * @return PaymentId
     */
    public function getPaymentId(): PaymentId
    {
        return $this->paymentId;
    }

    /**
     * @param PaymentId $paymentId
     */
    public function setPaymentId(PaymentId $paymentId)
    {
        $this->paymentId = $paymentId;
    }
}
