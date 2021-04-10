<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "description" => $this->faker->text(),
            "image" => $this->faker->imageUrl(),
            "address" => $this->faker->randomElement(["Kasarani Sports stadium", "Nairobi national park", "Karura forest", "Carnivore grounds"]),
            "city" => "Nairobi",
            "start_date" => $this->faker->dateTimeThisMonth(),
            "category" => $this->faker->randomElement(["tour", "sport", "concert", "religious"]),
            "featured" => $this->faker->randomElement([true, false]),
            "user_id" => 1
        ];
    }
}
