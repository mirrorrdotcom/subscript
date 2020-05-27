<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;

trait CommandValidationErrors
{
    protected function errorsToString(MessageBag $errors): string
    {
        return implode(
            "\n",
            Arr::flatten($errors->toArray(), 1)
        );
    }
}
