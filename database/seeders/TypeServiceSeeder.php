<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TypeService;

class TypeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeService::create(["name"=>"Tarea Dirigida"]);
        TypeService::create(["name"=>"Deportivo"]);
        TypeService::create(["name"=>"Cultural"]);
        TypeService::create(["name"=>"Educativo"]);
    }
}
