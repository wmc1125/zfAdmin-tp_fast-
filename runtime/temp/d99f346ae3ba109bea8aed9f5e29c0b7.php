<?php /*a:1:{s:39:"./template/admin/template/tpl_list.html";i:1569477141;}*/ ?>


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
  <link rel="stylesheet" href="/public/static/system/style/template.css" media="all">
</head>
<body>
<div class="layui-fluid layadmin-cmdlist-fluid">
    <div style="padding-bottom: 10px;">
        <button type="button" class="layui-btn" >下载模板参考文件</button>
    </div>
  <div class="layui-row layui-col-space30">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['ok']==1){ ?>
      <div class="layui-col-md3 layui-col-sm4">
          <div class="cmdlist-container">
              <img src="<?php echo htmlentities($vo['pic']); ?>" style="height: 160px">
              <div class="cmdlist-text">
                <div class="price">
                  <span>模板名:<?php echo htmlentities($vo['name']); ?> <?php echo htmlentities($vo['version']); ?></span><br>
                  <span>作者:<?php echo htmlentities($vo['author']); ?></span><br>
                  <span>创建时间:<?php echo htmlentities($vo['ctime']); ?></span> <br>
                  <span>路径:<?php echo htmlentities($vo['path']); ?></span> 
                  <span class="flow">
                    <i class="layui-icon layui-icon-rate btn_edit" item="<?php echo htmlentities($vo['dir_name']); ?>" style="color: <?php echo $tpl_name==$vo['dir_name']?'#1E9FFF':''; ?>;" ></i>
                  </span>
                </div>  
              </div>
          </div>
      </div>
      <?php }else{ ?>
      <div class="layui-col-md3 layui-col-sm4">
          <div class="cmdlist-container">
              <div class="cmdlist-text">
                <div class="price">
                  <span style="color: red;">代码格式不正确或已破损</span> <br>
                  <span>路径:<?php echo htmlentities($vo['path']); ?></span> 
                </div>  
              </div>
          </div>
      </div>
      <?php } ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    
    
    
  </div>
</div>
  <script src="/public/static/style/layui/layui.js"></script>    
  <script src="/public/static/system/common.js"></script> 
  <script>
  layui.config({
    base: '/public/static/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index']);
 layui.use(['laypage', 'layer','upload'], function(){
    var $ = layui.$ 
    ,laypage = layui.laypage
    ,layer = layui.layer
    ,element = layui.element
    ,upload = layui.upload;
    

   $('.btn_edit').on("click",function(){
      var value = $(this).attr('item');
      var key = 'zf_tpl_suffix'
      $.ajax({
        type:'post',
        url:"<?php echo url('common/config_edit'); ?>",
        data:{key:key,value:value},
        dataType:'json',
        success:function(res){
          console.log(res)
          if(res.result==1){
            layer.msg(res.msg, {icon: 1});
            layer.close()
            setTimeout(function() {
              window.location.reload();
            }, 2000);
          }else{
            layer.msg(res.msg, {icon: 2});
          }   
        }
      })
   })



  
  
});



  </script>
</body>
</html>