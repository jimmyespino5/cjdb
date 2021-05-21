<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy1@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"1"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy2@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"2"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy3@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"3"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy4@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"4"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy5@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"5"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy6@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"6"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy7@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"7"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy8@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"8"]);
        User::create(["name"=>"Jimmy Espino","email"=>"jimmy9@gmail.com","password"=>"$2y$10$4u8KWRG.2gghTcLKONknXOu3rXoom6eEPS065EDt7nD3IJJ/kIXea","role"=>"9"]);
    }
}
