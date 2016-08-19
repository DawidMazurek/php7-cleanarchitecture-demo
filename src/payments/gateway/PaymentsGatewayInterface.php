<?php
namespace DawidMazurek\CleanArchitectureDemo\payments\gateway;

/**
 * Interface PacketsGatewayInterface
 * @package PaidFeatures\NNL\Adapters\packets\gateway
 */
interface PaymentsGatewayInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param string $paymentId
     * @return array
     */
    public function findById(string $paymentId): array;

    /**
     * @param array $payment
     */
    public function registerPayment(array $payment);

    /**
     * @param array $payment
     */
    public function editPayment(array $payment);

    /**
     * @param string $paymentId
     */
    public function deletePaymentById(string $paymentId);
}
