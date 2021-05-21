<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->name, 
            "description"=>$this->faker->text($maxNbChars=100), 
            "image"=>"/images/principal/sinImagen.jpeg",
            "price"=>$this->faker->numberBetween(10,50),
            "location"=>$this->faker->text($maxNbChars=50), 
            "typeservices_id"=>$this->faker->numberBetween(1,4),
            "teacher"=>$this->faker->name, 
        ];
    }
}
