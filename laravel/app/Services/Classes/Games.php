<?php

namespace Services\Classes;

class Games
{


    private $api;
    private $basic;

    /** @var array $secret */
    private $secret;


    const status_ok = 0;


    public function __construct()
    {
        $this->api      = config("game.api");
        $this->basic    = config('game.url');
        $this->secret   = config('game.secret');
        
        loadLibrary('curl.class');
    }

    /**
     * call game command
     * @param string $method get|post
     * @param string $command
     * @param array $params
     * @return false|object
     */
    protected function command($method, $command, $params = [])
    {
        $curl = new \Curl();
        $curl->setSsl();
        $curl->setTimeout(5, 30);

        $this->getSign($params);

        $url = $this->basic . $this->api[$command];

        $json = json_encode($params);

        $curl->addHeader('Content-Type: application/json; charset=utf-8');
        $curl->addHeader('Content-Length:' . strlen($json));

        $data = call_user_func([$curl, $method], $url, $json);
        $statusCode = $curl->getHttpCode();
        $curl->close();

        $result = json_decode($data);
        if ($this->check($result)) {
            return $result;
        }
        logger(
            "The {$command} interface call failed!httpCode={$statusCode}",
            [$params, objectToArray($result)]
        );
        return false;
    }

    /**
     * 提交参数签名
     *
     * @param array $params
     * @return void
     */
    protected function getSign(array &$params)
    {
        $keyIndex = rand(0, count($this->secret));
        $md5Count = rand(0, 2);

        $sign = '';

        $params['key'] = $keyIndex + 1;
        $params['md5'] = $md5Count;

        ksort($params);
        $sign = http_build_query($params) . '&key=' . $this->secret[$keyIndex];

        for ($i = 0; $i < $md5Count; $i++) {
            $sign = md5($sign);
        }

        $params['sign'] = strtoupper($sign);
    }

    /**
     * check result success
     * @param object $result
     * @return boolean
     */
    public function check($result)
    {
        if (is_object($result)) {
            if (isset($result->code)) {
                return $result->code == self::status_ok;
            }
        }
        return false;
    }


    /**
     * 获取区服信息
     *
     * @return array|bool
     */
    public function getAllZoneSer()
    {
        $ret = $this->command('post', 'game.get_all_ser');
        if ($ret)
            $ret = json_decode($ret->result, true);
        return $ret;
    }

    /**
     * 获取服务器列表
     *
     * @return string|bool
     */
    public function getServerListURL()
    {
        $ret = $this->command('post', 'game.get_url');
        if ($ret)
            $ret = $ret->url;
        return $ret;
    }

    /**
     * 设置服务器列表
     *
     * @param string $url 服务器列表json文件地址
     * @return bool
     */
    public function setServerList(string $url)
    {

        $ret = $this->command('post', 'game.set_url', ['url' => $url]);

        return $this->check($ret);
    }

    /**
     * 发送合服请求
     *
     * @param integer $srcId 源区服ID
     * @param integer $desId 目标区服ID
     * @return bool
     */
    public function setHefu(int $srcId, int $desId)
    {
        $ret = $this->command('post', 'game.set_hefu', ['src_id' => $srcId, 'des_id' => $desId]);
        return $this->check($ret);
    }

    /**
     * 获取合服信息
     *
     * @return Hefu[]
     */
    public function getHefu()
    {

        $ret = $this->command('post', 'game.get_hefu');
        $list = explode('|', $ret->result);

        foreach ($list as $key => $value) {
            $list[$key] = new Hefu($value);
        }

        return $list;
    }


    /**
     * 删除/撤销合服请求
     *
     * @param int $srcId 源服务器ID
     * @return bool
     */
    public function delHefu(int $srcId)
    {
        $ret = $this->command('post', 'game.del_hefu', ['src_id' => $srcId]);
        return $this->check($ret);
    }


    /**
     * 新增/更新区服信息
     *
     * @param integer $zoneId 区服ID
     * @param string $name 服务器名
     * @param string $addr 服务器地址
     * @param integer $port 端口号
     * @param integer $status 状态 0未开放|1开放|3火爆
     * @param string $openTime 开服时间
     * @param string $nodeName 节点名
     * @return bool
     */
    public function updateZoneServer(int $zoneId, string $name, string $addr, int $port, int $status, string $openTime, string $nodeName)
    {
        $params = [
            "zone_id"   => $zoneId,
            "name"      => $name,
            "addr"      => $addr,
            "port"      => $port,
            "status"    => $status,
            "open_time" => $openTime,
            "node_name" => $nodeName
        ];

        $ret = $this->command('post', 'game.update_zone_ser', $params);
        return $this->check($ret);
    }


