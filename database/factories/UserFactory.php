<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'id'         => $this->faker->uuid,
            'name'       => $name,
            'nickname'   => $name,
            'gender_id'  => rand(1, 2),
            'manager_id' => $this->faker->uuid,
        ];
    }

    /**
     * Indicate that the user is male.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function male()
    {
        return $this->state(function (array $attributes) {
            return [
                'gender_id' => 1,
            ];
        });
    }

    /**
     * Indicate that the user is female.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function female()
    {
        return $this->state(function (array $attributes) {
            return [
                'gender_id' => 2,
            ];
        });
    }
}
