<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["name"=>"Libre"]);
        Category::create(["name"=>"Compota"]);
        Category::create(["name"=>"Pre-Infantil B"]);
        Category::create(["name"=>"Pre-Infantil A"]);
        Category::create(["name"=>"Infantil C"]);
        Category::create(["name"=>"Infantil B"]);
        Category::create(["name"=>"Infantil A"]);
    }
}
