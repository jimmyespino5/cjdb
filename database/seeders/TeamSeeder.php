<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create(["name"=>"The Bliss", "color"=>"negro y verde", "logo"=>"/images/equipos/vacio.png" ,"sport"=>2, "user_id"=>5]);
        Team::create(["name"=>"Trabuco", "color"=>"naranja y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>2,"user_id"=>1]);
        Team::create(["name"=>"Cobutra", "color"=>"negro y naranja", "logo"=>"/images/equipos/vacio.png", "sport"=>2,"user_id"=>3]);
        Team::create(["name"=>"No se", "color"=>"azul", "logo"=>"/images/equipos/vacio.png", "sport"=>2,"user_id"=>2]);
        Team::create(["name"=>"Delta", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>2,"user_id"=>4]);
        Team::create(["name"=>"Nueva Venezuela", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>1,"user_id"=>1]);
        Team::create(["name"=>"Don Bosco", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>1,"user_id"=>2]);
        Team::create(["name"=>"La Castellana", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>1,"user_id"=>3]);
        Team::create(["name"=>"Deportivo La Trinidad", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>1,"user_id"=>4]);
        Team::create(["name"=>"New Castle", "color"=>"azul y negro", "logo"=>"/images/equipos/vacio.png", "sport"=>1,"user_id"=>5]);
    }
}
