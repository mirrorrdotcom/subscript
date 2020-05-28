<?php

namespace App\Contracts;

interface Auditable
{
    public function getKey();

    public function getMorphClass();
}
