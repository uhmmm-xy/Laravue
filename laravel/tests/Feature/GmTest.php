<?php

namespace Tests\Feature;

use App\Models\Game\ServerModel;
use App\Services\Game\ServerService;
use Services\Classes\CosClient;
use Services\Facades\Games;
use Tests\TestCase;

class GmTest extends TestCase
{
    public function __construct()
    {
        loadLibrary('common');
        parent::__construct();
    }
    /**
     * 测试获取全区服数据信息
     *
     * @return void
     */
    public function testGetAllZoneServer(){
        $ret = Games::getAllLunhuiMap();
        var_dump($ret);
        return $this->assertTrue(true);
    }

    public function testGetNode(){
        $service = new ServerService(new ServerModel());
        $list = $service->getZoneList();
        var_dump($list);
        return $this->assertTrue(true);
    }

    public function testIsIDCard(){
        $ret = is_idCard('413001199313023014');
        return $this->assertIsBool($ret);
    }

    public function testIp(){
        $ret = ip_addr('172.20.224.1');
        var_dump($ret);
        return $this->assertIsBool(true);
    }

    public function testUpdateCosClient(){
        $ret = (new CosClient())->upLoadJson('{test}','test.json');
        var_dump($ret);
        return $this->assertIsBool(true);
    }

    public function testDeleteCosClient(){
        $ret = (new CosClient())->deleteObj('json/test.json');
        var_dump($ret);
        return $this->assertIsBool(true);
    }

    public function testJsonDecode(){
        $jsonStr = "{\"goldCount\":300}";
        $ret = json_decode($jsonStr,true);
        var_dump($ret);
        return $this->assertIsArray($ret);
    }
}
