<?php /*a:1:{s:31:"./template/admin/user/edit.html";i:1569477696;}*/ ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo htmlentities($web_config['version']['ver_name']); ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/static/style/layui/css/layui.css" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <form class="info_tj" onclick="return false">
      <input type="hidden" name="id" value="<?php echo htmlentities($res['id']); ?>">
      <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
          <input type="text" name="name"  placeholder="请输入用户名" autocomplete="off" class="layui-input" value="<?php echo htmlentities($res['name']); ?>">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">分组</label>
        <div class="layui-input-inline">
          <select name="gid">
            <option value="<?php echo htmlentities($res['gid']); ?>"><?php echo user_group_name($res['gid']); ?></option>

            <?php if(is_array($glist)): foreach($glist as $k=>$vo):?>
              <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
              
            <?php endforeach; endif; ?>
          </select>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-inline">
          <input type="text" name="tel"  placeholder="请输入号码" autocomplete="off" class="layui-input" value="<?php echo htmlentities($res['tel']); ?>">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
          <input type="password" name="pwd"  placeholder="请输入用密码" autocomplete="off" class="layui-input" value="">
        </div>
      </div>
      
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn layui-btn-sm" onclick="tijiao_data('user/edit')"  lay-submit lay-filter="formDemo">立即提交</button>
        </div>
      </div>
    </form>
  </div>

  <script src="/public/static/style/layui/layui.js"></script>    
  <script type="text/javascript" src="/public/static/system/common.js"></script>  

  <script>
 layui.use(['form', 'upload'], function(){
    var $ = layui.$
    ,form = layui.form
    ,upload = layui.upload ;

    
    
    
  })
  </script>
</body>
</html>