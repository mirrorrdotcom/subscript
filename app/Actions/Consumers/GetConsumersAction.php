<?php

namespace App\Actions\Consumers;

use App\Models\Consumer;
use Illuminate\Database\Eloquent\Collection;

class GetConsumersAction
{
    public function execute() : Collection
    {
        return Consumer::all();
    }
}