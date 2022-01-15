<template>
    <div>
        <!-- 查询表单开始 -->
        <div class="search-term">
            <el-form :inline="true" class="demo-form-inline">
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
        <div id="onlineData" class="chart-container"></div>
        <!-- 列表展示结束 -->
    </div>
</template>
<script>
import echarts from "echarts";
require("echarts/theme/macarons"); // echarts theme

export default {
    name: "onlineData",
    mixins: [],
    data() {
        return {
            selectedServer: "",
            dataRange: "",
        };
    },
    mounted() {
        let myChart = echarts.init(
            document.getElementById("onlineData"),
            "macarons"
        );
        let option = {
            xAxis: {
                type: "time",
            },
            yAxis: {},
            series: [
                {
                    name: "sever1",
                    data: [
                        ["2021", 79],
                        ["2020", 17],
                        ["2019", 0],
                        ["2018", 37],
                        ["2017", 24],
                        ["2016", 42],
                        ["2015", 63],
                        ["2014", 16],
                        ["2013", 76],
                        ["2012", 59],
                        ["2011", 72],
                        ["2010", 29],
                        ["2009", 2],
                        ["2008", 51],
                        ["2007", 9],
                        ["2006", 61],
                        ["2005", 56],
                        ["2004", 12],
                        ["2003", 65],
                        ["2002", 76],
                        ["2001", 92],
                        ["2000", 45],
                    ],
                    type: "line",
                },
                {
                    name: "server2",
                    type: "line",
                    data: [
                        ["2021", 84],
                        ["2020", 20],
                        ["2019", 1],
                        ["2018", 17],
                        ["2017", 34],
                        ["2016", 52],
                        ["2015", 23],
                        ["2014", 56],
                        ["2013", 36],
                        ["2012", 39],
                        ["2011", 12],
                        ["2010", 89],
                        ["2009", 90],
                        ["2008", 91],
                        ["2007", 80],
                        ["2006", 100],
                        ["2005", 66],
                        ["2004", 88],
                        ["2003", 77],
                        ["2002", 66],
                        ["2001", 99],
                        ["2000", 98],
                    ],
                },
                {
                    name: "server3",
                    type: "line",
                    data: [
                        ["2021", 23],
                        ["2020", 55],
                        ["2019", 5],
                        ["2018", 37],
                        ["2017", 66],
                        ["2016", 12],
                        ["2015", 13],
                        ["2014", 22],
                        ["2013", 26],
                        ["2012", 33],
                        ["2011", 11],
                        ["2010", 29],
                        ["2009", 21],
                        ["2008", 56],
                        ["2007", 32],
                        ["2006", 41],
                        ["2005", 25],
                        ["2004", 31],
                        ["2003", 31],
                        ["2002", 52],
                        ["2001", 22],
                        ["2000", 11],
                    ],
                },
            ],
        };

        myChart.setOption(option);

        window.addEventListener("resize", function () {
            myChart.resize();
        });
    },
    methods: {
        onSubmit: function () {
            return false;
        },
    },
    async created() {},
};
</script>

<style>
#onlineData {
    width: 100%;
    height: 400px;
}
.el-form-item__content {
    line-height: 0;
}
.el-range-editor.el-input__inner {
    padding: unset;
}
</style>
