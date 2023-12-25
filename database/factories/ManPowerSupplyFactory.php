<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ManPowerSupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supply_date' => now()->subDays(60),
            'customer_id' => $this->faker->numberBetween(1,10),
            'people_id' => $this->faker->numberBetween(1,100),
            'iqama_id' => $this->faker->randomNumber(),
            'designation' => $this->faker->jobTitle(),
            'total_hours' => 208,
            'rate_hour' => 20,
            'total_amount' => 208*20,
            'vat' => 15,
            'vat_amount' => 624,
            'grand_amount' => 4784,
            'status' => 1
        ];
    }
}
