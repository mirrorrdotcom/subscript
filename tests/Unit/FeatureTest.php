<?php

namespace Tests\Unit;

use App\Models\Feature;
use App\Models\SubscriptionModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_subscription_model()
    {
        $plan = factory(Feature::class)->create();

        $this->assertInstanceOf(
            SubscriptionModel::class,
            $plan->subscription_model
        );

        $this->assertEquals(
            $plan->subscription_model_id,
            $plan->subscription_model->id
        );
    }
}
