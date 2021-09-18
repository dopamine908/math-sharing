<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    protected static int $id = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        self::$id++;

        return [
            'id' => self::$id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'platform' => 'Google',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
