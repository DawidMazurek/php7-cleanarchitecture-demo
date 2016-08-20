<?php

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\query\GetPaymentById;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Ramsey\Uuid\UuidFactory;

$paymentFactory = new PaymentsFactory();
$idToSeek = (new UuidFactory())->uuid4()->toString();

$payment = (new GetPaymentById(
    new PaymentsRepository(
        new PaymentsDummyApiGateway(),
        new DefaultPaymentHydrator(),
        $paymentFactory
    ),
    new PaymentId($idToSeek)
))->execute();

var_dump($payment);
