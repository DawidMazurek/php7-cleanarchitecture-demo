<?php

declare(strict_types=1);

include __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\CleanArchitectureDemo\payments\factory\PaymentsFactory;
use DawidMazurek\CleanArchitectureDemo\payments\gateway\PaymentsDummyApiGateway;
use DawidMazurek\CleanArchitectureDemo\payments\hydrator\DefaultPaymentHydrator;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;
use DawidMazurek\CleanArchitectureDemo\payments\service\PaymentDuplicationService;
use DawidMazurek\CleanArchitectureDemo\valueobjects\PaymentId;
use Ramsey\Uuid\UuidFactory;

$uuidFactory = new UuidFactory();

$paymentDuplicationService = new PaymentDuplicationService(
    new PaymentsRepository(
        new PaymentsDummyApiGateway(),
        new DefaultPaymentHydrator(),
        new PaymentsFactory()
    ),
    $uuidFactory
);

$paymentDuplicationService->duplicatePayment(
    new PaymentId(
        $uuidFactory->uuid4()->toString()
    )
);
