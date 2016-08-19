<?php

namespace DawidMazurek\CleanArchitectureDemo\payments\command;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;

class EditPayment
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
     * EditPacket constructor.
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
        $this->repository->editPayment($this->payment);
    }
}
