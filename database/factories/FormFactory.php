<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'post_id' => mt_rand(1, 7),
            'user_id' => mt_rand(1, 5),
            'nama' => fake()->name(),
            'nim' => $this->faker->sentence(2, 3),
            'departemen' => $this->faker->sentence(2, 3),
            'fakultas' => $this->faker->sentence(2, 3),
            'alasan' => $this->faker->sentence(2, 3),
            'status' => 0

        ];
    }
}
