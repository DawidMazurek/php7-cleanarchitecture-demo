<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\hydrator;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;

/**
 * Interface PacketHydratorInterface
 * @package PaidFeatures\NNL\Adapters\packets\hydrator
 */
interface PaymentHydratorInterface
{
    /**
     * @param Payment $payment
     * @return array
     */
    public function extract(Payment $payment): array;

    /**
     * @param Payment $payment
     * @param array $paymentData
     * @return Payment
     */
    public function hydrate(Payment $payment, array $paymentData): Payment;
}
