<template>
    <el-table
        :data="tableData"
        border
        ref="serverTable"
        stripe
        style="width: 100%"
        tooltip-effect="dark"
    >
        <el-table-column
            label="创建时间"
            prop="created"
            width="180"
            :formatter="formatDate"
        ></el-table-column>
        <el-table-column label="地图名" prop="name"></el-table-column>
        <el-table-column
            label="节点名"
            prop="nodename"
            width="120"
        ></el-table-column>
        <el-table-column label="备注" prop="mark"></el-table-column>
        <el-table-column label="模式" prop="mode_text"></el-table-column>
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
import { getMapList } from "@/api/game";
import infoList from "@/components/mixins/infoList";
import {formatTimeToStr} from "@/utils/data";
export default {
    name: "Server",
    mixins: [infoList],
    data() {
        return {
            listApi: getMapList,
            tagType: ["info", "success", "warning", "danger"],
        };
    },
    methods: {
        formatDate:(row)=>{
            return formatTimeToStr(row.created*1000);
        }
    },
    async created() {
        await this.getAllTableData();
    },
};
</script>