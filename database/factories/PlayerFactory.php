<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = Team::count();
        return [
            "id"=>$this->faker->numberBetween(10000000,25000000),
            "name"=>$this->faker->name,
            "lastname"=>$this->faker->lastName,
            "birthday"=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            "number"=>$this->faker->numberBetween(1,20),
            "age"=>$this->faker->numberBetween(18,40),
            "gols"=>$this->faker->numberBetween(0,5),
            "play"=>$this->faker->boolean($chanceOfGettingTrue = 50),
            "team_id"=>$this->faker->numberBetween(1,$count),
        ];
    }
}
