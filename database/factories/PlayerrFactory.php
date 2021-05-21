<?php
namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Player;
use Faker\Generator as Faker;
use App\Models\Team;

$factory->define(App\Models\Player::class, function (Faker $faker) {
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
});
