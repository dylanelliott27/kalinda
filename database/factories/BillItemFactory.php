<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\BillIssuer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillItem>
 */
class BillItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => rand(1, 1500),
            'bill_issuer_id' => BillIssuer::factory(),
            'bill_id' => Bill::factory()
        ];
    }
}
