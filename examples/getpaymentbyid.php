<?php

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\CleanArchitectureDemo\payments\command\RegisterPayment;
use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;

$paymentFactory = new PaymentsFactory();
new RegisterPayment(
    new PaymentsRepository(
        new PaymentsDummyApiGateway(),
        new DefaultPaymentHydrator(),
        $paymentFactory
    ),
    $paymentFactory->create()
);
