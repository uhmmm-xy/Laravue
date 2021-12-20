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
            <el-descriptions-item>
                <template slot="label">
                    <i class="el-icon-user"></i>
                    角色ID
                </template>
                
            </el-descriptions-item>
            <el-descriptions-item>
                <template slot="label">
                    <i class="el-icon-mobile-phone"></i>
                    手机号
                </template>
                18100000000
            </el-descriptions-item>
            <el-descriptions-item>
                <template slot="label">
                    <i class="el-icon-location-outline"></i>
                    居住地
                </template>
                苏州市
            </el-descriptions-item>
            <el-descriptions-item>
                <template slot="label">
                    <i class="el-icon-tickets"></i>
                    备注
                </template>
                <el-tag size="small">学校</el-tag>
            </el-descriptions-item>
            <el-descriptions-item>
                <template slot="label">
                    <i class="el-icon-office-building"></i>
                    联系地址
                </template>
                江苏省苏州市吴中区吴中大道 1188 号
            </el-descriptions-item>
        </el-descriptions>
    </div>
</template>
<script>
import { getUser } from "@/api/game";
import infoList from "@/components/mixins/infoList";
import { formatTimeToStr } from "@/utils/data";
export default {
    name: "UserStatus",
    mixins: [infoList],
    data() {
        return {
            data: getUser,
            tagType: ["info", "success", "warning", "danger"],
        };
    },
    methods: {
        formatDate: (row) => {
            return formatTimeToStr(row.created * 1000);
        },
    }
};
</script>
