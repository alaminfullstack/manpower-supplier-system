<?php

namespace Database\Factories;

use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $designation = Designation::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'designation_id' => $this->faker->numberBetween(1,20),
        ];
    }
}
