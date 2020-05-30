<?php

namespace App\States\Audit;

class LoginAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-signin";
    }

    public function color(): string
    {
        return "cyan-500";
    }

    public function action(): string
    {
        return "Login";
    }
}
