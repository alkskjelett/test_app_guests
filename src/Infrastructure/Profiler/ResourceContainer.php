<?php

namespace App\Infrastructure\Profiler;

class ResourceContainer
{
    public function __construct(
        private ?float $time = null,
        private ?float $memory = null,
    ) {
    }

    public function getTime(): ?float
    {
        return $this->time;
    }

    public function setTime(?float $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getMemory(): ?float
    {
        return $this->memory;
    }

    public function setMemory(?float $memory): self
    {
        $this->memory = $memory;

        return $this;
    }
}