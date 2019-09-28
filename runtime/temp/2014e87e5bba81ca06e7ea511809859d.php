<?php /*a:1:{s:36:"./template/admin/category/index.html";i:1569478548;}*/ ?>
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
              <label class="layui-form-label">栏目tpl</label>
              <div class="layui-input-inline">
                <input type="text" name="tpl_category" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">模型</label>
              <div class="layui-input-inline">
                <select name="mid">
                  <?php foreach($mlist as $k=>$vo):?>
                    <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                  <?php endforeach;  ?>
                </select>
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">父类</label>
              <div class="layui-input-inline">
                <select name="pid">
                  <option value="0">---顶级目录---</option>
                  <?php if(is_array($list)): foreach($list as $k=>$vo):if($vo['pid']==0): ?>
                    <option value="<?php echo htmlentities($vo['cid']); ?>"><?php echo htmlentities($vo['cname']); ?></option>
                    <?php foreach($list as $k2 =>$vo2): if($vo2['pid']==$vo['cid']): ?>
                    <option value="<?php echo htmlentities($vo2['cid']); ?>"><?php echo htmlentities($vo2['cname']); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; endforeach; endif; ?>
                </select>
              </div>
            </div>
            
            <div class="layui-inline">
                <button class="layui-btn layui-btn-sm" onclick="tijiao_data('category/category_add',0)"  >新增</button>
            </div>
          </div>
        </div>
      </form>

      <div class="layui-card-body">
        <table class="layui-table">
            <colgroup>
              <col width="50">
              <col width="10">
              <col width="60">
              <col width="60">
              <col width="50">
              <col width="50">
              <col width="50">
              <col width="50">
              <col width="50">
              <col width="120">
              <col>
            </colgroup>
            <thead>
              <tr>
                <th>CID</th>
                <th>图标</th>
                <th>名称</th>
                <th>栏目Tpl</th>          
                <th>内容Tpl</th>
                <th>模型</th>
                <th>排序</th>
                <th>状态</th>
                <th>菜单</th>
                <th>操作</th>
              </tr> 
            </thead>
            <tbody>
              <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                  <td><?php echo htmlentities($vo['cid']); ?></td>
                  <td> <?php if($vo['icon']!=''){ ?><img src="<?php echo htmlentities($vo['icon']); ?>" style="width: 40px;height: 40px"><?php }?></td>
                  <td><?php echo '┃'.str_repeat('━━', substr_count($vo['cname'],'  '));?> <?php echo htmlentities($vo['name']); ?></td>
                  <td><?php echo htmlentities($vo['tpl_category']); ?></td> 
                  <td><?php echo htmlentities($vo['tpl_post']); ?></td>
                  <td><?php echo m_name($vo['mid']); ?></td>
                  <td> 
                    <input type="text" name="sort" autocomplete="off" class="layui-input edit_sort"  value="<?php echo htmlentities($vo['sort']); ?>" item1="<?php echo htmlentities($vo['cid']); ?>" >
                  </td>
                  <td>
                    <div class=" layui-form" lay-filter="component-form-element">        
                       <input type="checkbox" name="status" <?php echo $vo['status']==1?'checked':''; ?> lay-skin="switch" lay-text="开启|关闭" lay-filter="status_change" item="<?php echo htmlentities($vo['cid']); ?>">
                    </div>
                  </td>
                  <td>
                  	<div class=" layui-form" lay-filter="component-form-element">        
                       <input type="checkbox" name="menu" <?php echo $vo['menu']==1?'checked':''; ?> lay-skin="switch" lay-text="开启|关闭" lay-filter="menu_change" item="<?php echo htmlentities($vo['cid']); ?>">
                    </div>
                  </td>
                  <td>
                    <a class="layui-btn btn_del layui-btn-danger layui-btn-xs" rel="<?php echo htmlentities($vo['cid']); ?>" href="#">删除</a> 
                    <button class="layui-btn layui-btn-xs " onclick='zfAdminShow("编辑栏目","<?php echo url('category/category_edit',['cid' => $vo['cid']] ); ?>")'>编辑</button> 
                    <?php if(!if_pid($vo['cid'])):  if($vo['mid']!=1): ?>
                      <a class="layui-btn layui-btn-xs" href="<?php echo url('category/post_list',['cid' => $vo['cid'],'mid'=>$vo['mid']] ); ?>">内容列表</a>
                    <?php endif; endif; ?>
                  </td>
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
        $.get("<?php echo url('common/del_post'); ?>",{id:id,db:'category'},function(res){
          if(res.result==1){
            layer.msg("删除成功", {icon: 1});
            setTimeout(function() {
              location.reload(true);
            }, 1000);
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");

      }, function(){
          //取消的操作
      });
    });
    form.on('switch(menu_change)', function(data){
      var id = $(this).attr("item")
      var dbname = 'category'
      var status = this.checked ? '1' : '0'
      console.log(id)
      $.get("<?php echo url('common/is_menu'); ?>",{id:id,dbname:dbname,menu:status},function(res){
          if(res.result==1){
            layer.msg(res.msg, {icon: 1});
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");
    });
    form.on('switch(status_change)', function(data){
      var id = $(this).attr("item")
      var dbname = 'category'
      var status = this.checked ? '1' : '0'
      console.log(id)
      $.get("<?php echo url('common/is_switch'); ?>",{id:id,dbname:dbname,status:status},function(res){
          if(res.result==1){
            layer.msg(res.msg, {icon: 1});
          }else{
            layer.msg(res.msg, {icon: 2});
          }
        },"json");
    });
    $('.edit_sort').on('blur',function(){
      var id = $(this).attr('item1')
      var dbname = 'category'
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
