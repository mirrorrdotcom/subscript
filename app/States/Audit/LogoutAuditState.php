<?php

namespace App\States\Audit;

class LogoutAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-exit";
    }

    public function color(): string
    {
        return "gray-800";
    }

    public function action(): string
    {
        return "Logout";
    }
}
