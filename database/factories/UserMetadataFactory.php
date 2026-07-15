<?php

namespace Database\Factories;

use App\UserMetadata;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMetadataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMetadata::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'      => $this->faker->uuid,
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'key'     => $this->faker->name,
            'value'   => $this->faker->sentence,
        ];
    }
}
