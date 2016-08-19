<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\payments\query;

use DawidMazurek\CleanArchitectureDemo\payments\entity\Payment;
use DawidMazurek\CleanArchitectureDemo\payments\repository\PaymentsRepository;

/**
 * Class GetAllPayments
 * @package DawidMazurek\CleanArchitectureDemo\payments\query
 */
class GetAllPayments
{
    /**
     * @var PaymentsRepository
     */
    private $repository;

    /**
     * GetAllPayments constructor.
     *
     * @param PaymentsRepository $repository
     */
    public function __construct(PaymentsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Payment[]
     */
    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
