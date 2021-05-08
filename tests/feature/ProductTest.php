<?php

namespace Tests\Feature\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testGetProduct()
    {
        $this->seed();
        $response = $this->json('POST', 'api/auth/login', ['email' => 'admin@admin.com', 'password' => '123456']);
        $token = json_decode($response->getContent())->access_token;
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->json('get', '/api/product/1', [], $headers);
        $response->assertStatus(200);
    }


}
