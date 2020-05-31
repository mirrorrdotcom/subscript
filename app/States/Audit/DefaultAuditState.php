<?php

namespace App\States\Audit;

class DefaultAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-info-circle";
    }

    public function color(): string
    {
        return "text-gray-600";
    }

    public function action(): string
    {
        return "Other";
    }
}
