<?php

return [
    'url'                          => env('GAME_URL', ''),
    'secret'                       => env('GAME_SECRET', ''),

    'api'                          => [
        "game.get_url"             =>  "/back/get_server_list_url",           //向游戏获取当前使用的区服文件url
        "game.set_url"             => "/back/set_server_list",                //向游戏更新设置当前使用的区服文件url
        "game.get_hefu"            => "/back/get_all_hefu",                   //向游戏获取所有合服信息
        "game.set_hefu"            => "/back/set_hefu",                       //向游戏发送合服请求
        "game.del_hefu"            => "/back/delete_hefu",                    //向游戏发送撤销合服请求
        "game.update_zone_ser"     => "/back/update_zone_server",             //新增/更新区服请求
        "game.get_all_ser"         => "/back/get_all_zone_server",            //获取区服数据信息
        "send.mail"                => "/back/send_mail",                      //发送邮件
        "send.zone_mail"           => "/back/send_zone_mail",                 //发送全服邮件
        "send.del_zone_mail"       => "/back/delete_zone_mail",               //撤回全服邮件
        "game.get_stop_ser_time"   => "/back/get_stop_server_time",           //获取关服维护时间
        "game.set_stop_ser_time"   => "/back/set_stop_server_time",           //设置关服维护时间
        "game.update_node"         => "/back/update_node",                    //更新节点信息
        "game.get_all_node"        => "/back/get_all_node",                   //获取所有逻辑节点信息
        "game.del_node"            => "/back/delete_node",                    //删除逻辑节点
        "game.del_ser"             => "/back/delete_zone_server",             //删除区服信息
        "game.get_all_wlist"       => "/back/get_all_white_list",             //获取所有白名单请求
        "game.add_wlist"           => "/back/add_white_list",                 //新增白名单请求
        "game.del_wlist"           => "/back/delete_white_list",              //删除白名单请求
        "user.info"                => "/back/get_account_info",               //获取账号信息请求  ##废弃
        "user.get_info"            => "/back/get_account_info_by_uid",        //通过UID获取账号信息请求
        "game.get_map"             => "/back/get_lunhui_map",                 //获取所有轮回洞地图请求
        "game.add_map"             => "/back/add_lunhui_map",                 //新增轮回洞地图请求
        "game.del_map"             => "/back/delete_lunhui_map",              //删除轮回洞地图请求
        "game.update_map"          => "/back/update_lunhui_map",              //更新轮回洞地图信息请求
        "game.zone_ser_map"        => "/back/get_zone_server_lunhui_map",     //获取所有区服配置的轮回洞地图
        "game.update_zone_ser_map" => "/back/update_zone_server_lunhui_map",  //更新区服的轮回洞地图
        "user.get_role_info"       => "/back/get_role_info",                  //获取角色信息请求
        "user.update_status"       => "/back/update_user_status"              //更新账号/角色状态,黑名单/禁言等
    ]
];
