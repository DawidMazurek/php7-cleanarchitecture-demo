<?php

declare(strict_types = 1);

namespace DawidMazurek\CleanArchitectureDemo\payments\service;

use DawidMazurek\CleanArchitectureDemo\payments\command\RegisterPayment;
use DawidMazurek\CleanArchitectureDemo\payments\query\GetPaymentById;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Ramsey\Uuid\UuidFactory;

class PaymentDuplicationService
{

    private $paymentsRepository;
    private $uuidFactory;

    public function __construct(PaymentsRepository $paymentsRepository, UuidFactory $uuidFactory)
    {
        $this->paymentsRepository = $paymentsRepository;
        $this->uuidFactory = $uuidFactory;
    }

    public function duplicatePayment(PaymentId $paymentId)
    {
        $originalPayment = (new GetPaymentById(
            $this->paymentsRepository,
            $paymentId
        ))->execute();

        $newPayment = clone $originalPayment;


        $newPayment->setPaymentId(
            new PaymentId(
                $this->uuidFactory->uuid4()->toString()
            )
        );

        (new RegisterPayment(
            $this->paymentsRepository,
            $newPayment
        ))->execute();
    }
}