    /**
     * 发送邮件
     *
     * @param string $title 邮件标题
     * @param string $content 邮件内容
     * @param string $uIds 接受玩家id,逗号分隔
     * @param string $attach 附加道具信息
     * @return bool
     */
    public function sendMail(string $title, string $content, string $uids, string $attach)
    {

        $params = [
            "title"   => $title,
            "content" => $content,
            "uids"    => $uids,
            "attach"  => $attach
        ];

        $ret = $this->command('post', 'game.mail', $params);
        return $this->check($ret);
    }


    /**
     * 发送全服邮件
     *
     * @param string $title 邮件标题
     * @param string $content 邮件内容
     * @param integer $zone 区服ID
     * @param string $attach 附加道具
     * @param integer $validDay 有效天数
     * @param boolean $allUser 是否后面注册的玩家也能收到邮件
     * @param string $nodeName 节点名称
     * @return bool
     */
    public function sendZoneMail(string $title, string $content, int $zone, string $attach, int $validDay, bool $allUser, string $nodeName)
    {

        $params = [
            "title"     => $title,
            "content"   => $content,
            "zone"      => $zone,
            "attach"    => $attach,
            "valid_day" => $validDay,
            "all_user"  => (int)$allUser,
            "nodename"  => $nodeName,
        ];

        $ret = $this->command('post', 'game.zone_mail', $params);
        return $this->check($ret);
    }


    /**
     * 撤回全服邮件
     *
     * @param integer $zone 区服ID
     * @param integer $mailId 邮件ID
     * @return bool
     */
    public function delZoneMail(int $zone, int $mailId)
    {

        $params = [
            'zone'    => $zone,
            'mail_id' => $mailId
        ];

        $ret = $this->command('post', 'game.del_zone_mail', $params);
        return $this->check($ret);
    }


    /**
     * 获取关服维护时间
     *
     * @return object|bool
     */
    public function getStopServerTime(){
        $ret = $this->command('post','game.get_stop_ser_time');
        return $ret;
    }


    /**
     * 设置停服维护时间
     *
     * @param integer $id 节点ID
     * @param integer $stopSerTime 设置停服维护时间
     * @return bool
     */
    public function setStopServerTime(int $id,int $stopSerTime){

        $params = [
            'id'               => $id,
            'stop_server_time' => $stopSerTime
        ];

        $ret = $this->command('post','game.set_stop_ser_time',$params);
        return $this->check($ret);
    }

    /**
     * 新增/更新逻辑节点
     *
     * @param integer $id 节点ID
     * @param string $name　节点名
     * @param string $addr　服务器地址
     * @param integer $port　服务器端口
     * @param string $mark　备注
     * @return bool　
     */
    public function updateNode(int $id, string $name, string $addr, int $port, string $mark)
    {

        $params = [
            'id'   => $id,
            'name' => $name,
            'addr' => $addr,
            'port' => $port,
            'mark' => $mark
        ];

        $ret = $this->command('post', 'game.update_node', $params);
        return $this->check($ret);
    }

    /**
     * 获取所有节点
     *
     * @return array|false
     */
    public function getAllNode()
    {

        $ret = $this->command('post', 'game.get_all_node');
        if ($ret)
            $ret = json_decode($ret->result, true);
        return $ret;
    }


    /**
     * 删除逻辑节点
     *
     * @param integer $id 节点ID
     * @return bool
     */
    public function delNode(int $id)
    {
        $ret = $this->command('post', 'game.del_node', ['id' => $id]);
        return $this->check($ret);
    }


    /**
     * 删除区服信息
     *
     * @param integer $zoneId 区服ID
     * @return bool
     */
    public function delServer(int $zoneId)
    {
        $ret = $this->command('post', 'game.del_ser', ['zone_id' => $zoneId]);
        return $this->check($ret);
    }

    /**
     * 获取所有白名单
     *
     * @return array|false
     */
    public function getAllWhiteList(){
        $ret = $this->command('post','game.get_all_wlist');
        if($ret)
            $ret = json_decode($ret->result,true);
        return $ret;
    }


    /**
     * 新增白名单
     *
     * @param integer $accountId 账号ID
     * @param string $mark　备注信息
     * @return bool
     */
    public function addWhiteList(int $accountId, string $mark)
    {

        $params = [
            'account_id' => $accountId,
            'mark'       => $mark
        ];

        $ret = $this->command('post', 'game.add_wlist', $params);
        return $this->check($ret);
    }


