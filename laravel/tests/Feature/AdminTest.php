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
        $response = $this->authRequest('GET', route('Game_serverList'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }

    public function testMapList()
    {
        $response = $this->authRequest('GET', route('Game_mapList'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }

    public function testNodeList()
    {
        $response = $this->authRequest('GET', route('Game_nodeList'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }


    public function testNoticeList()
    {
        $response = $this->authRequest('GET', route('Game_noticeAll'), []);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }

    public function testCreatedNotice()
    {
        $data = [
            "content" => "<h1>test1</h1><h2><span style=\"color: rgb(230, 0, 0);\">fffff我是个帅哥</span></h2>",
            "desc" => "test1"
        ];
        $response = $this->authRequest('POST', route('Game_noticeCreate'), $data);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }

    public function testGetUser(){
        $data = [
            'userId' => '1001720001',
            // 'nickname' => '纪连虎'
        ];
        $response = $this->authRequest('get', route('Game_getUser'), $data);
        $response->assertJson([
            'code' => 200
        ]);
        $response->dump();
    }
}
