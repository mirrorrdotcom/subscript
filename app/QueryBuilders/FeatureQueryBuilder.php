<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class FeatureQueryBuilder extends Builder
{
    public function whereActive()
    {
        return $this->where("is_active", true);
    }
}
