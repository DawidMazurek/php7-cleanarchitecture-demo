<?php

namespace DawidMazurek\CleanArchitectureDemo\payments\command;

use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;

class DeletePayment
{
    /**
     * @var PaymentsRepository
     */
    private $repository;

    /**
     * @var PaymentId
     */
    private $paymentId;

    /**
     * DeletePacket constructor.
     *
     * @param PaymentsRepository $repository
     * @param PaymentId          $paymentId
     */
    public function __construct(PaymentsRepository $repository, PaymentId $paymentId)
    {
        $this->repository = $repository;
        $this->packetId = $paymentId;
    }

    public function execute()
    {
        $this->repository->deletePaymentById($this->paymentId);
    }
}
