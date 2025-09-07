<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = Carbon::now();
        $endsAt = (clone $startsAt)->addMonth();
        $nextBillingAt = (clone $startsAt)->addMonth();

        return [
            'user_id' => User::factory(),
            'plan' => $this->faker->randomElement(['basic', 'pro', 'enterprise']),
            'status' => $this->faker->randomElement(['active', 'expiring', 'expired']),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'next_billing_at' => $nextBillingAt,
        ];
    }

    public function expired(): Factory
    {
        return $this->state(function () {
            return [
                'status' => 'expired',
                'ends_at' => Carbon::now()->subDay(),
                'next_billing_at' => null,
            ];
        });
    }

    public function expiringSoon(): Factory
    {
        return $this->state(function () {
            return [
                'status' => 'expiring',
                'ends_at' => Carbon::now()->addDays(3),
                'next_billing_at' => Carbon::now()->addDays(3),
            ];
        });
    }
}
