<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\query;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;
use DawidMazurek\CleanArchitectureDemo\payments\exception\PaymentNotFoundException;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;

/**
 * Class GetPaymentById
 * @package DawidMazurek\CleanArchitectureDemo\payments\query
 */
class GetPaymentById
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
     * GetPacketById constructor.
     * @param PaymentsRepository $repository
     * @param PaymentId $paymentId
     */
    public function __construct(PaymentsRepository $repository, PaymentId $paymentId)
    {
        $this->repository = $repository;
        $this->paymentId = $paymentId;
    }

    /**
     * @return Payment
     * @throws PaymentNotFoundException
     */
    public function execute(): Payment
    {
        return $this->repository->findById($this->paymentId);
    }
}
