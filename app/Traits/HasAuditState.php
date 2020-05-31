<?php

namespace App\Traits;

use App\States\Audit\AbstractAuditState;
use App\States\Audit\CreateAuditState;
use App\States\Audit\DefaultAuditState;
use App\States\Audit\DeleteAuditState;
use App\States\Audit\LoginAuditState;
use App\States\Audit\LogoutAuditState;
use App\States\Audit\RegisterAuditState;
use App\States\Audit\UpdateAuditState;
use App\States\Audit\ViewAuditState;

trait HasAuditState
{
    public function state(): AbstractAuditState
    {
        switch($this->action) {
            case "register":
                return new RegisterAuditState($this->auditable_type);
            case "login":
                return new LoginAuditState($this->auditable_type);
            case "logout":
                return new LogoutAuditState($this->auditable_type);
            case "view":
                return new ViewAuditState($this->auditable_type);
            case "create":
                return new CreateAuditState($this->auditable_type);
            case "update":
                return new UpdateAuditState($this->auditable_type);
            case "delete":
                return new DeleteAuditState($this->auditable_type);
            default:
                return new DefaultAuditState($this->auditable_type);
        }
    }
}
