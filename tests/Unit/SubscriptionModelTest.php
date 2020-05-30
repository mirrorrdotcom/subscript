<?php

namespace Tests\Unit;

use App\Models\Plan;
use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_multiple_subscription_plans()
    {
        $model = factory(SubscriptionModel::class)->create();

        $count = 3;
        factory(Plan::class, $count)
            ->create([ "subscription_model_id" => $model->id ]);

        $this->assertInstanceOf(Collection::class, $model->plans);
        $this->assertCount($count, $model->plans);
    }
}
