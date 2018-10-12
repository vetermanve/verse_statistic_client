<?php

namespace Verse\StatisticClient\Encoder;

interface EncoderInterface
{
    public function encode($eventData) : string;
    public function decode(string $eventPayload);
}