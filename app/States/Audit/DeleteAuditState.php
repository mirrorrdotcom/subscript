<?php

namespace App\States\Audit;

class DeleteAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-trash-alt";
    }

    public function color(): string
    {
        return "orange-900";
    }

    public function action(): string
    {
        return "Delete";
    }
}
