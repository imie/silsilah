<?php

namespace Database\Factories;

use App\Couple;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoupleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Couple::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'         => $this->faker->uuid,
            'husband_id' => function () {
                return User::factory()->male()->create()->id;
            },
            'wife_id'    => function () {
                return User::factory()->female()->create()->id;
            },
            'manager_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
