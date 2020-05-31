<?php

namespace App\States\Audit;

class ViewAuditState extends AbstractAuditState
{
    public function icon(): string
    {
        return "uil uil-eye";
    }

    public function color(): string
    {
        return  "purple-400";
    }

    public function action(): string
    {
        return "View";
    }
}
