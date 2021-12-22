<template>
    <div>
        <!-- 查询表单开始 -->
        <div class="search-term">
            <el-form :inline="true" :model="searchInfo">
                <el-form-item>
                    <el-input
                        v-model="searchInfo.roleId"
                        placeholder="角色ID"
                        clearable
                        :style="{ width: '100%' }"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-input
                        v-model="searchInfo.nickname"
                        placeholder="角色昵称"
                        clearable
                        :style="{ width: '100%' }"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button @click="onSubmit" type="primary">查询</el-button>
                </el-form-item>
            </el-form>
        </div>
        <!-- 查询表单结束 -->
        <el-descriptions
            class="margin-top"
            title="角色信息"
            :column="3"
            :size="size"
            border
        >
            <el-descriptions-item label="角色ID">
                {{ data.uid }}
            </el-descriptions-item>
            <el-descriptions-item label="角色昵称">
                {{ data.nick }}
            </el-descriptions-item>
            <el-descriptions-item label="账号ID">
                {{ data.account_id }}
            </el-descriptions-item>
            <el-descriptions-item label="转生">
                {{ data.zhuansheng }}
            </el-descriptions-item>
            <el-descriptions-item label="玩家等级">
                {{ data.level }}
            </el-descriptions-item>
            <el-descriptions-item label="VIP等级">
                {{ data.vip }}
            </el-descriptions-item>
            <el-descriptions-item label="VIP经验">
                {{ data.vip_exp }}
            </el-descriptions-item>
            <el-descriptions-item label="状态">
                {{ status_text[data.status] }}
            </el-descriptions-item>
            <el-descriptions-item label="操作">
                <el-popover placement="top" width="160" v-model="changeStatus">
                    <el-select v-model="userStatus" placeholder="请选择">
                        <el-option
                            v-for="(value, key) in status_text"
                            :key="key"
                            :label="value"
                            :value="key"
                        >
                        </el-option>
                    </el-select>
                    <div style="text-align: right; margin: 0">
                        <el-button
                            size="mini"
                            type="text"
                            @click="
                                (changeStatus = false),
                                    (userStatus = data.status)
                            "
                            >取消</el-button
                        >
                        <el-button
                            type="text"
                            size="mini"
                            @click="onChangeStatus"
                            >确定</el-button
                        >
                    </div>
                    <el-button slot="reference">更新状态</el-button>
                </el-popover>
            </el-descriptions-item>
        </el-descriptions>
    </div>
</template>
<script>
import { getUser, updateUserStatus } from "@/api/game";
import { formatTimeToStr } from "@/utils/data";
export default {
    name: "UserStatus",
    data() {
        return {
            getUser: getUser,
            updateUserStatus: updateUserStatus,
            searchInfo: {
                roleId: 0,
                nickname: "",
            },
            status_text: { 0: "正常", 2: "黑名单", 3: "封号", 4: "禁言" },
            data: {
                uid: 10000,
                account_id: 100000,
                nick: "abc",
                zhuansheng: 1,
                level: 100,
                vip: 1,
                vip_exp: 10000,
                status: 1,
            },
            changeStatus: false,
            userStatus: 0,
        };
    },
    methods: {
        formatDate: (row) => {
            return formatTimeToStr(row.created * 1000);
        },
        async onSubmit() {
            const ret = await this.getUser(this.searchInfo);
            this.data = ret.data;
            this.userStatus = ret.data.status;
        },
        async onChangeStatus() {
            const params = {
                uid: this.data.uid,
                status: this.userStatus,
            };

            let ret = await this.updateUserStatus(params);
            if (ret) {
                this.data.status = this.userStatus;
                this.changeStatus = false;
            }
        },
    },
};
</script>
