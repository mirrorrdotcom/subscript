<?php

namespace App\Contracts;

interface ConditionalAction
{
    public function passes(): bool;
}
