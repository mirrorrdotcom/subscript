<?php

namespace App\States\Audit;

abstract class AbstractAuditState
{
    private ?string $auditable_type;

    public function __construct(?string $auditable_type)
    {
        $this->auditable_type = $auditable_type;
    }

    private function hasAuditable(): bool
    {
        if ($this->auditable_type == null) {
            return false;
        }

        if (empty($this->auditable_type)) {
            return false;
        }

        return true;
    }

    private function getClassName(string $path): string
    {
        $path = explode("\\", $path);

        $count = count($path);

        if (!$count) {
            return "";
        }

        return $path[$count - 1];
    }

    public function auditable(): string
    {
        if (!$this->hasAuditable()) {
            return "";
        }

        return $this->getClassName($this->auditable_type);
    }

    abstract public function icon(): string;

    abstract public function color(): string;

    abstract public function action(): string;
}
