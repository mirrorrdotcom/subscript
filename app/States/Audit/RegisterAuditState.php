<?php

namespace App\States\Audit;

class RegisterAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-user-plus";
    }

    public function color(): string
    {
        return  "green-300";
    }

    public function action(): string
    {
        return "Register";
    }
}
