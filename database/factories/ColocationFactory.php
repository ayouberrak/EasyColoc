<?php

namespace Database\Factories;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colocation>
 */
class ColocationFactory extends Factory
{
    protected $model = Colocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'colocation_id' => 'COL-' . Str::upper(Str::random(8)),
            'name' => fake()->city() . ' Shared Home',
            'description' => fake()->paragraph(),
            'status' => 'active',
            'token' => Str::random(20),
            'user_id' => User::factory(),
        ];
    }
}
