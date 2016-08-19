<?php

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\CleanArchitectureDemo\payments\command\RegisterPayment;
use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Ramsey\Uuid\UuidFactory;

$paymentFactory = new PaymentsFactory();
$payment = $paymentFactory->create();
$uuidFactory = new UuidFactory();
$payment->setPaymentId(
    new PaymentId(
        $uuidFactory->uuid4()->toString()
    ));

(new RegisterPayment(
    new PaymentsRepository(
        new PaymentsDummyApiGateway(),
        new DefaultPaymentHydrator(new UuidFactory()),
        $paymentFactory
    ),
    $payment
))->execute();
