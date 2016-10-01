<?php

declare(strict_types = 1);

namespace DawidMazurek\CleanArchitectureDemo\payments\facade;

use DawidMazurek\CleanArchitectureDemo\payments\command\RegisterPayment;
use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\query\GetPaymentById;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Ramsey\Uuid\UuidFactory;

class DuplicatePaymentById
{
    private $paymentId;

    public function __construct(PaymentId $paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function execute()
    {
        $paymentFactory = new PaymentsFactory();
        $paymentHydrator = new DefaultPaymentHydrator();

        $originalPayment = (new GetPaymentById(
            new PaymentsRepository(
                new PaymentsDummyApiGateway(),
                new DefaultPaymentHydrator(),
                $paymentFactory
            ),
            $this->paymentId
        ))->execute();

        $uuidFactory = new UuidFactory();

        $newPayment = clone $originalPayment;
        $newPayment->setPaymentId(
            new PaymentId(
                $uuidFactory->uuid4()->toString()
            ));


        (new RegisterPayment(
            new PaymentsRepository(
                new PaymentsDummyApiGateway(),
                $paymentHydrator,
                $paymentFactory
            ),
            $newPayment
        ))->execute();
    }
}
