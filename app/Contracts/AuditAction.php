<?php

namespace App\Contracts;

interface AuditAction
{
    public function audit(Auditable $auditable);
}
