<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street_name' => $this->faker->colorName,
            'street_number' => $this->faker->numberBetween(1,500),
            'city' => $this->faker->city,
            'state' => $this->faker->countryCode,
            'country' => $this->faker->country,
            'post_code' => $this->faker->postcode,
        ];
    }
}
