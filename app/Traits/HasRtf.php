<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasRtf
{
    public function isRtfEmpty(string $field)
    {
        if (!$this->has($field)) {
            return true;
        }

        $value = strip_tags($this->input($field));

        if (empty(trim($value))) {
            return true;
        }

        return false;
    }

    public function stripRtfField(string $field, int $words = 20): string
    {
        if (!$this->{$field}) {
            return "";
        }

        return Str::words(strip_tags($this->{$field}), $words);
    }
}
