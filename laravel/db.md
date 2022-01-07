# 数据字典 {#menu}

---

| ·      | 表明                    | 引擎     | 类型      | 备注                                    |
| ------ | ----------------------- | -------- | --------- | --------------------------------------- |
| **1**  | **game_user**           | `InnoDB` | _Mysql_   | [用户表](#game_user)                    |
| **2**  | **game_role**           | `InnoDB` | _Mysql_   | [角色表](#game_role)                    |
| **3**  | **game_channel**        | `InnoDB` | _Mysql_   | [渠道表](#game_channel)                 |
| **4**  | **game_prop**           | ~~\\~~   | _MongoDB_ | [道具表](#game_prop)                    |
| **5**  | **game_activity**       | `InnoDB` | _Mysql_   | [活动表](#game_activity)                |
| **6**  | **game_activity_cfg**   | `InnoDB` | _Mysql_   | [活动配置表](#game_activity_cfg)        |
| **7**  | **game_server**         | `InnoDB` | _Mysql_   | [服务器表](#game_server)                |
| **8**  | **game_node**           | `InnoDB` | _Mysql_   | [服务器节点](#game_node)                |
| **9**  | **game_merge_log**      | `InnoDB` | _Mysql_   | [合服日志](#game_merge_log)             |
| **10** | **game_gift_code**      | `InnoDB` | _Mysql_   | [礼品码](#game_gift_code)               |
| **11** | **game_gift_cfg**       | `InnoDB` | _Mysql_   | [礼品码配置](#game_gift_cfg)            |
| **12** | **game_gift_log**       | ~~\\~~   | _MongoDB_ | [礼品码领取日志](#game_gift_log)        |
| **13** | **game_notice**         | `InnoDB` | _Mysql_   | [系统公告](#game_notice)                |
| **14** | **game_ser_mail**       | `InnoDB` | _Mysql_   | [全服邮件](#game_ser_mail)              |
| **15** | **game_user_mail**      | `InnoDB` | _Mysql_   | [玩家邮件](#game_user_mail)             |
| **16** | **game_order**          | `InnoDB` | _Mysql_   | [充值订单](#game_order)                 |
| **17** | **game_shop**           | `InnoDB` | _Mysql_   | [商品列表](#game_shop)                  |
| **18** | **game_user_prop**      | `InnoDB` | _Mysql_   | [玩家道具表](#game_user_prop)           |
| **19** | **game_user_prop_log**  | ~~\\~~   | _MongoDB_ | [玩家道具变动日志](#game_user_prop_log) |
| **20** | **game_user_event_log** | `InnoDB` | _MongoDB_ | [玩家事件日志](#game_user_event_log)    |
| **21** | **game_map**            | `InnoDB` | _Mysql_   | [游戏地图表](#game_map)                 |
| **22** | **task_cfg**            | ~~\\~~   | _MongoDB_ | [任务配置](#task_cfg)                   |

---

#### 用户表 : {#game_user}

---

> [Return :top:](#menu)

> `game_user` for **MySql**

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

---

#### 角色表 {#game_role}

---

> [Return :top:](#menu)

> `game_role` for **MySql**

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

#### 渠道表 {#game_channel}

---

> [Return :top:](#menu)

> `game_channel` for **Mysql**

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

---

#### 道具表 {#game_prop}

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

#### 活动表 {#game_activity}

---

> [Return :top:](#menu)

> `game_activity` for **MySql**

---

| col        | type           | key            | mark                                   |
| ---------- | -------------- | -------------- | -------------------------------------- |
| id         | `int(11)`      | _pk,increment_ | ~~\\~~                                 |
| name       | `varchar(100)` | _unique_       | _活动名_                               |
| status     | `int(11)`      | _def:0_        | _活动状态 0:关闭,1:开启,2:等待开启..._ |
| ord        | `int(11)`      | _def:1_        | _活动排序_                             |
| model      | `varchar(100)` | _not null_     | _活动模板_                             |
| times      | `varchar(100)` | _not null_     | _活动时间_                             |
| begin_time | `datetime`     | _not null_     | _开始时间_                             |
| end_time   | `datetime`     | _def:null_     | _结束时间,为 null 则无时间限制_        |
| created_at | `datetime`     | _not null_     | _创建时间_                             |
| updated_at | `datetime`     | _not null_     | _修改时间_                             |

#### 活动配置表 {#game_activity_cfg}

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

#### 服务器表 {#game_server}

---

> [Return :top:](#menu)

> `game_server` for **MySql**

| col | type      | key            | mark   |
| --- | --------- | -------------- | ------ |
| id  | `int(11)` | _pk,increment_ | ~~\\~~ |

#### 服务器节点 {#game_node}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 合服日志 {#game_merge_log}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 礼品码 {#game_gift_code}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 礼品码配置 {#game_gift_cfg}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 礼品码领取日志 {#game_gift_log}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 系统公告 {#game_notice}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 全服邮件 {#game_ser_mail}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 玩家邮件 {#game_ser_mail}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 充值订单 {#game_order}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 商品列表 {#game_shop}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 玩家道具表 {#}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 玩家道具变动日志 {#game_user_prop_log}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 玩家事件日志 {#game_user_event_log}

| col | type | key | mark |
| --- | ---- | --- | ---- |

#### 游戏地图表 {#game_map}

| col | type | key | mark |
| --- | ---- | --- | ---- |
