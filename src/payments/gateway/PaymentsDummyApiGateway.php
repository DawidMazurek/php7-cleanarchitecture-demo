<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\gateway;

use DawidMazurek\CleanArchitectureDemo\payments\mapping\PaymentFields;

/**
 * Class PacketsApiGateway
 * @package PaidFeatures\NNL\Adapters\packets\gateway
 */
class PaymentsDummyApiGateway implements PaymentsGatewayInterface
{
    /**
     * @return array
     */
    public function findAll(): array
    {
        return [
            [
                PaymentFields::PAYMENT_ID => '123e4567-e89b-12d3-a456-426655440000',
            ],
            [
                PaymentFields::PAYMENT_ID => '123e4567-e89b-12d3-a456-426655440001',
            ]
        ];
    }

    /**
     * @param string $paymentId
     * @return array
     */
    public function findById(string $paymentId): array
    {
        return [
            PaymentFields::PAYMENT_ID => $paymentId,
        ];
    }

    /**
     * @param array $payment
     */
    public function registerPayment(array $payment)
    {

    }

    /**
     * @param array $payment
     */
    public function editPayment(array $payment)
    {

    }

    /**
     * @param string $packetId
     */
    public function deletePaymentById(string $packetId)
    {

    }
}
