import { getDict } from "@/utils/dictionary";
export default {
    data() {
        return {
            page: 1,
            total: 10,
            pageSize: 10,
            tableData: [],
            searchInfo: {},
            startTime: "",
            endTime: "",
        };
    },
    methods: {
        filterDict(value, type) {
            const rowLabel =
                this[type + "Options"] &&
                this[type + "Options"].filter((item) => item.value == value);
            return rowLabel && rowLabel[0] && rowLabel[0].label;
        },
        async getDict(type) {
            const dicts = await getDict(type);
            this[type + "Options"] = dicts;
        },
        handleSizeChange(val) {
            this.pageSize = val;
            this.getTableData();
        },
        handleCurrentChange(val) {
            this.page = val;
            this.getTableData();
        },
        async getTableData(
            page = this.page,
            pageSize = this.pageSize,
            startTime = this.startTime,
            endTime = this.endTime
        ) {
            let search = {};
            for (let key in this.searchInfo) {
                if (this.searchInfo[key]) search[key] = this.searchInfo[key];
            }
            const table = await this.listApi({
                page,
                pageSize,
                startTime,
                endTime,
                ...search,
            });
            this.tableData = table.data.list;
            this.total = table.data.total;
            this.page = table.data.page;
            this.pageSize = table.data.pageSize;
            if(table.data instanceof Array){
                this.tableData = table.data;
            }
        },
        async getAllTableData() {
            const table = await this.listApi();
            this.tableData = table.data;
        },
    },
};
