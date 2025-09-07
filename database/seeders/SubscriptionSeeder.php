<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Subscription::factory()->state([
                'plan' => 'pro',
                'status' => 'active',
            ]))
            ->create([
                'email' => 'active_user@example.com',
            ]);

        User::factory()
            ->has(Subscription::factory()->expired())
            ->create([
                'email' => 'expired_user@example.com',
            ]);

        User::factory()
            ->has(Subscription::factory()->expiringSoon())
            ->create([
                'email' => 'expiring_user@example.com',
            ]);

        User::factory(5)
            ->has(Subscription::factory())
            ->create();
    }
}
