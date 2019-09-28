<?php /*a:1:{s:37:"./template/admin/user/admin_info.html";i:1569477696;}*/ ?>
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
    <form class="info_tj" >
      <input type="hidden" name="id" value="<?php echo htmlentities(app('session')->get('admin.id')); ?>">
      <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
          <input type="text" name="" value="<?php echo htmlentities($res['name']); ?>" autocomplete="off" class="layui-input" readonly="">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">头像</label> 
        <div class="layui-input-inline">
          <input type="text"  id="main_pic" name="pic" value="<?php echo htmlentities($res['pic']); ?>" autocomplete="off" class="layui-input" >
        </div>
         <span type="button" class="layui-btn layui-btn-sm" id="up_img">上传图片</span>
      </div>
      <?php if($res['google_is']==1 && $res['google_secret']==''){ ?>
      <div class="layui-form-item">
        <label class="layui-form-label">google_secret</label>
        <div class="layui-input-inline">
          <input type="text" name="google_secret" value="<?php echo htmlentities($secret); ?>" autocomplete="off" class="layui-input" readonly="">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">谷歌身份码</label>
        <div class="layui-input-inline">
          <img style="width: 100px;height: 100px" src="<?php echo htmlentities($qrCodeUrl); ?>">
        </div>
        <!-- <span>使用谷歌验证器扫描</span> -->
      </div>
      <?php }elseif($res['google_secret']!=''){ ?>
      <div class="layui-form-item">
        <label class="layui-form-label">google_secret</label>
        <div class="layui-input-inline">
          <input type="text" name="google_secret" value="<?php echo htmlentities($secret); ?>" autocomplete="off" class="layui-input" readonly="">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">谷歌身份码</label>
        <div class="layui-input-inline">
          <img style="width: 100px;height: 100px" src="<?php echo htmlentities($qrCodeUrl); ?>">
        </div>
        <span>使用谷歌验证器扫描</span>
      </div>
      <?php } ?>
      <div class="layui-form-item">
        <label class="layui-form-label">开启谷歌验证:</label>
        <div class="layui-input-block">
          <input type="radio" name="google_is" value="1" title="开启" <?php echo $res['google_is']==1?'checked':''; ?> ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>开启</div></div>
          <input type="radio" name="google_is" value="0" title="关闭" <?php echo $res['google_is']==0?'checked':''; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>关闭</div></div>
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <input class="layui-btn tijiao layui-btn-sm" type="button"  lay-filter="formDemo" value="立即提交" />
          <a class="layui-btn layui-btn-normal layui-btn-sm help_btn " href="javascript:;">google身份码使用</a>
        </div>
      </div>
    </form>
  </div>

  <script src="/public/static/style/layui/layui.js"></script>    
  <script>
 layui.use(['form', 'upload','layer'], function(){
    var $ = layui.$
    ,form = layui.form
    ,layer = layui.layer
    ,upload = layui.upload ;

    upload.render({
      elem: '#up_img'
      ,url: "<?php echo url('common/upload_one'); ?>"
      ,done: function(res){
        console.log(res)
        if(res.result==1){
            layer.msg("上传成功", {icon: 1});
            $("#main_pic").val(res.msg);
        }else{
          layer.msg(res.msg, {icon: 2});
        }
      }
    });

    $(".tijiao").on("click",function(){
      var index = layer.load(2);
      var data = $(".info_tj input").serialize();      
      $.ajax({
          type:'post',
          url:"<?php echo url('user/admin_info'); ?>",
          data:data,
          dataType:'json',
          success:function(res){
            layer.close(index);
            if(res.result==1){
              layer.msg("修改成功", {icon: 1});
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            }else{
              layer.msg(res.msg, {icon: 2});
              setTimeout(function() {
                window.location.reload();
              }, 2000);
            }
            
          }
      })

    })
    $('.help_btn').on('click',function(){
      layer.open({
        type: 1 //此处以iframe举例
        ,title: '微信小程序搜索  mctool '
        ,area: ['390px', '660px']
        ,shade: 0
        ,maxmin: true
        // ,offset: ['auto'] 
        ,content: '<img style="width:380px;height:660px;" src="https://demo.zf.90ckm.com/upload/filex/20190907/b8d67cbdb347014e21d8b15ed88e6a26.gif" />'
      });
    })


    
  })
  </script>
</body>
</html>