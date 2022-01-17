<template>
    <div>
        <!-- 查询表单开始 -->
        <div class="search-term">
            <el-form
                :inline="true"
                class="demo-form-inline"
            >
                <el-form-item>
                    <el-date-picker
                        v-model="dataRange"
                        type="daterange"
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
                prop="date"
                width="180"
            ></el-table-column>
            <el-table-column
                label="新增用户"
                prop="register_count"
            ></el-table-column>
            <el-table-column
                label="活跃用户"
                prop="active_count"
            ></el-table-column>
            <el-table-column
                label="付费总人数"
                prop="pay_count"
            ></el-table-column>
            <el-table-column label="付费率">
                <template slot-scope="scope">
                    {{ scope.row.active_count?scope.row.pay_count/scope.row.active_count:0 }}
                </template>
            </el-table-column>
            <el-table-column label="ARPU">
                <template slot-scope="scope">
                    {{ scope.row.active_count?scope.row.pay_total/scope.row.active_count:0 }}
                </template>
            </el-table-column>
            <el-table-column label="ARPPU">
                <template slot-scope="scope">
                    {{ scope.row.active_count?scope.row.pay_total/scope.row.pay_count:0 }}
                </template>
            </el-table-column>
            <el-table-column
                label="付费总额"
                prop="pay_total"
            ></el-table-column>
            <el-table-column
                label="新增付费"
                prop="new_pay_count"
            ></el-table-column>
            <el-table-column label="新增付费率">
                <template slot-scope="scope">
                    {{ scope.row.register_count?scope.row.new_pay_count/scope.row.register_count:0 }}
                </template>
            </el-table-column>
            <el-table-column label="新ARPU">
                <template slot-scope="scope">
                    {{ scope.row.register_count?scope.row.new_pay_total/scope.row.register_count:0 }}
                </template>
            </el-table-column>
            <el-table-column label="新ARPPU">
                <template slot-scope="scope">
                    {{ scope.row.active_count?scope.row.new_pay_total/scope.row.active_count:0 }}
                </template>
            </el-table-column>
            <el-table-column
                label="新增付费总额"
                prop="new_pay_total"
            ></el-table-column>
        </el-table>
        <!-- 列表展示结束 -->
    </div>
</template>
<script>
import { getStatisDay } from "@/api/statis"
import moment from 'moment';
import infoList from "@/components/mixins/infoList";

export default {
    name: "dayStatis",
    mixins: [infoList],
    data() {
        return {
            listApi:getStatisDay,
            dataRange: [moment().subtract(7,'days'),moment()],
        };
    },
    methods: {
        onSubmit() {
            this.startTime = moment(this.dataRange[0]).startOf("day").format('YYYY-MM-DD HH:mm:ss');
            this.endTime = moment(this.dataRange[1]).endOf("day").format('YYYY-MM-DD HH:mm:ss');
            this.getTableData();
        },
    },
    async created() {
        this.startTime = moment(this.dataRange[0]).startOf("day").format('YYYY-MM-DD HH:mm:ss');
        this.endTime = moment(this.dataRange[1]).endOf("day").format('YYYY-MM-DD HH:mm:ss');
        await this.getTableData();
        
    },
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
