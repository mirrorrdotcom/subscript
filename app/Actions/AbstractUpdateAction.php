<?php

namespace App\Actions;

use App\Contracts\ConditionalAction;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class AbstractUpdateAction
{
    public function execute(Model $model, array $data): bool
    {
        if (!$this->canExecute($model, $data)) {
            return false;
        }

        try {
            $this->update($model, $data);
            // TODO: Audit updating the existing model.
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    private function canExecute($model, $data): bool
    {
        if ($model == null) {
            Log::error("The model passed to the action cannot be null.");
            return false;
        }

        if (!count($data)) {
            Log::error("The data passed to the action is invalid.");
            return false;
        }

        if ($this instanceof ConditionalAction) {
            return $this->passes();
        }

        return true;
    }

    abstract protected function update(Model $model, array $data);
}
