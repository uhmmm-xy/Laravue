<template>
    <div>
        <!-- 查询表单开始 -->
        <div class="search-term">
            <el-form
                :inline="true"
                :model="searchInfo"
                class="demo-form-inline"
            >
                <el-form-item>
                    <el-select v-model="selectedServer">
                        <el-option value="1" label="1服"></el-option>
                        <el-option value="2" label="2服"></el-option>
                        <el-option value="3" label="3服"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item>
                    <el-date-picker
                        v-model="dataRange"
                        type="datetimerange"
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期"
                        class="date-picker"
                    >
                    </el-date-picker>
                </el-form-item>
                <el-form-item>
                    <el-button @click="onSubmit" type="primary">查询</el-button>
                </el-form-item>
            </el-form>
        </div>
        <!-- 查询表单结束 -->

        <!-- 列表展示开始 -->
        <el-table
            :data="tableData"
            border
            ref="multipleTable"
            stripe
            style="width: 100%"
            tooltip-effect="dark"
        >
            <el-table-column
                label="日期"
                prop="created_at"
                width="180"
            ></el-table-column>
            <el-table-column
                label="新增用户"
                prop="PlayerCount"
            ></el-table-column>
            <el-table-column
                label="活跃用户"
                prop="LoginCount"
            ></el-table-column>
            <el-table-column
                label="付费总人数"
                prop="1s_to_10s"
            ></el-table-column>
            <el-table-column label="付费率" prop="10s_to_60s"></el-table-column>
            <el-table-column label="ARPU" prop="60s_to_5m"></el-table-column>
            <el-table-column label="ARPPU" prop="5m_to_10m"></el-table-column>
            <el-table-column
                label="付费总额"
                prop="10m_to_30m"
            ></el-table-column>
            <el-table-column
                label="新增付费"
                prop="30m_to_1h"
            ></el-table-column>
            <el-table-column
                label="新增付费率"
                prop="1h_to_2h"
            ></el-table-column>
            <el-table-column label="新ARPU" prop="2h_so"></el-table-column>
            <el-table-column label="新ARPPU" prop="2h_so"></el-table-column>
            <el-table-column
                label="新增付费总额"
                prop="2h_so"
            ></el-table-column>
        </el-table>
        <el-pagination
            :current-page="page"
            :page-size="pageSize"
            :page-sizes="[10, 30, 50, 100]"
            :style="{ float: 'right', padding: '20px' }"
            :total="total"
            @current-change="handleCurrentChange"
            @size-change="handleSizeChange"
            layout="total, sizes, prev, pager, next, jumper"
        ></el-pagination>
        <!-- 列表展示结束 -->
    </div>
</template>
<script>
export default {
    name: "dayStatis",
    data() {
        return {
            dataRange: "",
            selectedServer: "",
        };
    },
    methods: {
        onSubmit: () => {
            return false;
        },
    },
    async created() {},
};
</script>

<style>
.el-form-item__content {
    line-height: 0;
}
.el-range-editor.el-input__inner {
    padding: unset;
}
</style>
