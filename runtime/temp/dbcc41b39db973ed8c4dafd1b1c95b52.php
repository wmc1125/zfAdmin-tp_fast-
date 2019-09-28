<?php /*a:1:{s:32:"./template/admin/user/index.html";i:1569477750;}*/ ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo htmlentities($web_config['version']['ver_name']); ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/static/style/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/public/static/system/style/admin.css" media="all">
</head>
<style>
    .layui-table-cell {
        height: 100px;
        width: 100px;
        max-width: 100%;
    }
</style>

<body>
  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">用户列表</div>
      <div class="layui-card-body">
        <div class="test-table-reload-btn" style="margin-bottom: 10px;">
          昵称：
          <div class="layui-inline">
            <input class="layui-input" name="id" id="test-table-search_title" autocomplete="off">
          </div>
          手机号：
          <div class="layui-inline">
            <input class="layui-input" name="id" id="test-table-search_tel" autocomplete="off">
          </div>
          <button class="layui-btn" data-type="reload">搜索</button>
        </div>
        <table class="layui-hide" id="data_table_r1" lay-filter="data_table_r1"></table>
        <script type="text/html" id="toolbarDemo">
          <div class="layui-btn-container test-table-reload-btn">
            <button class="layui-btn layui-btn-sm layui-btn-danger" data-type="getCheckData">批量删除</button>
            <button class="layui-btn layui-btn-sm" onclick="zfAdminShow('添加用户','<?php echo url("user/add"); ?>')">添加</button>
            <a class="layui-btn layui-btn-sm" href="<?php echo url('user/export'); ?>" >导出</a>
          </div>
        </script>
        <script type="text/html" id="switchTpl">{{ d.sex == 1 ? '男' : '女' }}</script>
        <script type="text/html" id="test-table-operate-barDemo_pic">
          <img src="{{d.pic}}">
        </script>


        <script type="text/html" id="statusTpl">
          <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="开|关" lay-filter="status_change" {{ d.status == 1 ? 'checked' : '' }}>
        </script>
        <script type="text/html" id="test-table-operate-barDemo">
          <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
          <a class="layui-btn layui-btn-xs" lay-event="edit"  onclick='zfAdminShow("编辑用户","/admin/user/edit/id/{{d.id}}")'>编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="btn_del('common/del_post',{{d.id}},'user')"  href="#">删除</a>
        </script>
      </div>
    </div>
  </div>

  <script src="/public/static/style/layui/layui.js"></script>    
  <script type="text/javascript" src="/public/static/system/common.js"></script>  
  <script>
 layui.use([ 'table'], function(){
    var $ = layui.$
    ,form = layui.form
    ,admin = layui.admin
    ,table = layui.table;
    
    form.on('switch(status_change)', function(obj){
        var id = this.value
        var dbname = 'user'
        var status = obj.elem.checked ? '1' : '0'
        console.log(id)
        $.get("<?php echo url('common/is_switch'); ?>",{id:id,dbname:dbname,status:status},function(res){
            if(res.result==1){
            layer.msg(res.msg, {icon: 1});
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");
    });

    table.render({
      elem: '#data_table_r1'
      ,url:"<?php echo url('user/index'); ?>"
      ,toolbar: '#toolbarDemo'
      ,title: '用户数据表'
      // ,defaultToolbar: ['filter', 'print', 'exports']
      ,cols: [[
        {type: 'checkbox', fixed: 'left'}
        ,{field:'id', width:80, title: 'ID', sort: true, fixed: 'left',totalRow: true}
        ,{field:'name', width:100, title: '昵称',edit: 'text'}
        ,{field:'pic', width:125, title: '头像' , toolbar: '#test-table-operate-barDemo_pic'}
        ,{field:'gname', width:100, title: '分组'}        
        ,{field:'sex', width:80, title: '性别', sort: true, templet: '#switchTpl'}
        ,{field:'mobile', width: 160, title: '手机'}
        ,{field:'ip', width:130, title: 'IP'}
        ,{field:'dat', width:180, title: '加入时间'}
        ,{field:'status', width:80, title: '状态',templet: '#statusTpl'}
        ,{fixed: 'right', title:'操作', toolbar: '#test-table-operate-barDemo', width:160}
      ]]
      ,page: true
    });
    table.on('edit(data_table_r1)', function(obj){
      var id = obj.data.id
      var dbname = 'user'
      var field = obj.field; //得到字段
      var value = obj.value //得到修改后的值
      $.get("<?php echo url('common/value_edit'); ?>",{id:id,dbname:dbname,field:field,value:value},function(res){
          if(res.result==1){
          layer.msg(res.msg, {icon: 1});
        }else{
          layer.msg(res.msg, {icon: 2});
        }
      },"json");
    });

    var $ = layui.$, active = {
      // 搜索
      reload: function(){
        var search_title = $('#test-table-search_title');
        var search_tel = $('#test-table-search_tel');
        //执行重载
        table.reload('data_table_r1', {
          page: {
            curr: 1 //重新从第 1 页开始
          }
          ,where: {
            key: {
              name: search_title.val(),
              tel: search_tel.val()
            }
          }
        });
      }
      //获取多选 删除
      ,getCheckData: function(){ //获取选中数据
        var checkStatus = table.checkStatus('data_table_r1')
        ,data =checkStatus.data
        if (data.length<1){
            layer.alert('请勾选信息！');
            return false;
        }
        var ids=[];
        for (var i = 0; i < data.length; i++) {
            ids += data[i].id + ',';
        }
        ids = ids.substr(0, ids.length-1);
        var dbname = 'user'
        $.get("<?php echo url('common/more_del'); ?>",{ids:ids,dbname:dbname},function(res){
            if(res.result==1){
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            layer.msg(res.msg, {icon: 1});
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");
      }
    };
    // 搜索
    $('.test-table-reload-btn .layui-btn').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
    //监听表格复选框选择
    table.on('checkbox(data_table_r1)', function(obj){
      console.log(obj)
    });
   
  });
  </script>
</body>
</html>
