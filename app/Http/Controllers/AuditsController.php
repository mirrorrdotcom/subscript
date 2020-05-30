<?php

namespace App\Http\Controllers;

use App\Actions\Audit\GetUserAuditsAction;

class AuditsController extends Controller
{
    public function all()
    {
        return view("audits.all")
            ->with("audits", (new GetUserAuditsAction())->execute());
    }
}
