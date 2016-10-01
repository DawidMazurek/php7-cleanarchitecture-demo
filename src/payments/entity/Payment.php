<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\entity;

use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Money\Money;

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
     * @var Money
     */
    private $price;

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

    /**
     * @param Money $price
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }
}
