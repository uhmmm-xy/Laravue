<?php

namespace Tests\Feature;

use App\Models\Game\ServerModel;
use App\Models\Game\UserModel;
use App\Services\Game\ServerService;
use Services\Classes\CosClient;
use Services\Facades\Games;
use Services\GameLog\GameLog;
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

    public function testGameLog(){
        $str = "2022-01-17 05:35:17|online_log|1642368917120||0|0||0|0|1|0|0|0";
        $json = GameLog::decode($str);
        dd($json);
        return $this->assertIsArray($json);
    }

    public function testCollect(){
        $array = [
            "t1"=>1,
            "t2"=>2,
            "t3"=>3,
            "t4"=>4,
        ];

        $c = collect($array);

        dd($c->only(["t1","t3"]));
        return $this->assertIsArray($array);
    }

    public function testGetUser(){
        $user = UserModel::find(17);
        dd($user);
        return $this->assertIsBool(true);
    }

    public function testDe(){
        $int = 6890;
        loadLibrary("common");
        $num = division($int,3600);
        dd($num);
        return $this->assertIsInt($num);
    }
}
