# 数据字典 {#menu}

---

| ·      | 表名                    | 引擎     | 类型      | 备注                                    |
| ------ | ----------------------- | -------- | --------- | --------------------------------------- |
| **1**  | **game_user**           | `InnoDB` | _Mysql_   | [用户表](#game_user)                    |
| **2**  | **game_role**           | `InnoDB` | _Mysql_   | [角色表](#game_role)                    |
| **3**  | **game_channel**        | `InnoDB` | _Mysql_   | [渠道表](#game_channel)                 |
| **4**  | **game_prop**           | ~~\\~~   | _MongoDB_ | [道具表](#game_prop)                    |
| **5**  | **game_activity**       | `InnoDB` | _Mysql_   | [活动表](#game_activity)                |
| **6**  | **game_activity_cfg**   | ~~\\~~   | _MongoDB_ | [活动配置表](#game_activity_cfg)        |
| **7**  | **game_server**         | `InnoDB` | _Mysql_   | [服务器表](#game_server)                |
| **8**  | **game_node**           | `InnoDB` | _Mysql_   | [服务器节点](#game_node)                |
| **9**  | **game_merge_log**      | `InnoDB` | _Mysql_   | [合服日志](#game_merge_log)             |
| **10** | **game_gift_code**      | `InnoDB` | _Mysql_   | [礼品码](#game_gift_code)               |
| **11** | **game_gift_cfg**       | `InnoDB` | _Mysql_   | [礼品码配置](#game_gift_cfg)            |
| **12** | **game_gift_log**       | `InnoDB` | _Mysql_   | [礼品码领取日志](#game_gift_log)        |
| **13** | **game_notice**         | `InnoDB` | _Mysql_   | [系统公告](#game_notice)                |
| **14** | **game_ser_mail**       | `InnoDB` | _Mysql_   | [全服邮件](#game_ser_mail)              |
| **15** | **game_user_mail**      | `InnoDB` | _Mysql_   | [玩家邮件](#game_user_mail)             |
| **16** | **game_order**          | `InnoDB` | _Mysql_   | [充值订单](#game_order)                 |
| **17** | **game_shop**           | `InnoDB` | _Mysql_   | [商品列表](#game_shop)                  |
| **18** | **game_user_prop**      | ~~\\~~   | _MongoDB_ | [玩家道具表](#game_user_prop)           |
| **19** | **game_user_prop_log**  | ~~\\~~   | _MongoDB_ | [玩家道具变动日志](#game_user_prop_log) |
| **20** | **game_user_event_log** | ~~\\~~   | _MongoDB_ | [玩家事件日志](#game_user_event_log)    |
| **21** | **game_map**            | `InnoDB` | _Mysql_   | [游戏地图表](#game_map)                 |
| **22** | **task_cfg**            | ~~\\~~   | _MongoDB_ | [任务配置](#task_cfg)                   |
| **23** | **task_cfg**            | ~~\\~~   | _MongoDB_ | [任务配置](#game_pay_channel)           |

---

#### 用户表 : {#game_user}

[begin]:game_user
---

> [Return :top:](#menu)

> `game_user` for **MySql**

---

| col                     | type           | key                                        | mark                                |
| ----------------------- | -------------- | ------------------------------------------ | ----------------------------------- |
| **id**                  | `int(11)`      | _pk,increment_                             | ~\\~                                |
| **user_name**           | `int(11)`      | _unique_                                   | _用户名_                            |
| **union_id**            | `varchar(32)`  | _unique_                                   | _平台 ID_                           |
| **open_id**             | `varchar(32)`  | _unique_                                   | _渠道 ID_                           |
| **channel**             | `int(11)`      | _this:left_right_arrow:game_channel.id_    | _渠道来源_                          |
| **phone**               | `varchar(20)`  | _phone_                                    | _用户手机号_                        |
| **email**               | `varchar(100)` | _email_                                    | _用户 Email_                        |
| **gender**              | `int(11)`      | _def:2_                                    | _用户性别 1:male,0:female_          |
| **user_type**           | `int(11)`      | _def:1_                                    | _用户类别 1:普通玩家 2:小 R 3:大 R_ |
| **gold**                | `int(11)`      | _def:0_                                    | _赠送代币剩余_                      |
| **jewel**               | `int(11)`      | _def:0_                                    | _充值代币剩余_                      |
| **consume_gold**        | `int(11)`      | _def:0_                                    | _赠送代币使用情况_                  |
| **consume_jewel**       | `int(11)`      | _def:0_                                    | _充值代币使用情况_                  |
| **total_recharge**      | `int(11)`      | _not null,def:0_                           | _用户总充值_                        |
| **first_recharge**      | `int(11)`      | _not null,def:0_                           | _首充金额_                          |
| **first_recharge_date** | `datetime`     | _def:null_                                 | _首充时间_                          |
| **last_recharge**       | `int(11)`      | _not null,def:0_                           | _上次充值金额_                      |
| **last_recharge_date**  | `datetime`     | _def:null_                                 | _上次充值时间_                      |
| **status**              | `int(11)`      | _def:1 _                                   | _账号状态 1:none,2:disable,3:gm_    |
| **role_count**          | `int(11)`      | _def:0_                                    | _角色数量_                          |
| **last_login_time**     | `datetime`     | _def:null_                                 | _上一次登录时间_                    |
| **last_login_ser**      | `int(11)`      | _def:0_                                    | _上一次登录的服务器_                |
| **last_login_role**     | `int(11)`      | _def:0 this:left_right_arrow:game_role.id_ | _上一次登录的角色_                  |
| **last_login_ip**       | `varchar(11)`  | _def:null_                                 | _上次登录的 ip_                     |
| **device_num**          | `varchar(50)`  | _def:null_                                 | _设备号_                            |
| **created_at**          | `datetime`     | _def:created_at_                           | _创建时间_                          |
| **updated_at**          | `datetime`     | _def:updated_at_                           | _修改时间_                          |

[end]:game_user
---

#### 角色表 {#game_role}

[begin]:game_role
---

> [Return :top:](#menu)

> `game_role` for **MySql**

---

| col               | type           | key                                    | mark                     |
| ----------------- | -------------- | -------------------------------------- | ------------------------ |
| **id**            | `int(11)`      | _pk,increment_                         | ~~\\~~                   |
| **role_id**       | `varchar(100)` | _unique_                               | 游戏服 ID                |
| **role_name**     | `varchar(120)` | _unique_                               | 角色名                   |
| **ser_id**        | `int(11)`      | _this:left_right_arrow:game_server.id_ | _所属区服_               |
| **user_id**       | `int(11)`      | _this:left_right_arrow:game_user.id_   | _所属用户_               |
| **status**        | `int(11)`      | _def:0_                                | _角色状态 0：node,1:xxx_ |
| **vip**           | `int(11)`      | _def:0_                                | _vip 等级_               |
| **level**         | `int(11)`      | _def:0_                                | _角色等级_               |
| **gold**          | `int(11)`      | _def:0_                                | _赠送代币_               |
| **jewel**         | `int(11)`      | _def:0_                                | _充值代币_               |
| **consume_gold**  | `int(11)`      | _def:0_                                | _赠送代币使用情况_       |
| **consume_jewel** | `int(11)`      | _def:0_                                | _充值代币使用情况_       |
| **exp**           | `text`         | _def:null_                             | _其他属性_               |
| **created_at**    | `datetime`     | _def:created_at_                       | _创建时间_               |
| **updated_at**    | `datetime`     | _def:updated_at_                       | _修改时间_               |

[end]:game_role
---
#### 渠道表 {#game_channel}

[begin]:game_channel
---

> [Return :top:](#menu)

> `game_channel` for **MySql**

---

| col               | type           | key              | mark                     |
| ----------------- | -------------- | ---------------- | ------------------------ |
| **id**            | `int(11)`      | _pk,increment_   | ~~\\~~                   |
| **channel_name**  | `varchar(100)` | _not null_       | _渠道名称_               |
| **channel_alias** | `varchar(100)` | _not null_       | _渠道别名_               |
| **mark**          | `text`         | _def:null_       | _渠道备注_               |
| **exp**           | `text`         | _def:null_       | _渠道附加参数_           |
| **status**        | `int(11)`      | _def:0_          | _渠道状态 0:启用,1:禁用_ |
| **created_at**    | `datetime`     | _def:created_at_ | _创建时间_               |
| **updated_at**    | `datetime`     | _def:updated_at_ | _修改时间_               |

[end]:game_channel
---

#### 道具表 {#game_prop}

[begin]:game_prop

---

> [Return :top:](#menu)

> `game_prop` for **MongoDB**

---

```json

{
    "id": 1,                         //道具ID 整形
    "name": "string",                //道具名称 字符串
    "type": enum,                    //道具类型 枚举 { 1:资源,2:材料,3:装备... }
    "sub_type": enum,                //道具详细类型 枚举 {0:无,1:工会,2:功法...}
    "tab":enum,                      //道具分栏 枚举 {1:装备,2:材料,3:消耗品...}
    "quality":[
        {
            "level": 1,              //品质等级
            "color": enum,           //品质颜色
            "attr" : {
                "price":1,           //价值
                "score":1000,        //评分
                "option":[enum...],  //操作参数 array(枚举){1:来源,2:详情,3:出售...}
                "desc":"string",     //道具描述
                "res_list":[enum...] //获取途径 array(枚举){1:活动,2:副本,3:xxx....}
                ...
            }                        //其他属性
        },
    ]                                //品质集合
    ...,
    "created_at":datetime,           //创建时间
    "updated_at":datetime,           //修改时间

}

```
[end]:game_prop

---

#### 活动表 {#game_activity}

[begin]:game_activity

---

> [Return :top:](#menu)

> `game_activity` for **MySql**

---

| col            | type           | key            | mark                                   |
| -------------- | -------------- | -------------- | -------------------------------------- |
| **id**         | `int(11)`      | _pk,increment_ | ~~\\~~                                 |
| **name**       | `varchar(100)` | _unique_       | _活动名_                               |
| **status**     | `int(11)`      | _def:0_        | _活动状态 0:关闭,1:开启,2:等待开启..._ |
| **ord**        | `int(11)`      | _def:1_        | _活动排序_                             |
| **model**      | `varchar(100)` | _not null_     | _活动模板_                             |
| **times**      | `varchar(100)` | _not null_     | _活动时间_                             |
| **begin_time** | `datetime`     | _not null_     | _开始时间_                             |
| **end_time**   | `datetime`     | _def:null_     | _结束时间,为 null 则无时间限制_        |
| **created_at** | `datetime`     | _not null_     | _创建时间_                             |
| **updated_at** | `datetime`     | _not null_     | _修改时间_                             |

[end]:game_activity

---
#### 活动配置表 {#game_activity_cfg}

[begin]:game_activity_cfg
---

> [Return :top:](#menu)

> `game_activity_cfg` for **MongoDB**

---

```json

{
    "id":unique_id,                       //唯一ID
    "activity_id":1,                      //MySql逻辑ID
    "shadow":"#FF10FF",                   //描边颜色
    "desc":"ffff<c color=fff000>fff</c>", //描述
    "time_list":[],                       //道具ID数组
    "task_list":[],                       //任务数组
    ...,
    "extend_params":{}                    //拓展参数 object对象
}

```
[end]:game_activity_cfg

---

#### 服务器表 {#game_server}

[begin]:game_server
---

> [Return :top:](#menu)

> `game_server` for **MySql**

---

| col             | type           | key                                    | mark                              |
| --------------- | -------------- | -------------------------------------- | --------------------------------- |
| **id**          | `int(11)`      | _pk,increment_                         | ~~\\~~                            |
| **server_name** | `varchar(100)` | _not null_                             | _服务器名_                        |
| **ip**          | `varchar(100)` | _not null_                             | _服务器地址_                      |
| **port**        | `int(11)`      | _not null_                             | _服务器端口_                      |
| **node_id**     | `int(11)`      | _this:left_right_arrow:game_node.id_   | _服务器节点 ID_                   |
| **index**       | `int(11)`      | _def:0_                                | _游戏服 ID_                       |
| **notice_id**   | `int(11)`      | _this:left_right_arrow:game_notice.id_ | _公告 ID_                         |
| **open_time**   | `datetime`     | _def:null_                             | _开服时间,null 为不限制_          |
| **des_id**      | `int(11)`      | _this:left_right_arrow:this.id_        | _合服目标 ID_                     |
| **status**      | `int(11)`      | _def:0_                                | _服务器状态,0:停用,1:开服,2:维护_ |
| **created_at**  | `datetime`     | _def:now_                              | _创建时间_                        |
| **updated_at**  | `datetime`     | _def:now_                              | _修改时间_                        |

[end]:game_server
---

#### 服务器节点 {#game_node}

[begin]:game_node

---

> [Return :top:](#menu)

> `game_node` for **MySql**

---

| col                | type           | key            | mark           |
| ------------------ | -------------- | -------------- | -------------- |
| **id**             | `int(11)`      | _pk,increment_ | ~~\\~~         |
| **name**           | `varchar(50)`  | _not null_     | _节点名_       |
| **ip**             | `varchar(20)`  | _not null_     | _节点地址_     |
| **port**           | `int(11)`      | _not null_     | _端口号_       |
| **node_stop_time** | `datetime`     | _def:null_     | _节点停止时间_ |
| **mark**           | `varchar(500)` | _def:null_     | _节点备注_     |
| **created_at**     | `datetime`     | _def:now_      | _创建时间_     |
| **updated_at**     | `datetime`     | _def:now_      | _修改时间_     |

[end]:game_node

---

#### 合服日志 {#game_merge_log}

[begin]:game_merge_log

---

> [Return :top:](#menu)

> `game_merge_log` for **MySql**

---

| col            | type            | key                                    | mark                         |
| -------------- | --------------- | -------------------------------------- | ---------------------------- |
| **id**         | `int(11)`       | _pk,increment_                         | ~~\\~~                       |
| **source_id**  | `int(11)`       | _this:left_right_arrow:game_server.id_ | _来源服 ID_                  |
| **target_id**  | `int(11)`       | _this:left_right_arrow:game_server.id_ | _目标服 ID_                  |
| **mark**       | `varchar(5000)` | _def:null_                             | _合服备注_                   |
| **take_time**  | `datetime`      | _def:null_                             | _生效时间,null 不生效_       |
| **status**     | `int(1)`        | _def:0_                                | _执行状态,0:未执行,1:已执行_ |
| **created_at** | `datetime`      | _def:now_                              | _创建时间_                   |
| **updated_at** | `datetime`      | _def:now_                              | _修改时间_                   |

[end]:game_merge_log

---

#### 礼品码 {#game_gift_code}

[begin]:game_gift_code
---

> [Return :top:](#menu)

> `game_gift_code` for **MySql**

---

| col            | type          | key                                      | mark             |
| -------------- | ------------- | ---------------------------------------- | ---------------- |
| **id**         | `int(11)`     | _pk,increment_                           | ~~\\~~           |
| **code**       | `varchar(32)` | _unique_                                 | _唯一的兑换码_   |
| **gift_id**    | `int(11)`     | _this:left_right_arrow:game_gift_cfg.id_ | _礼物配置 id_    |
| **limit**      | `int(11)`     | _def:1_                                  | _礼物可领取次数_ |
| **count**      | `int(11)`     | _def:0_                                  | _已领取次数_     |
| **created_at** | `datetime`    | _def:now_                                | _创建时间_       |
| **updated_at** | `datetime`    | _def:now_                                | _修改时间_       |

[end]:game_gift_code
---
#### 礼品码配置 {#game_gift_cfg}

[begin]:game_gift_cfg
---

> [Return :top:](#menu)

> `game_gift_cfg` for **MySql**

---

| col            | type       | key            | mark                                              |
| -------------- | ---------- | -------------- | ------------------------------------------------- |
| **id**         | `int(11)`  | _pk,increment_ | ~~\\~~                                            |
| **limit**      | `int(11)`  | _def:0_        | _可领取次数_                                      |
| **count**      | `int(11)`  | _def:0_        | _已领取次数_                                      |
| **is_repeat**  | `int(1)`   | \_def:0        | _是否可以重复领取_                                |
| **pkg**        | `array`    | _not null_     | _礼包内容,array(object){item_id:1,item_count:1,}_ |
| **status**     | `int(11)`  | _def:0_        | _礼包状态_                                        |
| **created_at** | `datetime` | _def:now_      | _创建时间_                                        |
| **updated_at** | `datetime` | _def:now_      | _修改时间_                                        |

[end]:game_gift_cfg
---
#### 礼品码领取日志 {#game_gift_log}

[begin]:game_gift_log
---

> [Return :top:](#menu)

> `game_gift_log` for **MySql**

---

| col             | type       | key                                       | mark               |
| --------------- | ---------- | ----------------------------------------- | ------------------ |
| **id**          | `int(11)`  | _pk,increment_                            | ~~\\~~             |
| **user_id**     | `int(11)`  | _this:left_right_arrow:game_user.id_      | _用户 ID_          |
| **role_id**     | `int(11)`  | _this:left_right_arrow:game_role.id_      | _角色 ID_          |
| **code_id**     | `int(11)`  | \_this:left_right_arrow:game_gift_code.id | _礼包码 ID_        |
| **gift_cfg_id** | `int(11)`  | \_this:left_right_arrow:game_gift_cfg.id  | _礼包码配置 ID_    |
| **gift_pkg**    | `array`    | _not null_                                | _领取时的礼物配置_ |
| **created_at**  | `datetime` | _not null_                                | _领取时间_         |
| **updated_at**  | `datetime` | _not null_                                | _修改时间_         |

[end]:game_gift_log
---
#### 系统公告 {#game_notice}

[begin]:game_notice
---

> [Return :top:](#menu)

> `game_notice` for **MySql**

---

| col            | type           | key            | mark           |
| -------------- | -------------- | -------------- | -------------- |
| **id**         | `int(11)`      | _pk,increment_ | ~~\\~~         |
| **title**      | `varchar(500)` | _not null_     | _标题_         |
| **content**    | `text`         | _not null_     | _公告内容_     |
| **json_url**   | `varchar(255)` | _not null_     | _公告配置地址_ |
| **created_at** | `datetime`     | _not null_     | _创建时间_     |
| **updated_at** | `datetime`     | _not null_     | _修改时间_     |

[end]:game_notice
---
#### 全服邮件 {#game_ser_mail}

[begin]:game_ser_mail
---

> [Return :top:](#menu)

> `game_ser_mail` for **MySql**

---

| col            | type           | key            | mark           |
| -------------- | -------------- | -------------- | -------------- |
| **id**         | `int(11)`      | _pk,increment_ | ~~\\~~         |
| **title**      | `varchar(255)` | _not null_     | _标题_         |
| **content**    | `text`         | _not null_     | _内容_         |
| **attch**      | `array`        | _def:null_     | _邮件附加道具_ |
| **server_id**  | `int(11)`      | _not null_     | _服务器 ID_    |
| **timing**     | `datetime`     | _def:null_     | _定时_         |
| **valid_day**  | `datetime`     | _def:null_     | _有效时间_     |
| **status**     | `int(11)`      | _def:0_        | _发送状态_     |
| **created_at** | `datetime`     | _not null_     | _创建时间_     |
| **updated_at** | `datetime`     | _not null_     | _修改时间_     |

[end]:game_ser_mail

---

#### 玩家邮件 {#game_user_mail}

[begin]:game_user_mail
---

> [Return :top:](#menu)

> `game_user_mail` for **MySql**

---

| col            | type       | key                                    | mark                         |
| -------------- | ---------- | -------------------------------------- | ---------------------------- |
| **id**         | `int(11)`  | _pk,increment_                         | ~~\\~~                       |
| **title**      | `int(11)`  | _not null_                             | _标题_                       |
| **content**    | `text`     | _not null_                             | _内容_                       |
| **attch**      | `array`    | _def:null_                             | _附加道具_                   |
| **server_id**  | `int(11)`  | _this:left_right_arrow:game_server.id_ | _服务器 id_                  |
| **user_id**    | `int(11)`  | _this:left_right_arrow:game_user.id_   | _用户 id_                    |
| **role_id**    | `int(11)`  | _this:left_right_arrow:game_role.id_   | _角色 id_                    |
| **status**     | `int(11)`  | _def:0_                                | _邮件状态:0 未领取,1 已领取_ |
| **created_at** | `datetime` | _not null_                             | _创建时间_                   |
| **updated_at** | `datetime` | _not null_                             | _修改时间_                   |

[end]:game_user_mail
---

#### 充值订单 {#game_order}

[begin]:game_order
---

> [Return :top:](#menu)

> `game_order` for **MySql**

---

| col                  | type           | key                                    | mark         |
| -------------------- | -------------- | -------------------------------------- | ------------ |
| **id**               | `int(11)`      | _pk,increment_                         | ~~\\~~       |
| **shop_id**          | `int(11)`      | _this:left_right_arrow:game_shop.id_   | _商品 ID_    |
| **amount**           | `int(11)`      | _not null_                             | _付款金额_   |
| **channel_id**       | `int(11)`      | _not null_                             | _支付渠道_   |
| **channel_name**     | `varchar(255)` | _not null_                             | _渠道名称_   |
| **channel_order_id** | `varchar(255)` | _not null_                             | _渠道订单号_ |
| **order_id**         | `varchar(255)` | _not null_                             | _订单号_     |
| **user_id**          | `int(11)`      | _this:left_right_arrow:game_user.id_   | _用户 ID_    |
| **server_id**        | `int(11)`      | _this:left_right_arrow:game_server.id_ | _服务器 ID_  |
| **role_id**          | `int(11)`      | _this:left_right_arrow:game_role.id_   | _角色 ID_    |
| **status**           | `int(11)`      | _not null_                             | _订单状态_   |
| **currency**         | `int(11)`      | _not null_                             | _支付币种_   |
| **pay_amount**       | `int(11)`      | _def:null_                             | _支付金额_   |
| **exp**              | `json`         | _def:null_                             | _拓展字段_   |
| **created_at**       | `datetime`     | _not null_                             | _创建时间_   |
| **updated_at**       | `datetime`     | _not null_                             | _修改时间_   |

[end]:game_order
---

#### 商品列表 {#game_shop}

[begin]:game_shop
---

> [Return :top:](#menu)

> `game_shop` for **MySql**

---

| col            | type           | key            | mark                                 |
| -------------- | -------------- | -------------- | ------------------------------------ |
| **id**         | `int(11)`      | _pk,increment_ | ~~\\~~                               |
| **amount**     | `int(11)`      | _not null_     | _商品价值_                           |
| **title**      | `varchar(255)` | _not null_     | _商品名称_                           |
| **attch**      | `array`        | _not null_     | _商品包_                             |
| **status**     | `int(11)`      | _def:0_        | \_商品状态,0:未启用,1:启用,-1:软删除 |
| **type**       | `int(11)`      | _def:0_        | _商品类型_                           |
| **created_at** | `datetime`     | _not null_     | _创建时间_                           |
| **updated_at** | `datetitme`    | _not null_     | _修改时间_                           |

[end]:game_order
---
#### 玩家道具表 {#game_user_prop}

[begin]:game_user_prop
---

> [Return :top:](#menu)

> `game_user_prop` for **MongoDB**

---

```json

{

}

```

[end]:game_order
---

#### 玩家道具变动日志 {#game_user_prop_log}

[begin]:game_user_prop_log
---

> [Return :top:](#menu)

> `game_user_prop` for **MongoDB**

---

```json

{

}

```

[end]:game_user_prop_log

---
#### 玩家事件日志 {#game_user_event_log}

[begin]:game_user_event_log
---

> [Return :top:](#menu)

> `game_user_event_log` for **MongoDB**

---

```json

{

}

```

[end]:game_user_event_log

---
#### 游戏地图表 {#game_map}

[begin]:game_map
---


---
| col | type | key | mark |
| --- | ---- | --- | ---- |

[end]:game_map
---

#### 支付渠道表 {#game_pay_channel}

[begin]:game_pay_channel
---

> [Return :top:](#menu)
> `game_pay_channel` for **MySql**

---
| col            | type           | key            | mark        |
| -------------- | -------------- | -------------- | ----------- |
| **id**         | `int(11)`      | _pk,increment_ | ~~\\~~      |
| **name**       | `varchar(100)` | _not null_     | _渠道名_    |
| **alias**      | `varchar(100)` | _not null_     | _渠道别名_  |
| **type**       | `int(11)`      | _def:0_        | _渠道类型_  |
| **status**     | `int(11)`      | _def:0_        | _渠道状态_  |
| **https**      | `int(1)`       | _def:0_        | _是否https_ |
| **weight**     | `int(11)`      | _def:0_        | _权重_      |
| **extra**      | `text`         | _def:0_        | _拓展_      |
| **remark**     | `varchar(500)` | _def:null_     | _备注_      |
| **created_at** | `datetime`     | _not null_     | _创建时间_  |
| **updated_at** | `datetime`     | _not null_     | _修改时间_  |

[end]:game_pay_channel
---