<?php /*a:1:{s:39:"./template/admin/config/admin_role.html";i:1569477750;}*/ ?>


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
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <form onclick="return false;" class="info_tj">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
          <div class="layui-form-item">
            
            <div class="layui-inline">
              <label class="layui-form-label">名称</label>
              <div class="layui-input-block">
                <input type="text" name="name" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">控制器</label>
              <div class="layui-input-inline">
                <select name="control" lay-filter="control">
                  <option value="0">---未选择---</option>
                  <?php if(is_array($controllers)): foreach($controllers as $k=>$vo):?>
                  <option value="<?php echo htmlentities($vo); ?>"><?php echo htmlentities($vo); ?></option>
                  <?php  endforeach; endif; ?>
                </select>
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">方法</label>
              <div class="layui-input-inline">
                <select name="act" >
                    <option value="0">---未选择---</option>
                </select>
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">父类</label>
              <div class="layui-input-inline">
                <select name="pid">
                  <option value="0">---顶级目录---</option>
                  <?php if(is_array($list)): foreach($list as $k=>$vo):?>
                    <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo '┃'.str_repeat('━━', substr_count($vo['cname'],'  '));?> <?php echo htmlentities($vo['name']); ?></option>
                  <?php  endforeach; endif; ?>
                </select>
              </div>
            </div>
            
            <div class="layui-inline">
                <button class="layui-btn layui-btn-sm" onclick="tijiao_data('config/admin_role_add',0)"  >新增</button>
            </div>
          </div>
        </div>
      </form>


      <div class="layui-card-body">
        <table class="layui-table">
            <colgroup>
              <col width="30">
              <col width="60">
              <col width="60">
              <col width="10">
              <col width="30">
              <col width="60">
              <col>
            </colgroup>
            <thead>
              <tr>
                <th>ID</th>
                <th>名称</th>
                <th>权限</th>  
                <th>排序</th> 
                <th>菜单项</th>         
                <th>操作</th>
              </tr> 
            </thead>
            <tbody>
              <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo htmlentities($vo['id']); ?></td>
                  <td><?php echo '┃'.str_repeat('━━', substr_count($vo['cname'],'  '));?> <?php echo htmlentities($vo['name']); ?></td>
                  <td><?php echo htmlentities($vo['value']); ?></td>
                  <td>
                    <input type="text" name="sort" autocomplete="off" class="layui-input edit_sort"  value="<?php echo htmlentities($vo['sort']); ?>" item1="<?php echo htmlentities($vo['id']); ?>" >
                  </td>
                  <td> 
                    <div class=" layui-form" lay-filter="component-form-element">        
                       <input type="checkbox" name="menu" <?php echo $vo['menu']==1?'checked':''; ?> lay-skin="switch" lay-text="开启|关闭" lay-filter="menu_change" item="<?php echo htmlentities($vo['id']); ?>">
                    </div>
                  </td>
                  <td> <a class="layui-btn layui-btn-sm btn_del layui-btn-danger" rel="<?php echo htmlentities($vo['id']); ?>" href="#">删除</a> <button class="layui-btn layui-btn-sm" onclick='zfAdminShow("编辑权限","<?php echo url('config/admin_role_edit',['id' => $vo['id']] ); ?>")'>编辑</button></td>
                </tr>
              <?php endforeach; endif; else: echo "" ;endif; ?>         
            </tbody>
          </table>

      </div>
    </div>
  </div>
  <script src="/public/static/style/jquery-1.8.3.min.js"></script>  
  <script src="/public/static/style/layui/layui.js"></script>    
  <script src="/public/static/system/common.js"></script>  

  <script>
 layui.use([ 'table','element'], function(){
    var $ = layui.$
    ,form = layui.form
    ,element = layui.element
    ,table = layui.table;

    // 删除
    $(".btn_del").on("click",function(){
      var id = $(this).attr("rel");
      layer.confirm('确认删除？', {
        btn: ['删除','取消'] //按钮
      }, function(){
        //执行删除操作
        $.get("<?php echo url('common/del_post'); ?>",{id:id,db:'admin_role'},function(res){
          if(res.result==1){
            layer.msg("删除成功", {icon: 1});
            setTimeout(function() {
              location.reload(true);
            }, 1000);
          }else{
            layer.msg(res.msg, {icon: 2});
            setTimeout(function() {
              location.reload(true);
            }, 1000);
          }
        },"json");

      }, function(){
          //取消的操作
      });
    })

      // 获取方法
    form.on('select(control)', function(data){
      var control = data.value
      $.ajax({
        type:'get',
        url:"<?php echo url('config/get_action'); ?>",
        data:{control:control},
        dataType:'json',
        success:function(res){
          $("select[name=act]").html("");
          option='<option value ="">--顶级--</option>';
            $("select[name=act]").append(option);
          for(var i=0;i<res.length;i++){
            option='<option value ="'+res[i]+'">'+res[i]+'</option>';
            $("select[name=act]").append(option);
          }
          form.render('select');//更新数据        
        }
      })
    });
    form.on('switch(menu_change)', function(data){
      var id = $(this).attr("item")
      var dbname = 'admin_role'
      var menu = this.checked ? '1' : '0'
      console.log(id)
      $.get("<?php echo url('common/is_menu'); ?>",{id:id,dbname:dbname,menu:menu},function(res){
          if(res.result==1){
            layer.msg(res.msg, {icon: 1});
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");
    });
    $('.edit_sort').on('blur',function(){
      var id = $(this).attr('item1')
      var dbname = 'admin_role'
      var field = 'sort'; //得到字段
      var value = $(this).val(); //得到修改后的值
      $.get("<?php echo url('common/value_edit'); ?>",{id:id,dbname:dbname,field:field,value:value},function(res){
          if(res.result==1){
          //layer.msg(res.msg, {icon: 1});
          window.location.reload();
        }
      },"json");

    })
    

      
   
     
  
    
    
   
  });
  </script>
</body>
</html>
