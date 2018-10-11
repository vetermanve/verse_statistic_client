<?php


namespace Verse\StatisticClient\WriteClient\Transport;


interface StatisticWriteClientTransportInterface
{
    public function send (string $payload) : bool; 
}