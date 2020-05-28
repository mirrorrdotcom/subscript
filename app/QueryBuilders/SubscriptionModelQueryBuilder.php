<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class SubscriptionModelQueryBuilder extends Builder
{
    public function whereActive()
    {
        return $this->where("is_active", true);
    }
}
