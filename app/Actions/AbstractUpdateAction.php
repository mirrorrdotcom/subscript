<?php

namespace App\Actions;

use App\Contracts\Auditable;
use App\Contracts\AuditAction;
use App\Contracts\ConditionalAction;
use App\Models\Audit;
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
            if ($this->shouldAudit($model)) {
                $this->audit($model);
            }
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

    private function shouldAudit($resource): bool
    {
        if (!($this instanceof AuditAction)) {
            return false;
        }

        if (!($resource instanceof Auditable)) {
            return false;
        }

        return true;
    }

    public function audit(Auditable $auditable)
    {
        Audit::logUpdate($auditable);
    }

    abstract protected function update(Model $model, array $data);
}
