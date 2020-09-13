<?php

namespace App\Actions\Consumers;

use App\Actions\AbstractCreateAction;
use App\Contracts\AuditAction;
use App\Models\Consumer;
use Illuminate\Support\Str;

class CreateConsumerAction extends AbstractCreateAction implements AuditAction
{
    protected function create(array $data)
    {
        return $this->createConsumer($data);
    }

    private function generateUniqueConsumerApiToken()
    {
        do {
            $token = Str::random(Consumer::TOKEN_LENGTH);
        } while (! empty(Consumer::where('api_token', $token)->first()));

        return $token;
    }

    private function createConsumer($attributes)
    {
        $consumer = new Consumer($attributes);
        $consumer->api_token = $this->generateUniqueConsumerApiToken();
        $consumer->save();

        return $consumer;
    }
}
