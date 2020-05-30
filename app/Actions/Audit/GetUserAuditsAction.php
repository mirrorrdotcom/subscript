<?php

namespace App\Actions\Audit;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class GetUserAuditsAction
{
    public function execute(): Collection
    {
        return Audit::where("user_id", Auth::id())
            ->latest()
            ->get();
    }
}
