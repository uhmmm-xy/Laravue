<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function testLogin()
    {
        $data = [
            'username' => "admin",
            'password' => '123456',
        ];

        $response = $this->json("POST", route("adminLogin"), $data);
        $response->assertJson([
            'code' => 200
        ]);
        cache(['admin_token' => $response->json("data.token")], 3600);
    }

    public function authRequest($method, $uri, $data = [])
    {
        return $this->json($method,  $uri, $data, [
            'Authorization'   => 'bearer ' . cache("admin_token"),
            'Accept'          => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'zh-CN,zh;q=0.9',
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetServerList()
    {
        $response = $this->authRequest('GET', route('serverList'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }

    public function testMapList(){
        $response = $this->authRequest('GET', route('mapList'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }
}
