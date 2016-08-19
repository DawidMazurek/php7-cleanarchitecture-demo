<?php

namespace PaidFeatures\NNL\Adapters\packets\gateway;

use Exception;
use PaidFeatures\NNL\Core\packets\command\DeletePacket;
use PaidFeatures\NNL\Core\packets\command\RegisterPacket;
use PaidFeatures\NNL\Core\packets\command\UpdatePacket;
use PaidFeatures\NNL\Core\packets\entity\Packet;
use PaidFeatures\NNL\Core\packets\hydrator\PacketHydrator;
use PaidFeatures\NNL\Core\packets\query\GetAllPackets;
use PaidFeatures\NNL\Core\packets\query\GetPacketById;
use PaidFeatures\NNL\Core\packets\repository\PacketsRepository;
use PaidFeatures\NNL\Core\valueobject\packet\PacketId;

/**
 * Class PacketsApiGateway
 * @package PaidFeatures\NNL\Adapters\packets\gateway
 */
class PacketsCoreGateway implements PacketsGatewayInterface
{

    /**
     * @var PacketsRepository
     */
    private $packetsRepository;

    /**
     * @var PacketHydrator
     */
    private $packetHydrator;

    /**
     * PacketsCoreGateway constructor.
     * @param PacketsRepository $repository
     * @param PacketHydrator $hydrator
     */
    public function __construct(PacketsRepository $repository, PacketHydrator $hydrator)
    {
        $this->packetsRepository = $repository;
        $this->packetHydrator = $hydrator;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $response = [];

        $registerPacket = new GetAllPackets(
            $this->packetsRepository
        );
        $packets = $registerPacket->execute();
        foreach ($packets as $packet) {
            $response[] = $this->packetHydrator->extract($packet);
        }

        return $response;
    }

    /**
     * @param int $packetId
     * @return array
     */
    public function findById($packetId)
    {
        $getPacketById = new GetPacketById(
            $this->packetsRepository,
            new PacketId($packetId)
        );
        $packet = $getPacketById->execute();
        $response = $this->packetHydrator->extract($packet);

        return $response;
    }

    /**
     * @param array $packetData
     */
    public function registerPacket(array $packetData)
    {
        $packet = new Packet();
        $registerPacket = new RegisterPacket(
            $this->packetsRepository,
            $this->packetHydrator->hydrate(
                $packet,
                $packetData
            )
        );
        $registerPacket->execute();
    }

    /**
     * @param array $packetData
     */
    public function editPacket(array $packetData)
    {
        $packet = new Packet();
        $updatePacket = new UpdatePacket(
            $this->packetsRepository,
            $this->packetHydrator->hydrate(
                $packet,
                $packetData
            ),
            $packet->getId()
        );

        $updatePacket->execute();
    }

    /**
     * @param int $packetId
     */
    public function deletePacketById($packetId)
    {
        $deletePacket = new DeletePacket(
            $this->packetsRepository,
            new PacketId($packetId)
        );
        $deletePacket->execute();
    }
}
