<?php

namespace App\States\Audit;

class UpdateAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-edit-alt";
    }

    public function color(): string
    {
        return "blue-500";
    }

    public function action(): string
    {
        return "Update";
    }
}
