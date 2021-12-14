<template>
  <div>
    <!-- 查询表单开始 -->
    <div class="search-term">
      <el-form :inline="true" :model="searchInfo" class="demo-form-inline">
        <el-form-item>
          <el-input v-model="searchInfo.title" placeholder="文章标题" clearable :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item>
          <el-input v-model="searchInfo.desc" placeholder="文章描述" clearable :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button @click="onSubmit" type="primary">查询</el-button>
        </el-form-item>
        <el-form-item>
          <el-button @click="openDialog" type="primary">新增</el-button>
        </el-form-item>
        <el-form-item>
          <el-popover placement="top" v-model="deleteVisible" width="160">
            <p>确定要删除吗？</p>
            <div style="text-align: right; margin: 0">
              <el-button @click="deleteVisible = false" size="mini" type="text">取消</el-button>
              <el-button @click="onDelete" size="mini" type="primary">确定</el-button>
            </div>
            <el-button icon="el-icon-delete" size="mini" slot="reference" type="danger">批量删除</el-button>
          </el-popover>
        </el-form-item>
      </el-form>
    </div>
    <!-- 查询表单结束 -->

    <!-- 列表展示开始 -->
    <el-table :data="tableData" @selection-change="handleSelectionChange" border ref="multipleTable" stripe style="width: 100%" tooltip-effect="dark">
      <el-table-column type="selection" width="55"></el-table-column>
      <el-table-column label="日期" prop="created_at" width="180"></el-table-column>
      <el-table-column label="标题" prop="title"></el-table-column>
      <el-table-column label="类型" prop="type" width="120"></el-table-column>
      <el-table-column label="内容" prop="content"></el-table-column>
      <el-table-column label="按钮组">
        <template slot-scope="scope">
          <el-button icon="el-icon-zoom-in" size="mini">详情</el-button>
          <el-popover placement="top" width="160" v-model="scope.row.visible">
            <p>确定要删除吗？</p>
            <div style="text-align: right; margin: 0">
              <el-button type="primary" size="mini" @click="scope.row.visible = false">取消</el-button>
              <el-button type="danger" size="mini" @click="deleteBusArticle(scope.row)">确定</el-button>
            </div>
            <el-button type="danger" icon="el-icon-delete" size="mini" slot="reference">删除</el-button>
          </el-popover>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination :current-page="page" :page-size="pageSize" :page-sizes="[10, 30, 50, 100]" :style="{float:'right',padding:'20px'}" :total="total" @current-change="handleCurrentChange" @size-change="handleSizeChange" layout="total, sizes, prev, pager, next, jumper"></el-pagination>
    <!-- 列表展示结束 -->

    <!-- 增改表单开始 -->
    <el-dialog :before-close="closeDialog" :visible.sync="dialogFormVisible" title="新建邮件">
      <el-form ref="elForm" :model="formData" :rules="rules" size="mini" label-width="140px" label-position="left">
        <el-form-item label="标题" prop="title">
          <el-input v-model="formData.title" placeholder="请输入文章标题" clearable :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="类型" prop="type">
          <el-select placeholder="类型" v-model="formData.type" @change="typeChange">
            <el-option label="全服邮件" value="1"></el-option>
            <el-option label="玩家邮件" value="2"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="内容" prop="content">
          <el-input v-model="formData.content" type="textarea" placeholder="请输入内容" :autosize="{ minRows: 4, maxRows: 4 }" :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="附属道具" prop="attach">
          <el-input v-model="formData.attach" placeholder="道具格式用冒号和逗号分隔（道具1：数量）" :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="玩家ID" prop="to_user" v-if="formData.type == '2'">
          <el-input v-model="formData.to_user" placeholder="请输入玩家ID（多ID用逗号分割）" :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="服务器" prop="zone" v-if="formData.type == '1'">
          <el-input v-model="formData.zone" placeholder="服务器ID" :style="{ width: '100%' }"></el-input>
        </el-form-item>
         <el-form-item :inline="true" label="节点名" prop="nodename" v-if="formData.type == '1'">
          <el-input v-model="formData.nodename" placeholder="节点名"></el-input>
        </el-form-item>
         <el-form-item :inline="true" label="服务器" prop="valid_day" v-if="formData.type == '1'">
          <el-input v-model="formData.valid_day" placeholder="有效天数"></el-input>
        </el-form-item>
         <el-form-item label="新玩家是否也发送" prop="all_user" v-if="formData.type == '1'">
          <el-switch v-model="formData.all_user" placeholder="新玩家是否也发送"></el-switch>
        </el-form-item>
      </el-form>
      <div class="dialog-footer" slot="footer">
        <el-button type="primary" @click="closeDialog">取 消</el-button>
        <el-button type="danger" @click="enterDialog">确 定</el-button>
      </div>
    </el-dialog>
    <!-- 增改表单结束 -->
  </div>
</template>

<script>
import {
  // sendMail,
  getMailList,
} from "@/api/game"; //  此处请自行替换地址
import { formatTimeToStr } from "@/utils/data";
import infoList from "@/components/mixins/infoList";
export default {
  name: "Mail",
  mixins: [infoList],
  data() {
    return {
      listApi: getMailList,
      dialogFormVisible: false,
      visible: false,
      type: "",
      deleteVisible: false,
      multipleSelection: [],
      formData: {
        title: "",
        type: "1",
        content: "",
        to_user: "",
        attach: "",
        zone:"",
        valid_day:"",
        all_user:"",
        nodename:""
      }     
    };
  },
  filters: {
    formatDate: function (time) {
      if (time != null && time != "") {
        var date = new Date(time);
        return formatTimeToStr(date, "yyyy-MM-dd hh:mm:ss");
      } else {
        return "";
      }
    },
    formatBoolean: function (bool) {
      if (bool != null) {
        return bool ? "是" : "否";
      } else {
        return "";
      }
    },
  },
  methods: {
    //条件搜索前端看此方法
    onSubmit() {
      this.page = 1;
      this.pageSize = 10;
      this.getTableData();
    },
    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    async onDelete() {
      const ids = [];
      this.multipleSelection &&
        this.multipleSelection.map((item) => {
          ids.push(item.id);
        });
      const res = { code: 200 };
      if (res.code == 200) {
        this.$message({
          type: "success",
          message: "批量删除成功",
        });
        this.deleteVisible = false;
        this.getTableData();
      }
    },
    closeDialog() {
      this.dialogFormVisible = false;
      this.formData = {
        title: null,
        desc: null,
        author: null,
        content: null,
        tag: null,
      };
    },
    async enterDialog() {
      let res = { code: 200 };
      if (res.code == 200) {
        this.$message({
          type: "success",
          message: "操作成功",
        });
        this.closeDialog();
        this.getTableData();
      }
    },
    openDialog() {
      this.type = "create";
      this.dialogFormVisible = true;
    },
  },
  async created() {
    await this.getTableData();
  },
};
</script>

<style>
</style>