<?php

namespace App\Actions;

use App\Contracts\ConditionalAction;
use Exception;
use Illuminate\Support\Facades\Log;

abstract class AbstractCreateAction
{
    public function execute(array $data): bool
    {
        if (!$this->canExecute($data)) {
            return false;
        }

        try {
            $model = $this->create($data);
            // TODO: Audit creating the new model.
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    private function canExecute(array $data): bool
    {
        if (!count($data)) {
            Log::error("The data passed to the action is invalid.");
            return false;
        }

        if ($this instanceof ConditionalAction) {
            return $this->passes();
        }

        return true;
    }

    abstract protected function create(array $data);
}
