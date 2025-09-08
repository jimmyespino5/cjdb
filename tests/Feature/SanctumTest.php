<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SanctumTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    //use RefreshDatabase;

    public function test_user_can_login(): void
    {
        $user = User::where('email','isidoro@gmail.com')->get()->first();
        //dd($user);
        $response = $this->post('/api/login',[
            'email' => $user->email,
            'password' => '12345678'
        ]);

        $response->assertStatus(200);
    }
}
