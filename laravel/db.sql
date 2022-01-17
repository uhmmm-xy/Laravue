create table `game_user` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~\\~',
`user_name` int(11) not null COMMENT '用户名',
`union_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '平台 ID',
`open_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道 ID',
`channel` int(11)  COMMENT '渠道来源',
`phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '用户手机号',
`email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '用户 Email',
`gender` int(11)  COMMENT '用户性别 1:male,0:female',
`user_type` int(11)  COMMENT '用户类别 1:普通玩家 2:小 R 3:大 R',
`gold` int(11)  COMMENT '赠送代币剩余',
`jewel` int(11)  COMMENT '充值代币剩余',
`consume_gold` int(11)  COMMENT '赠送代币使用情况',
`consume_jewel` int(11)  COMMENT '充值代币使用情况',
`total_recharge` int(11)  COMMENT '用户总充值',
`first_recharge` int(11)  COMMENT '首充金额',
`first_recharge_date` datetime  COMMENT '首充时间',
`last_recharge` int(11)  COMMENT '上次充值金额',
`last_recharge_date` datetime  COMMENT '上次充值时间',
`status` int(11)  COMMENT '账号状态 1:none,2:disable,3:gm',
`role_count` int(11)  COMMENT '角色数量',
`last_login_time` datetime  COMMENT '上一次登录时间',
`last_login_ser` int(11)  COMMENT '上一次登录的服务器',
`last_login_role` int(11)  COMMENT '上一次登录的角色',
`last_login_ip` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '上次登录的 ip',
`device_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '设备号',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
UNIQUE INDEX `user_name_key`(`user_name`) USING BTREE, 
UNIQUE INDEX `union_id_key`(`union_id`) USING BTREE, 
UNIQUE INDEX `open_id_key`(`open_id`) USING BTREE, 
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_role` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`role_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '游戏服 ID',
`role_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '角色名',
`ser_id` int(11)  COMMENT '所属区服',
`user_id` int(11)  COMMENT '所属用户',
`status` int(11)  COMMENT '角色状态 0：node,1:xxx',
`vip` int(11)  COMMENT 'vip 等级',
`level` int(11)  COMMENT '角色等级',
`gold` int(11)  COMMENT '赠送代币',
`jewel` int(11)  COMMENT '充值代币',
`consume_gold` int(11)  COMMENT '赠送代币使用情况',
`consume_jewel` int(11)  COMMENT '充值代币使用情况',
`exp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '其他属性',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
UNIQUE INDEX `role_id_key`(`role_id`) USING BTREE, 
UNIQUE INDEX `role_name_key`(`role_name`) USING BTREE, 
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_channel` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`channel_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道名称',
`channel_alias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道别名',
`mark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道备注',
`exp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道附加参数',
`status` int(11)  COMMENT '渠道状态 0:启用,1:禁用',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_activity` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '活动名',
`status` int(11)  COMMENT '活动状态 0:关闭,1:开启,2:等待开启...',
`ord` int(11)  COMMENT '活动排序',
`model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '活动模板',
`times` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '活动时间',
`begin_time` datetime  COMMENT '开始时间',
`end_time` datetime  COMMENT '结束时间,为 null 则无时间限制',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
UNIQUE INDEX `name_key`(`name`) USING BTREE, 
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_server` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`server_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '服务器名',
`ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '服务器地址',
`port` int(11)  COMMENT '服务器端口',
`node_id` int(11)  COMMENT '服务器节点 ID',
`index` int(11)  COMMENT '游戏服 ID',
`notice_id` int(11)  COMMENT '公告 ID',
`open_time` datetime  COMMENT '开服时间,null 为不限制',
`des_id` int(11)  COMMENT '合服目标 ID',
`status` int(11)  COMMENT '服务器状态,0:停用,1:开服,2:维护',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_node` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '节点名',
`ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '节点地址',
`port` int(11)  COMMENT '端口号',
`node_stop_time` datetime  COMMENT '节点停止时间',
`mark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '节点备注',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_merge_log` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`source_id` int(11)  COMMENT '来源服 ID',
`target_id` int(11)  COMMENT '目标服 ID',
`mark` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '合服备注',
`take_time` datetime  COMMENT '生效时间,null 不生效',
`status` int(1)  COMMENT '执行状态,0:未执行,1:已执行',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_gift_code` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '唯一的兑换码',
`gift_id` int(11)  COMMENT '礼物配置 id',
`limit` int(11)  COMMENT '礼物可领取次数',
`count` int(11)  COMMENT '已领取次数',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
UNIQUE INDEX `code_key`(`code`) USING BTREE, 
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_gift_cfg` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`limit` int(11)  COMMENT '可领取次数',
`count` int(11)  COMMENT '已领取次数',
`is_repeat` int(1)  COMMENT '是否可以重复领取',
`pkg` array  COMMENT '礼包内容,array(object){item_id:1,item_count:1,}',
`status` int(11)  COMMENT '礼包状态',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_gift_log` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`user_id` int(11)  COMMENT '用户 ID',
`role_id` int(11)  COMMENT '角色 ID',
`code_id` int(11)  COMMENT '礼包码 ID',
`gift_cfg_id` int(11)  COMMENT '礼包码配置 ID',
`gift_pkg` array  COMMENT '领取时的礼物配置',
`created_at` datetime  COMMENT '领取时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_notice` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '标题',
`content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '公告内容',
`json_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '公告配置地址',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_ser_mail` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '标题',
`content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '内容',
`attch` array  COMMENT '邮件附加道具',
`server_id` int(11)  COMMENT '服务器 ID',
`timing` datetime  COMMENT '定时',
`valid_day` datetime  COMMENT '有效时间',
`status` int(11)  COMMENT '发送状态',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_user_mail` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`title` int(11)  COMMENT '标题',
`content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '内容',
`attch` array  COMMENT '附加道具',
`server_id` int(11)  COMMENT '服务器 id',
`user_id` int(11)  COMMENT '用户 id',
`role_id` int(11)  COMMENT '角色 id',
`status` int(11)  COMMENT '邮件状态:0 未领取,1 已领取',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_order` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`shop_id` int(11)  COMMENT '商品 ID',
`amount` int(11)  COMMENT '付款金额',
`channel_id` int(11)  COMMENT '支付渠道',
`channel_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道名称',
`channel_order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道订单号',
`order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '订单号',
`user_id` int(11)  COMMENT '用户 ID',
`server_id` int(11)  COMMENT '服务器 ID',
`role_id` int(11)  COMMENT '角色 ID',
`status` int(11)  COMMENT '订单状态',
`currency` int(11)  COMMENT '支付币种',
`pay_amount` int(11)  COMMENT '支付金额',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_shop` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`amount` int(11)  COMMENT '商品价值',
`title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '商品名称',
`attch` array  COMMENT '商品包',
`status` int(11)  COMMENT '\_商品状态,0:未启用,1:启用,-1:软删除',
`type` int(11)  COMMENT '商品类型',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetitme  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_map` ( 
PRIMARY KEY (``) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
create table `game_pay_channel` ( 
`id` int(11) not null AUTO_INCREMENT COMMENT '~~\\~~',
`name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道名',
`alias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '渠道别名',
`type` int(11)  COMMENT '渠道类型',
`status` int(11)  COMMENT '渠道状态',
`https` int(1)  COMMENT '是否https',
`weight` int(11)  COMMENT '权重',
`extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '拓展',
`remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  COMMENT '备注',
`created_at` datetime  COMMENT '创建时间',
`updated_at` datetime  COMMENT '修改时间',
PRIMARY KEY (`id`) USING BTREE 
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic; 
