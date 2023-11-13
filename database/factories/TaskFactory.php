<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array     // aggiunge, tramite comando, campi al database che avreanno un titolo "fake" e completed a false
    {
        return [
            'title' => $this->faker->sentence(),
            'completed' => false,
            'creator_id' => User::factory()
        ];
    }
}
