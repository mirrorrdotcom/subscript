<?php

namespace App\States\Audit;

class CreateAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-file-plus-alt";
    }

    public function color(): string
    {
        return "green-500";
    }

    public function action(): string
    {
        return "Create";
    }
}
