<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\repository;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;
use DawidMazurek\CleanArchitectureDemo\payments\exception\PaymentNotFoundException;
use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsGatewayInterface;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\PaymentHydratorInterface;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;

/**
 * Class PaymentsRepository
 * @package PaidFeatures\NNL\Adapters\packets\repository
 */
class PaymentsRepository
{
    /**
     * @var PaymentsGatewayInterface
     */
    private $gateway;

    /**
     * @var PaymentHydratorInterface
     */
    private $hydrator;

    /**
     * @var PaymentsFactory
     */
    private $factory;

    /**
     * PacketsRepository constructor.
     * @param PaymentsGatewayInterface $gateway
     * @param PaymentHydratorInterface $hydrator
     * @param PaymentsFactory $factory
     */
    public function __construct(
        PaymentsGatewayInterface $gateway,
        PaymentHydratorInterface $hydrator,
        PaymentsFactory $factory
    ) {
        $this->gateway = $gateway;
        $this->hydrator = $hydrator;
        $this->factory = $factory;
    }

    /**
     * @param PaymentId $paymentId
     * @return Payment
     * @throws PaymentNotFoundException
     */
    public function findById(PaymentId $paymentId): Payment
    {
        $paymentData = $this->gateway->findById($paymentId->getId());
        if (count($paymentData) === 0) {
            throw new PaymentNotFoundException('Payment not found exception. (' .$paymentId->getId() . ')');
        }
        return $this->hydrator->hydrate(
            $this->factory->create(),
            $paymentData
        );
    }

    /**
     * @return Payment[]
     */
    public function findAll(): array
    {
        $rawPayments = $this->gateway->findAll();
        $packets = [];
        foreach ($rawPayments as $paymentData) {
            $packets[] = $this->hydrator->hydrate(
                $this->factory->create(),
                $paymentData
            );
        }
        return $packets;
    }

    /**
     * @param Payment $payment
     */
    public function registerPayment(Payment $payment)
    {
        $this->gateway->registerPayment(
            $this->hydrator->extract($payment)
        );
    }

    /**
     * @param Payment $payment
     */
    public function editPayment(Payment $payment)
    {
        $this->gateway->editPayment(
            $this->hydrator->extract($payment)
        );
    }

    /**
     * @param PaymentId $paymentId
     */
    public function deletePaymentById(PaymentId $paymentId)
    {
        $this->gateway->deletePaymentById($paymentId->getId());
    }
}
