<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\command;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;

class RegisterPayment
{
    /**
     * @var PaymentsRepository
     */
    private $repository;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * RegisterPacket constructor.
     *
     * @param PaymentsRepository $repository
     * @param Payment            $payment
     */
    public function __construct(PaymentsRepository $repository, Payment $payment)
    {
        $this->repository = $repository;
        $this->payment = $payment;
    }

    public function execute()
    {
        $this->repository->registerPayment($this->payment);
    }
}
