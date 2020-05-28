<?php

namespace App\Actions;

use App\Contracts\Auditable;
use App\Contracts\AuditAction;
use App\Contracts\ConditionalAction;
use App\Models\Audit;
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
            if ($this->shouldAudit($model)) {
                $this->audit($model);
            }
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
        Audit::logCreate($auditable);
    }

    abstract protected function create(array $data);
}
