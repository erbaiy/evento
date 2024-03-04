<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['valide', 'invalide']),
            'typeAccept' => $this->faker->randomElement(['auto', 'manuelle']),
            'location' => $this->faker->address,
            'category_id' => Category::inRandomOrder()->first()->id,
            'places' => $this->faker->numberBetween(1, 100),
        ];
    }
}
