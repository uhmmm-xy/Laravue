<template>
    <el-table
        :data="tableData"
        @selection-change="handleSelectionChange"
        border
        ref="multipleTable"
        stripe
        style="width: 100%"
        tooltip-effect="dark"
    >
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column
            label="开服日期"
            prop="open_time"
            width="180"
        ></el-table-column>
        <el-table-column label="服务器名" prop="name"></el-table-column>
        <el-table-column label="地址" prop="addr" width="120"></el-table-column>
        <el-table-column label="端口" prop="port"></el-table-column>
        <el-table-column label="状态" prop="status_text"></el-table-column>
        <!-- <el-table-column label="按钮组">
            <template slot-scope="scope">
                <el-button icon="el-icon-zoom-in" size="mini">详情</el-button>
                <el-popover
                    placement="top"
                    width="160"
                    v-model="scope.row.visible"
                >
                    <p>确定要删除吗？</p>
                    <div style="text-align: right; margin: 0">
                        <el-button
                            type="primary"
                            size="mini"
                            @click="scope.row.visible = false"
                            >取消</el-button
                        >
                        <el-button
                            type="danger"
                            size="mini"
                            @click="deleteBusArticle(scope.row)"
                            >确定</el-button
                        >
                    </div>
                    <el-button
                        type="danger"
                        icon="el-icon-delete"
                        size="mini"
                        slot="reference"
                        >删除</el-button
                    >
                </el-popover>
            </template>
        </el-table-column> -->
    </el-table>
</template>
<script>
import { getZoneList } from "@/api/game";
import infoList from "@/components/mixins/infoList";
export default {
    name: "Server",
    mixins: [infoList],
    data() {
        return {
            listApi: getZoneList,
        };
    },
    methods: {
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
    },
    async created() {
        await this.getAllTableData();
    },
};
</script>