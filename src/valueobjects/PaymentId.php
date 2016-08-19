<?php

declare(strict_types=1);

namespace DawidMazurek\CleanArchitectureDemo\valueobjects;

use DawidMazurek\CleanArchitectureDemo\valueobjects\exceptions\InvalidPaymentIdException;

/**
 * Class PacketId
 * @package PaidFeatures\NNL\Adapters\valueobjects
 */
class PaymentId
{
    /**
     * @var string
     */
    private $id;

    /**
     * PacketId constructor.
     * @param string $id
     * @throws InvalidPaymentIdException
     */
    public function __construct($id)
    {
        if (!$this->validateFormat($id)) {
            throw new InvalidPaymentIdException('Invalid payment id format, uuid4 allowed only');
        }
        $this->id = $id;
    }

    /**
     * @param string $packetId
     *
     * @return bool
     */
    private function validateFormat($packetId)
    {
        return preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $packetId);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
