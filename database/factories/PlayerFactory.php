<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' =>$this->faker->name,
            'last_name' =>$this->faker->name,
            'dob' =>$this->faker->date,
            'player_number' =>$this->faker->randomDigit,
            'img'=>'placeholder.png'
            
            
        ];
    }
}
