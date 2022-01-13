<template>
  <div>
    <!-- 查询表单开始 -->
    <div class="search-term">
      <el-form :inline="true" :model="searchInfo" class="demo-form-inline">
        <el-form-item>
          <el-input
            v-model="searchInfo.title"
            placeholder="文章标题"
            clearable
            :style="{ width: '100%' }"
          ></el-input>
        </el-form-item>
        <el-form-item>
          <el-input
            v-model="searchInfo.desc"
            placeholder="文章描述"
            clearable
            :style="{ width: '100%' }"
          ></el-input>
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
              <el-button @click="deleteVisible = false" size="mini" type="text"
                >取消</el-button
              >
              <el-button @click="onDelete" size="mini" type="primary"
                >确定</el-button
              >
            </div>
            <el-button
              icon="el-icon-delete"
              size="mini"
              slot="reference"
              type="danger"
              >批量删除</el-button
            >
          </el-popover>
        </el-form-item>
      </el-form>
    </div>
    <!-- 查询表单结束 -->

    
    <!-- 列表展示开始 -->
    <el-table :data="tableData" border ref="multipleTable" stripe style="width: 100%" tooltip-effect="dark">
      <el-table-column label="日期" prop="created_at" width="180"></el-table-column>
      <el-table-column label="标题" prop="title"></el-table-column>
      <el-table-column label="类型" prop="type" width="120"></el-table-column>
      <el-table-column label="内容" prop="content"></el-table-column>
    </el-table>
    <el-pagination :current-page="page" :page-size="pageSize" :page-sizes="[10, 30, 50, 100]" :style="{float:'right',padding:'20px'}" :total="total" @current-change="handleCurrentChange" @size-change="handleSizeChange" layout="total, sizes, prev, pager, next, jumper"></el-pagination>
    <!-- 列表展示结束 -->
  </div>
</template>
<script>
import infoList from "@/components/mixins/infoList";

export default {
  name: "LTVData",
  mixins: [infoList],
  data() {
    return {};
  },
  methods: {},
  async created() {
    await this.getTableData();
  },
};
</script>

<style></style>