    /**
     * 删除白名单
     *
     * @param integer $accountId 账号ID
     * @return bool
     */
    public function delWhiteList(int $accountId)
    {
        $ret = $this->command('post', 'game.add_wlist', ['account_id' => $accountId]);
        return $this->check($ret);
    }


    /**
     * 获取账号信息
     *
     * @param string $accountName 账号名
     * @return object|false
     */
    public function getAccountInfo(string $accountName)
    {
        $ret = $this->command('post', 'user.info', ['account_name' => $accountName]);
        if ($ret)
            $ret = json_decode($ret->result);
        return $ret;
    }


    /**
     * 通过角色ID获取账号信息
     *
     * @param integer $uid 角色ID
     * @param string $nickName 角色昵称
     * @return object|false
     */
    public function getAccountInfoByUid(int $uid, string $nickName)
    {
        $params = [
            'uid'  => $uid,
            'nick' => $nickName
        ];

        $ret = $this->command('post', 'user.by_uid', $params);
        if ($ret)
            $ret = json_decode($ret->result);
        return $ret;
    }


    /**
     * 新增轮回洞地图
     *
     * @param integer $mapId 地图ID
     * @param string $nodeName 地图服务器节点名
     * @param string $name 地图名字
     * @param integer $mode 地图模式
     * @param string $mark 备注
     * @return bool
     */
    public function AddLunhuiMap(int $mapId, string $nodeName, string $name, int $mode, string $mark)
    {

        $params = [
            'map_id'   => $mapId,
            'nodename' => $nodeName,
            'name'     => $name,
            'mode'     => $mode,
            'mark'     => $mark
        ];

        $ret = $this->command('post', 'game.add_map', $params);
        return $this->check($ret);
    }

    
    /**
     * 获取所有轮回洞地图
     *
     * @return array|false
     */
    public function getLunhuiMap()
    {

        $ret = $this->command('post', 'game.get_map');
        if ($ret)
            $ret = json_decode($ret->result, true);
        return $ret;
    }


    /**
     * 删除轮回洞地图
     *
     * @param integer $mapId 地图ID
     * @return bool
     */
    public function delLunhuiMap(int $mapId)
    {
        $ret = $this->command('post', 'game.del_map', ['map_id' => $mapId]);
        return $this->check($ret);
    }


    /**
     * 更新轮回洞地图
     *
     * @param integer $mapId 地图ID
     * @param string $nodeName 节点名
     * @param string $name 地图名
     * @param string $mark 备注
     * @return void
     */
    public function updateLunhuiMap(int $mapId, string $nodeName, string $name, string $mark)
    {

        $params = [
            'map_id'   => $mapId,
            'nodename' => $nodeName,
            'name'     => $name,
            'mark'     => $mark
        ];

        $ret = $this->command('post', 'game.update_map', $params);
        return $this->check($ret);
    }


    /**
     * 获取全部区服轮回洞配置
     *
     * @return array|false
     */
    public function getAllLunhuiMap(){
        $ret = $this->command('post','game.zone_ser_map');
        if($ret)
            $ret = json_decode($ret->result,true);
        return $ret;
    }

    /**
     * 更新区服轮回洞地图
     *
     * @param integer $zoneId 区服ID
     * @param integer $mapId 地图ID
     * @param integer $mapVaryId 变异地图ID
     * @return bool
     */
    public function updateZoneServerLunhuiMap(int $zoneId, int $mapId, int $mapVaryId)
    {

        $params = [
            'zone_id'     => $zoneId,
            'map_id'      => $mapId,
            'map_very_id' => $mapVaryId
        ];

        $ret = $this->command('post', 'game.update_zone_ser_map', $params);
        return $this->check($ret);
    }


    /**
     * 获取角色信息
     *
     * @param integer $uid 角色ID
     * @param string $nickname　角色昵称
     * @return object|false
     */
    public function getRoleInfo(int $uid, string $nickname)
    {

        $ret = $this->command('post', 'user.get_role_info', ['uid' => $uid, 'nick' => $nickname]);
        if ($ret)
            $ret = json_decode($ret->result);
        return $ret;
    }


    /**
     * 更新账号/角色状态
     *
     * @param integer $type 类型
     * @param integer $uid 账号id/角色Id
     * @param integer $status 类型 0正常|2黑名单|3封号|4禁言
     * @return bool
     */
    public function updateUserStatus(int $type, int $uid, int $status)
    {

        $params = [
            'type'   => $type,
            'uid'    => $uid,
            'status' => $status
        ];

        $ret = $this->command('post', 'user.update_status', $params);
        return $this->check($ret);
    }



}
