<?php

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\CleanArchitectureDemo\payments\command\RegisterPayment;
use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\mapping\PaymentFields;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use Ramsey\Uuid\UuidFactory;

$paymentFactory = new PaymentsFactory();
$paymentHydrator = new DefaultPaymentHydrator();
$payment = $paymentFactory->create();
$uuidFactory = new UuidFactory();

$paymentData =[
    PaymentFields::PAYMENT_ID => $uuidFactory->uuid4()->toString(),
    PaymentFields::PRICE_VALUE => 10,
    PaymentFields::PRICE_CURRENCY => 'PLN',
];

(new RegisterPayment(
    new PaymentsRepository(
        new PaymentsDummyApiGateway(),
        $paymentHydrator,
        $paymentFactory
    ),
    $paymentHydrator->hydrate(
        $payment,
        $paymentData
    )
))->execute();
