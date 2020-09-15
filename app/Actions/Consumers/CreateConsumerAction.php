<?php

namespace App\Actions\Consumers;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Consumer;

class CreateConsumerAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return $this->createConsumer($data);
    }

    private function createConsumer($attributes)
    {
        $consumer = (new Consumer($attributes))->generateAndSetNewApiToken();
        $consumer->save();

        return $consumer;
    }
}
