<?php

namespace PaidFeatures\NNL\Adapters\packets\gateway;

use naspersclassifieds\shared\atlas\web\framework\lib\memd\Memd;
use PaidFeatures\NNL\Adapters\packets\mapping\PacketFields;

/**
 * Class PacketsCoreGatewayCacheProxy
 * @package PaidFeatures\NNL\Adapters\packets\gateway
 */
class PacketsCoreGatewayCacheProxy implements PacketsGatewayInterface
{
    /**
     * @var PacketsCoreGatewayCacheProxy
     */
    private $gateway;

    /**
     * PacketsCoreGatewayCacheProxy constructor.
     * @param PacketsCoreGatewayCacheProxy $gateway
     */
    public function __construct(PacketsCoreGateway $gateway)
    {
      $this->gateway = $gateway;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $cacheKey = 'nnl-packets-all';
        $data = Memd::get($cacheKey);
        if (is_null($data)) {
            $data = $this->gateway->findAll();
            Memd::set($cacheKey, $data);
        }
        return $data;
    }

    /**
     * @param int $packetId
     * @return array
     */
    public function findById($packetId)
    {
        $cacheKey = 'nnl-packet-id-'.$packetId;
        $data = Memd::get($cacheKey);
        if (is_null($data)) {
            $data = $this->gateway->findById($packetId);
            Memd::set($cacheKey, $data);
        }
        return $data;
    }

    /**
     * @param array $packetData
     */
    public function registerPacket(array $packetData)
    {
        $this->gateway->registerPacket($packetData);
        $cacheKey = 'nnl-packets-all';
        Memd::delete($cacheKey);
    }

    /**
     * @param array $packetData
     */
    public function editPacket(array $packetData)
    {
        $this->gateway->editPacket($packetData);
        $cacheKey = 'nnl-packet-id-'.$packetData[PacketFields::PACKET_ID];
        Memd::delete($cacheKey);
    }

    /**
     * @param int $packetId
     */
    public function deletePacketById($packetId)
    {
        $this->gateway->deletePacketById($packetId);
        $cacheKey = 'nnl-packet-id-'.$packetId;
        $cacheKeyAll = 'nnl-packets-all';

        Memd::delete($cacheKey);
        Memd::delete($cacheKeyAll);
    }
}
