<?php


namespace Verse\StatisticClient\Transport;


interface StatisticWriteClientTransportInterface
{
    public function send (string $payload) : bool; 
}